<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelableTrait;
use App\Models\QuestionAnswer;
use App\Models\Answer;
use \DB;

class Question extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'answers_json'
    ];

    //
    use ModelableTrait;

    private static $types = [
        'Opcion Unica',
        'Multiopcion',
        'Abierta',
        'Opcion Multiple Imagen',
        'Tache Paloma Imagen',
        'Dibujar sobre Imagen',
        'Opcion Unica Imagen',
        'Caritas',
        'Numeros',
        'Deslizador',
        'Porcentaje',
        'Cajones',
        'Cajones 2',

    ];

    private static $caritas = [
        'caras_cara_a.png',
        'caras_cara_b.png',
        'caras_cara_c.png',
        'caras_cara_d.png',
        'caras_cara_e.png'
    ];

    public static function type_id($type){
        return array_search($type, self::$types);
    }

    public static function types(){
        return self::$types;
    }

    public function answers(){
        return $this->hasMany('\App\Models\QuestionAnswer');
    }

    public function saveAnswers($answers){

        //if($this->type!='Opcion Multiple Imagen'):
            //Delete
            foreach($this->answers as $a){
                $delete = true;
                foreach($answers as $aa){
                    if($a->id == $aa['id']) $delete = false;
                }
                if($delete){
                    $image = $this->path_image().$a->answer;
                    if(is_file($image)) unlink($image);
                    $a->delete();
                }
            }
        //endif;

        if($this->type!='Opcion Multiple Imagen'):
            //Save or Update
            foreach($answers as $a){
                if(!isset($a['id']) || !$answer = QuestionAnswer::find($a['id'])){
                    $answer = new QuestionAnswer();
                }

                $answer->question_id = $this->id;
                $answer->answer = $a['answer'];
                $answer->score = $a['score'];
                $answer->save();

            }
        endif;

    }




    function getAnswersJsonAttribute(){
        return $this->answers;
    }

    function userAnswer($user){
        return Answer::
            where('question_id',$this->id)
            ->whereRaw(DB::raw("quiz_user_id IN (SELECT id FROM quiz_user WHERE quiz_id=".$this->quiz_id." AND user_id=".$user->id.")"))
            ->get();
    }

    function userAnswerString($user,$onlyText=false){

        $answers = $this->userAnswer($user);

        $txt = [];
        foreach($answers as $a){
            switch($this->type){
                case 'Opcion Multiple':
                case 'Multiopcion':
                case 'Opcion Unica':
                    //dd($a->answer);
                    $tmp =QuestionAnswer::find($a->answer);
                    $txt[] = $tmp ? $tmp->answer : "Respuesta no encontrada: ".$a->answer." ID: ".$a->id;

                    break;

                case 'Abierta':
                case 'Numeros':
                case 'Deslizador':
                    $txt[] = $a->answer;
                    break;

                case 'Porcentaje':
                    $tmp = explode(":", $a->answer);
                    $tmp2 = QuestionAnswer::find($tmp[0])->answer;
                    $txt[] = $tmp2.": ".$tmp[1];

                    break;

                case 'Cajones':
                    $tmp = explode(":", $a->answer);
                    $url = asset('images/answers/' . QuestionAnswer::find($tmp[0])->answer);
                    $txt[] = $onlyText ? $url.' - '.$tmp[1] :'<div class="panel panel-default panel-hovered panel-stacked mb5"><div class="panel-body"><img src="'. $url .'"> - ' . $tmp[1] . "</div></div>" ;
                    break;

                case 'Cajones 2':
                    $tmp = explode(":", $a->answer);
                    $url = asset('images/answers/' . QuestionAnswer::find($tmp[0])->answer);
                    $answer_text = QuestionAnswer::find($tmp[1])->answer;
                    $txt[] = $onlyText ? $url.' - '.$answer_text :'<div class="panel panel-default panel-hovered panel-stacked mb5"><div class="panel-body"><img src="'. $url .'"> - ' . $answer_text . "</div></div>" ;
                    break;

                case 'Opcion Multiple Imagen':
                case 'Opcion Unica Imagen':
                    $url = asset('images/answers/' . QuestionAnswer::find($a->answer)->answer);
                    $txt[] = $onlyText ? $url  : '<img src="'. $url .'">';
                    break;

                case 'Tache Paloma Imagen':
                case 'Dibujar sobre Imagen':
                    $url = asset('images/from_users/' . $a->answer);
                    $txt[] = $onlyText ? $url  : '<img src="'. $url .'">';
                    break;

                case 'Caritas':
                    //$txt[] = isset(self::$caritas[$a->answer]) ? '<img src="'. asset('images/' . self::$caritas[$a->answer]) .'">' : $a->answer;

                    if(isset(self::$caritas[$a->answer])){
                        $url = asset('images/' . self::$caritas[$a->answer]);
                        $txt[] =  $onlyText ? $url  : '<img src="'. $url .'">';
                    }else{
                        $txt[] =$a->answer;
                    }


                    break;

                default:
                    $txt[] = $a->id;
            }
        }

        //return $onlyText ? $txt : implode(", ",$txt);
        return implode(", ",$txt);
    }

    public function path_image(){
        return base_path() . env('PATH_IMAGES');
    }

    public function path_sonido(){
        return base_path() . env('PATH_SONIDO');
    }


    public function sonidos($file,$file_name_old=""){
        
        $sonido="";

        if($file) {


            $sonido = sha1(time()."_".$file->getClientOriginalName()) . '.' .$file->getClientOriginalExtension();

            if($file_name_old<>"" &&$file_name_old<>"null"){
                $old = $this->path_sonido() . $file_name_old;
                if(is_file($old)){
                    unlink($old);
                }
            }

            $file->move(
                $this->path_sonido(), $sonido
            );

        }

        return $sonido;
    }


    public function image($id=false, $file){

        $qa = $this->answers()->where('id',$id)->first();

        if($file) {


            if($qa){
                $old = $this->path_image() . $qa->answer;
                if(is_file($old)){
                    unlink($old);
                }
            }else{
                $qa = new QuestionAnswer();
                $qa->question_id = $this->id;
            }

            $imageName = sha1(time()."_".$file->getClientOriginalName()) . '.' .$file->getClientOriginalExtension();

            $file->move(
                $this->path_image(), $imageName
            );

            $qa->answer = $imageName;
            if($this->type="Cajones 2"){
                $qa->order=1;
            }
            $qa->save();
        }
    }
}
