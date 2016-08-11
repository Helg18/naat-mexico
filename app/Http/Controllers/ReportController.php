<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Quiz;
use App\Models\User;
use \DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;

class ReportController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module');
    }


    public function getQuizzes(){

        if(\Auth::user()->is('admin')){
            $quizzes = Quiz::all();
        }else{
            $quizzes = \Auth::user()->company()->quizzes;
        }


        return view('report.quizzes')->with(compact('quizzes'));
    }

    public function getUsers(){

        if(\Auth::user()->is('admin')){
            $users = User::whereRaw(DB::raw("id IN (SELECT user_id FROM role_user WHERE role_id=4)"))->get();
        }else {
            $users = \Auth::user()->company()->userByRespondents();
        }

        return view('report.users')->with(compact('users'));
    }

    public function getExcel(Request $request){
        if($quiz = Quiz::find($request->id)){
            $quizzes = [$quiz];
        }else{
            $quizzes = \Auth::user()->company()->quizzes;
        }


        Excel::create('Genius_Encuesta_' . date('Y_m_d_H_i_s'), function($excel) use ($quizzes) {


            foreach($quizzes as $quiz):


            $excel->sheet($quiz->name, function($sheet) use ($quiz){

                $head = ['Persona'];
                foreach($quiz->questions as $q):
                        $head[] = $q->question .' - '. $q->type;
                endforeach;

                $sheet->row(1, ['Genius']);
                $sheet->row(2, [$quiz->name]);
                $sheet->row(4, $head);


                $row = 5;

                foreach($quiz->users as $u){

                    $r= [];
                    $r[] = $u->name .' ('. $u->email .')';
                    $additionalRows = [];

                    foreach($quiz->questions as $q):
                        $original = $q->userAnswerString($u,true);
                        $tmp2 = explode(", ",$original);
                        $tmp = substr($original,0,4)=='http' ? $tmp2[0] : $original;
                        $r[] = $tmp;

                        if(substr($tmp,0,4)=='http'):
                            // Config
                            $link_style_array = [
                                'font'  => [
                                    'color' => ['rgb' => '0000FF'],
                                    'underline' => 'single'
                                ]
                            ];

                            $excelHead = chr(count($r) + 64);
                            $cell = $excelHead . $row;
                            $url = explode(" - ",$tmp);

                            $sheet->getCell()->hasHyperlink();
                            $sheet->getCell($cell)->getHyperlink()->setUrl(strip_tags($url[0]));
                            $sheet->getStyle($cell)->applyFromArray($link_style_array);
                            $this->excelImage($url[0],$sheet,$cell);
                            $sheet
                                ->getRowDimension( $row )
                                ->setRowHeight( '100' );

                            //Additional rows
                            if(count($tmp2)>1){
                                array_shift($tmp2); //Delete first element
                                $additionalRows['Q'.$q->id][] = [
                                    'excel_head'    =>  $excelHead,
                                    'elements'      =>  $tmp2
                                ];
                            }

                        endif;
                    endforeach;

                    $sheet->row($row, $r);
                    $row++;
                    $lastRow = $row;

                    foreach($additionalRows as $questions){

                        foreach($questions as $a){

                            $row=$lastRow;
                            foreach($a['elements'] as $e){

                                $url = explode(" - ",$e);

                                $cell = $a['excel_head'] . $row;
                                $sheet->getCell()->hasHyperlink();
                                $sheet->setCellValue($cell, $e);  //set C1 to current date
                                $sheet->getCell($cell)->getHyperlink()->setUrl(strip_tags($url[0]));
                                $sheet->getStyle($cell)->applyFromArray($link_style_array);

                                $this->excelImage($url[0],$sheet,$cell);

                                $sheet
                                    ->getRowDimension( $row )
                                    ->setRowHeight( '100' );
                                $row++;
                            }
                        }
                    }
                    $row++;


                }




            });

            endforeach;




        })->download('xlsx');

    }


    private function excelImage($url, $sheet,$cell){


        $pos = strpos($url, "images/");
        $logo =  public_path()."/".substr($url,$pos);

        if(!is_file($logo)) return false;


        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');

        $objDrawing->setPath($logo);
        //$objDrawing->setOffsetX(8);    // setOffsetX works properly
        //$objDrawing->setOffsetY(300);  //setOffsetY has no effect
        $objDrawing->setCoordinates($cell);
        $objDrawing->setHeight(75); // logo height
        $objDrawing->setWorksheet($sheet);

        $objDrawing->setResizeProportional(true);

    }

}
