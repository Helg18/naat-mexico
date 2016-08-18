<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SignUpRequest;
use App\Http\Requests\Api\QuizRequest;

use App\Models\User;
use App\Models\Role_User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Regla;
use App\Models\Fecha;
use App\Models\Premios;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Iniciativa;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Hash;

class V1Controller extends Controller
{
    use ResetsPasswords;
    //
    public function __construct(){
        $this->middleware('jwt.auth',['except'=>['postSignIn','postSignUp', 'postRecoverPassword', 'login', 'register']]);
        // $this->middleware('jwt.refresh',['except'=>['reglasdeljuego']]);
    }

    /**
     * Metodos para el login
     * Codigo de Henry Leon
     */
    
    //Login
    public function login(Request $request){

        // Capturando las credenciales
        
        $credenciales = $request->only('email', 'password');

        try {
            // intento verificar las credenciales y crear un token para el usuario
            if (! $token = JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'credenciales_invalidas'], 401);
            }
        } catch (JWTException $e) {
            // Algo salio mal al intentar crear el token :(
            return response()->json(['error' => 'no_se_ha_podido_crear_el_token'], 500);
        }


        //verificar que el usuario que inicia sesion sea de mobile
        $u = User::where('email','=', $request->email)->get();
        
        $id_user = $u->pluck('id')->first();

        //Consulto el permiso segun el id del usuario
        $ru = Role_User::where('user_id','=', $id_user)->get();

        //comparo el permiso obtneido
        //recuerda que 
        //   1 es admin
        //   2 es mobile
        if ($ru->pluck('role_id')->first() == 2) {
          // Si todo sale bien retornamos el token :)
          return response()->json(compact('token'), 200);

        } else {
          //si el id_rol no es de mobile mandar error
          return response()->json(['error'=>true,'message'=>'Este usuario no es de mobile.'], 401);

        }


    }

    //Register
    public function register(Request $request){

      //validadno que no exista el email
      if (User::where('email','=',$request->email)->first()) {
        return response()->json(['error'=>true,'message'=>'El Email ingresado ya existe.'], 200);
      } else {
        //Si el usuario no exite, entonces comenzamos 
        //llenando los datos del nuevo usuario
        $u = new User();
        $u->nombre  = $request->nombre;
        $u->email  = $request->email;
        $u->apellido  = $request->apellido;
        $u->fecha_nac  = $request->fecha_nac;
        $u->fecha_ingreso_uvm  = $request->fecha_ingreso_uvm;
        $u->celular  = $request->celular;
        $u->puesto  = $request->puesto;
        $u->campus  = $request->campus;
        $u->num_empleado  = $request->num_empleado;
        $u->metas_ni  = $request->metas_ni;
        $u->metas_pno  = $request->metas_pno;
        $u->password = bcrypt($request->password);
        $u->name = $request->nombre.' '.$request->apellido;
        $u->is_active= true;
        
        //Guardo el nuevo user
        $u->save();


        //Estableciendo los permisos 
        $ru = new Role_User;
        $ru->user_id = $u->id;
        $ru->role_id = 2;
        $ru->save();
      }

      //obteniendo el login del user recien registrado
      $credenciales = array('email' => $u->email, 'password' => $request->password);

      try {
            if (! $token = JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'credenciales_invalidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'no_se_ha_podido_crear_el_token'], 500);
        }

      return response()->json(['error'=>false,'message'=>'Usuario creado exitosamente', 'token'=>$token], 200);
    }
    /**
     * Fin de metodos para el Login
     */




    public function user(){
        return JWTAuth::parseToken()->authenticate();
    }

    public function getTest(){
        //$newToken = JWTAuth::parseToken()->refresh();
        //$user = JWTAuth::parseToken()->authenticate();
        return response()->json($this->user());
    }

    public function deleteTest(){
        //$user = JWTAuth::parseToken()->authenticate();
        if($this->user()) $this->user()->delete();
        return response()->json(['error'=>false,'message'=>'Usuario eliminado exitosamente']);
    }


    /*
     * email
     * password
     *
     */
    public function postSignIn(Request $request){
        $credentials = $request->only('email','password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>1,'message'=>'invalid_credentials'],401);
            }
        }catch (JWTException $e){
            return response()->json(['error'=>1,'message'=>'could_not_create_token'],500);
        }

        //todo bien


        //JWTAuth::setToken($token);

        $error=false;
        $profile = JWTAuth::authenticate($token)->jsonProfile();
        return response()->json(compact('error','token', 'profile'));

    }



    /*
     * email
     * password
     * name
     * last_name
     * day_of_birth (AAAA-MM-DD)
     * sex
     * marital_status
     * state
     * city
     * zip
     * address
     *
     */
    public function postSignUp(SignUpRequest $request){
        $user = User::signUp($request);
        if (!$user)return response()->json(['error'=>1,'message'=>'El email ya fue registrado']);
        return response()->json(['error'=>false,'message'=>'Cuenta creada exitosamente']);

    }


    /*
     *
     *
     */
    public function getProfile(){
        $u = $this->user();
            return response()->json(['error'=>false,'profile'=>$u->jsonProfile()]);
    }


    /*
     *  email
     *  name
     *  last_name
     *  day_of_birth
     *  sex
     *  marital_status
     *  state
     *  city
     *  zip
     *  address
     *
     */
    public function postProfile(Request $request){
        $u = $this->user();

        $updateParams = [];
        if($request->email){
            $updateParams['email'] = $request->email;
        }
        if($request->name){
            $updateParams['name'] = $request->name;
        }
        if($request->password){
            $updateParams['password'] = bcrypt($request->password);
        }
        if(count($updateParams)) $u->update($updateParams);

        $updateParams = [];
        if($request->last_name){
            $updateParams['last_name'] = $request->last_name;
        }
        if($request->day_of_birth){
            $updateParams['day_of_birth'] = $request->day_of_birth;
        }
        if($request->sex){
            $updateParams['sex'] = $request->sex;
        }
        if($request->marital_status){
            $updateParams['marital_status'] = $request->marital_status;
        }
        if($request->state){
            $updateParams['state'] = $request->state;
        }
        if($request->city){
            $updateParams['city'] = $request->city;
        }
        if($request->zip){
            $updateParams['zip'] = $request->zip;
        }
        if($request->address){
            $updateParams['address'] = $request->address;
        }

        if(count($updateParams)) $u->survey_respondent()->update($updateParams);

        return response()->json(['error'=>false,'profile'=>$u->jsonProfile()]);
    }



    /*
     *
     *
     */
    public function getQuiz(Request $request){

        if(!$this->user()->haveNsl()){
            //Send NSL Quiz
            $quizzes = Quiz::forService(1,$this->user());

        }else{
            //Send Quizzes for him
            $quizzes = Quiz::forService(false, $this->user());
        }

        return response()->json(['error'=>false,'quizzes'=>$quizzes]);
    }


    /*
     *  id
     *  answers_json
     *
     *  Opcion Multiple
     *  [
     *      {
     *          question_id: x,
     *          answer: put_answer_id
     *      },
     *      {
     *          question_id: x,
     *          answer: put_answer_id
     *      }
     *  ]
     *
     *  Multiopcion
     *  [
     *      {
     *          question_id: x,
     *          answer: [
     *              answer_id,
     *              answer_id,
     *              answer_id,
     *          ]
     *      },
     *      {
     *          question_id: x,
     *          answer: [
     *              answer_id
     *          ]
     *      }
     *  ]
     *
     *  Abierta
     *  [
     *      {
     *          question_id: x,
     *          answer: text
     *      },
     *      {
     *          question_id: x,
     *          answer: text
     *      }
     *  ]
     *
     *
     */
    public function postQuiz(QuizRequest $request){

        $user = $this->user();

        if(!$quiz = Quiz::find($request->id)) return response()->json(['error'=>1,'message'=>'El id del quiz no se encuentra']);

        if(!$answers = json_decode($request->answers_json)) return response()->json(['error'=>1,'message'=>'No existe ninguna respuesta válida']);

        if($quiz->users()->find($user->id)) return response()->json(['error'=>1,'message'=>'El quiz ya fue contestado']);

        if(!is_array($answers)) return response()->json(['error'=>1,'message'=>'El parametro answers_json debe ser un array json']);

        //Verify
        foreach($quiz->questions as $q){

            switch($q->type){
                case "Opcion Multiple":

                    $exist = false;
                    foreach($answers as $a){
                        if($q->id != $a->question_id) continue;
                        if(!isset($a->question_id) || !isset($a->answer)) return response()->json(['error'=>1,'message'=>'a) No existen los nodos question_id y/o answer en el parametro answers_json']);
                        if($q->id == $a->question_id) $exist = true;
                        if($q->id == $a->question_id && !$q->answers()->find($a->answer)) return response()->json(['error'=>1,'message'=>'No existe una de las respuestas']);

                    }
                    if(!$exist) return response()->json(['error'=>1,'message'=>'Se deben especificar todas las respuestas del cuestionario']);
                    break;

                case "Multiopcion":

                    $exist = false;
                    foreach($answers as $answer){
                        if($q->id != $answer->question_id) continue;
                        if(!is_array($answer->answer)) return response()->json(['error'=>1,'message'=>'Las respuestas de preguntas MULTIOPCION deben ser arrays']);
                        if(!isset($answer->question_id) || !isset($answer->answer)) return response()->json(['error'=>1,'message'=>'b) No existen los nodos question_id y/o answer en el parametro answers_json']);
                        if($q->id == $answer->question_id) $exist = true;

                        foreach($answer->answer as $a){

                            if(!$q->answers()->find($a)) return response()->json(['error'=>1,'message'=>'No existe una de las respuestas']);
                        }

                    }
                    if(!$exist) return response()->json(['error'=>1,'message'=>'Se deben especificar todas las respuestas del cuestionario']);
                    break;

                case "Abierta":

                    $exist = false;
                    foreach($answers as $a){
                        if($q->id != $a->question_id) continue;
                        if(!isset($a->question_id) || !isset($a->answer)) return response()->json(['error'=>1,'message'=>'a) No existen los nodos question_id y/o answer en el parametro answers_json']);
                        if($q->id == $a->question_id) $exist = true;
                        if(!$a->answer) return response()->json(['error'=>1,'message'=>'Se debe especificar las respuestas a preguntas abiertas']);

                    }
                    if(!$exist) return response()->json(['error'=>1,'message'=>'ddd)Se deben especificar todas las respuestas del cuestionario']);
                    break;
            }

        }
        //End Verify
        //dd("ok");
        //Save Info
        $quiz->createFromWS($request, $user);
        $quizzes = Quiz::forService(false, $user);

        return response()->json(['error'=>false,'message'=>'ok', 'quizzes'=>$quizzes]);

    }


    /*
     *
     */
    public function quiz_delete($id){

        $user = $this->user();
        $user->quizzes()->detach($id);
        $user->calculateEarnedPoints();

        if($id==1){
            $user->survey_respondent()->update(['nse_points'=>0]);
        }

        return response()->json(['error'=>false,'message'=>'ok']);

    }


    public function postRecoverPassword(Request $request){

        if(User::where('email',$request->email)->first()){
            $x =  $this->sendResetLinkEmail($request);
            return response()->json(['error'=>false,'message'=>'El link de recuperación de contraseña se ha enviado.'], 200);
        }else{
            return response()->json(['error'=>true,'message'=>'Email no registrado'], 404);
        }

    }


    /**
     * Obtenre reglas del juego
     */
    public function reglasdeljuego(Request $request){
        
        $reglas = Regla::where('is_active', '=', 1)->get(['regla', 'descripcion_regla']);

        return response()->json(['error'=> false, 'reglas'=>$reglas], 200);


    }


    /**
     * Obtener las fechas
     */
    public function fechas(Request $request){
        
        $fechas = Fecha::where('is_active', '=', 1)->get(['fecha', 'descripcion_fecha']);

        return response()->json(['error'=> false, 'fechas'=>$fechas], 200);
    }



    /**
     * Obtener los premios
     */
    public function premios(Request $request){

        $premios = Premios::where('is_active', '=', 1)->get(['premios', 'descripcion_premios']);

        return response()->json(['error'=> false, 'premios'=>$premios], 200);
    }


    /**
     * Obtener las categorias y subcategorias
     */
    public function categorias(Request $request){

        $categorias = Categorias::where('is_active',1)->get(['id','categoria']);
        $subcategorias = Subcategorias::where('is_active', 1)->get(['id', 'categoria_id','subcategoria']);
        
        return response()->json(['error'=> false, 'categorias'=>$categorias, 'subcategorias' => $subcategorias], 200);
    }



    /**
     * Obtener las iniciativas
     */
    public function iniciativas(Request $request){

        $iniciativas = Iniciativa::where('is_active', '=', 1)->get(['iniciativa']);

        return response()->json(['error'=> false, 'iniciativas'=>$iniciativas], 200);
    }






}


