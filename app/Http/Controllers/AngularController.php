<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use App\Models\SendGroup;
use App\Models\SendGroupDetail;


class AngularController extends Controller
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
    }

   

    public function getQuestionTypes(){

        return response()->json(Question::types());
    }

    public function postQuestion(Request $request){
        
        

        if(!$request->id){
            //New Question
            $question = new Question();
            $question->quiz_id = $request->quiz_id;
        }else{
            //Update Question
            $question = Question::find($request->id);
        }


        $question->type = $request->type;
        $question->question = $request->question;
        $question->text_help = $request->text_help;
        $question->is_active = (bool)$request->is_active;
        $question->video = $request->video;
        // $files = $request->files;
        // $nombre_file_sonido = $this->sonidos($files);
        // $question->sonido = $nombre_file_sonido;
        

        $question->save();
        $question->saveAnswers($request->answers);
        return response()->json(['message'=>'Pregunta guardada exitosamente','id'=>$question->id]);

    }


    public function questions($id){
        $quiz = Quiz::find($id);
        return response()->json($quiz->questions);
    }


    public function deleteQuestion($id){

        $question = Question::find($id);
        //To Do delete images
        $question->delete();
        return response()->json(['message'=>'Pregunta eliminada exitosamente']);
    }


    public function user_detail($id){
        $user = User::find($id);
        return response()->json($user->jsonProfile());
    }

    public function images(Request $request, $id){

        $question = Question::find($id);
        $files = $request->files;

        

        $id = false;

        if(
            $question->type=='Tache Paloma Imagen' ||
            $question->type=='Dibujar sobre Imagen'
        ){
            $id = $question->answers()->first() ? $question->answers()->first()->id : false;
        }

        $var=0;
        if($question && $files){

            foreach($files as $k=>$file){
                $n=$file->getClientMimeType();

                if($n<>"audio/mpeg"){
                    $question->image($id,$file);
                }else{
                    $question->sonido = $question->sonidos($file,$question->sonido);
                    $question->save();
                    $var=1;
                }
            }
        }

        return response()->json(['message'=>'Imagenes o Sonido guardadas exitosamente']);
    }

    


    public function emails($group_id){
        $group = SendGroup::find($group_id);
        return response()->json($group->emails);

    }

    public function postEmail(Request $request){
        if(!$email = SendGroupDetail::find($request->id)){
            $email = new SendGroupDetail();
            $email->send_group_id = $request->send_group_id;
        }

        $email->email = $request->email;
        $email->save();

        return response()->json(['message'=>'Email guardado exitosamente','id'=>$email->id]);
    }

    public function deleteEmail($id){

        $email = SendGroupDetail::find($id);
        //To Do delete images
        $email->delete();
        return response()->json(['message'=>'Email eliminado exitosamente']);
    }

}
