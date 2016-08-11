<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelableTrait;

use App\Models\Answer;
use App\Models\QuestionAnswer;
use App\Models\Question;

use \DB;

class Quiz extends Model
{
    use ModelableTrait;
    //

    public static function own(){
        if(\Auth::user()->is('customer')){
            return self::where('company_id',\Auth::user()->company()->id)->get();
        }else{
            return self::all();
        }
    }

    public function users()
    {
        return $this->belongsToMany('\App\Models\User')->withTimestamps();
    }

    public function questions(){
        return $this->hasMany('\App\Models\Question');
    }

    public function nse_level(){
        return $this->belongsTo('\App\Models\NseLevel');
    }

    public function getIsPrivateSlugAttribute(){
        if($this->is_private){
            return "Si";
        }else{
            return "No";
        }
    }


    public static function forService($id=false,$user){
        if($quiz = self::find($id)){
            return [$quiz->jsonStructure()];
        }else{
            $quizzes = self::

                whereRaw(DB::raw('is_active = 1')) //only actives quizzes
                ->whereRaw(DB::raw('id != 1'))
                ->whereRaw(DB::raw("(
                    CASE
                        WHEN nse_level_id>0
                        THEN nse_level_id IN (SELECT id FROM nse_levels WHERE " . $user->survey_respondent->nse_points . " BETWEEN min AND max)
                        ELSE nse_level_id IS NULL
                    END
                )")) //NSE especification
                ->whereRaw(DB::raw("(
                    id NOT IN (
                        SELECT quiz_id
                        FROM quiz_user
                        WHERE user_id=".$user->id."
                        AND created_at >= quizzes.last_active
                        AND quiz_id=quizzes.id
                        )
                    )")) //Discard already answerd quizzes AND reactivate
                ->whereRaw(DB::raw("(
                    CASE
                        WHEN state IS NOT NULL
                        THEN state = '" . $user->survey_respondent->state ."'
                        ELSE state IS NULL
                    END
                )")) //NSE especification
                ->whereRaw(DB::raw("(
                    CASE
                        WHEN is_private > 0
                        THEN
                            CASE
                                WHEN quizzes.send_group_id IS NOT NULL
                                THEN (
                                    quizzes.send_group_id IN (
                                            SELECT send_group_details.send_group_id
                                            FROM send_group_details
                                            WHERE email='{$user->email}'
                                            AND send_group_details.send_group_id = quizzes.send_group_id
                                            AND send_group_details.send_group_id IN (SELECT id from send_groups WHERE company_id=quizzes.company_id)

                                    )

                                )
                                WHEN quizzes.send_group_id IS NULL
                                THEN (
                                    quizzes.company_id IN (
                                            SELECT send_groups.company_id
                                            FROM send_groups
                                            WHERE id IN ( SELECT send_group_id FROM send_group_details WHERE email='{$user->email}' )

                                    )

                                )
                            END
                        ELSE is_private = 0
                    END
                )")) //Private
                ->get()
                //->toSql()
            ;

            //dd($quizzes);



            $tmp = [];
            foreach($quizzes as $q){
                $tmp[] = $q->jsonStructure();
            }
            return $tmp;
        }

    }


    function jsonStructure(){
        $questions = [];
        foreach($this->questions as $q){

            $answers = [];
            $answer = false;
            switch($q->type){
                case 'Opcion Unica':
                case 'Multiopcion':
                case 'Porcentaje':
                    foreach($q->answers as $a){
                        $answers[] = [
                            'id'        => $a->id,
                            'answer'    => $a->answer
                        ];
                    }
                    break;
                case 'Opcion Multiple Imagen':
                case 'Opcion Unica Imagen':
                case 'Cajones':
                    foreach($q->answers as $a){
                        $answers[] = [
                            'id'        => $a->id,
                            'answer'    => $a->image_src
                        ];
                    }
                    break;

                case 'Tache Paloma Imagen':
                case 'Dibujar sobre Imagen':
                    $a = $q->answers()->first();
                    $answer = [
                        'id'        => $a->id,
                        'answer'    => $a->image_src
                    ];
                    break;


                case 'Cajones 2':
                    $tmp1=[];
                    $tmp2=[];
                    foreach($q->answers as $a){
                        if($a->order==1){
                            $tmp2[] = [
                                'id'        => $a->id,
                                'answer'    => $a->image_src
                            ];
                        }else{
                            $tmp1[] = [
                                'id'        => $a->id,
                                'answer'    => $a->answer
                            ];
                        }
                    }
                    $answers =[
                        'text'      => $tmp1,
                        'images'    => $tmp2
                    ];

            }

            $tmp = [
                'id'        => $q->id,
                'type'      =>  $q->type,
                'type_id'      =>  Question::type_id($q->type),
                'question'  =>  $q->question,
                'answers'   =>  $answers,
                'answer'   =>  $answer,
                'video'   =>  $q->video,
                'sonido' => 'https://secure.kreativeco.com/genius/sonido/'.$q->sonido
            ];

            if(!$answer) unset($tmp['answer']);
            if(!count($answers)) unset($tmp['answers']);

            $questions[] = $tmp;
        }

        return [
            'id'        =>  $this->id,
            'name'      =>  $this->name,
            'points'    =>  $this->points,
            'is_active'    =>  $this->is_active,
            'sent_date'    =>  $this->last_active,
            'state'    =>  $this->state,
            'questions' =>  $questions
        ];
    }

    public function createFromWS($request,$user){
        $this->users()->attach($user->id, ['earned_points'=>$this->points]);

        $tmp = DB::table('quiz_user')
            ->selectRaw(DB::raw("
                id
                "))
            ->where('quiz_id',$this->id)
            ->where('user_id',$user->id)
            ->first();

        foreach(json_decode($request->answers_json) as $a){

            $q = Question::find($a->question_id);
            switch($q->type){

                case 'Opcion Unica':
                case 'Tache Paloma Imagen':  //En lugar de ID me va a dar una imagen base64
                case 'Dibujar sobre Imagen': //En lugar de ID me va a dar una imagen base64
                case 'Opcion Unica Imagen':
                    $qa = QuestionAnswer::find((int)$a->answer);
                    $new_record = Answer::create([
                        'quiz_user_id'      =>  $tmp->id,
                        'question_id'       =>  $a->question_id,
                        'answer'            =>  $a->answer,
                        'score'             =>  $qa ? $qa->score : null
                    ]);
                    $this->imageUploaded($request , $a->answer, $new_record);
                    break;


                case 'Multiopcion':
                case 'Opcion Multiple Imagen':
                case 'Porcentaje':
                case 'Cajones':
                case 'Cajones 2':


                    foreach($a->answer as $aa){
                        $qa = QuestionAnswer::find((int)$aa);
                        $new_record = Answer::create([
                            'quiz_user_id'      =>  $tmp->id,
                            'question_id'       =>  $a->question_id,
                            'answer'            =>  $aa,
                            'score'             =>  $qa ? $qa->score : null
                        ]);
                        //$this->imageUploaded($request , $a->answer);
                        $this->imageUploaded($request , $aa, $new_record);
                    }
                    break;

                case 'Abierta':
                case 'Caritas':
                case 'Numeros':
                case 'Deslizador':

                    Answer::create([
                        'quiz_user_id'      =>  $tmp->id,
                        'question_id'       =>  $a->question_id,
                        'answer'            =>  $a->answer,
                        'score'             =>  0
                    ]);
                    break;

            }

        }

        $user->calculateEarnedPoints();
        if($this->id==1){
            $tmp = DB::table('answers')
                ->selectRaw(DB::raw("
                sum(score) as score
                "))
                ->whereRaw(DB::raw("question_id IN (SELECT id FROM questions WHERE quiz_id={$this->id})"))
                //->groupBy('id')
                ->first();

            $user->survey_respondent()->update(['nse_points'=>$tmp->score]);
        }

    }

    private function imageUploaded($request, $name, $record){
        if ($request->hasFile($name) && $request->file($name)->isValid()) {

            $file = $request->file($name);
            //
            if($file->getExtension()){
                $ext = $file->getExtension();
            }elseif($file->guessExtension()){
                $ext = $file->guessExtension();
            }


            $filename = sha1($name . time()).".".$ext;
            $request->file($name)->move(
                base_path() . '/public/images/from_users/', $filename
            );
            if($record){
                $record->answer = $filename;
                $record->save();
            }
        }
    }
}
