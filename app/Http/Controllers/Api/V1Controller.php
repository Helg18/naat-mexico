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
use App\Models\IniciativasDetalles;
use App\Models\Indicadores;
use App\Models\Tips;
use App\Models\Votaciones;
use App\Models\Tips_votaciones;
use App\Models\Iniciativas_votaciones;
use App\Models\Preguntas;
use App\Models\Respuestas;
use App\Models\Comments;
use App\Models\Decalogo;



use DB;
use JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Hash;
use Validator;
use Input;
use File;
use Storage;

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
                return response()->json(['error'=>true, 'mensaje' => 'credenciales_invalidas'], 401);
            }
        } catch (JWTException $e) {
            // Algo salio mal al intentar crear el token :(
            return response()->json(['error'=>true, 'mensaje'=> 'no_se_ha_podido_crear_el_token'], 401);
        }


        //verificar que el usuario que inicia sesion sea de mobile
        //$u = User::where('email','=', $request->email)->get();
        
        //$id_user = $u->pluck('id')->first();

        //Consulto el permiso segun el id del usuario
        //$ru = Role_User::where('user_id','=', $id_user)->get();

        //comparo el permiso obtneido
        //recuerda que 
        //   1 es admin
        //   2 es mobile
        //if ($ru->pluck('role_id')->first() == 2) {
          // Si todo sale bien retornamos el token :)
          return response()->json(compact('token'), 200);

        //} else {
          //si el id_rol no es de mobile mandar error
          //return response()->json(['error'=>true,'message'=>'Este usuario no es de mobile.'], 401);

        //}


    }

    //Register
    public function register(Request $request){

	
      //validadno que no exista el email
      if (User::where('email','=',$request->email)->first()) {
        return response()->json(['error'=>true,'message'=>'El Email ingresado ya existe.'], 200);
      } else {
	  
	  
		$_uploadFile = $this->_uploadFile("default.jpg", "foto", uniqid(), "/img/", $request);
		
		
		$rules =  [
			'nombre' => 'required',
			'email' => 'required|email|unique:users,email',
			'apellido' => 'required',
			'fecha_nac' => 'required',
			'fecha_ingreso_uvm' => 'required',
			'celular' => 'required',
			'puesto' => 'required',
			'campus' => 'required',
			'password' => 'required',
			'num_empleado' => 'required',
		];
		 $validation = Validator::make($request->toArray(), $rules);
         if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		 }
		
			
		
        //Si el usuario no exite, entonces comenzamos 
        //llenando los datos del nuevo usuario
        $u = new User();
        $u->nombre  = $request->nombre;
        $u->email  = $request->email;
        $u->apellido  = $request->apellido;
        $u->foto  = $_uploadFile;
        $u->fecha_nac  = $request->fecha_nac;
        $u->fecha_ingreso_uvm  = $request->fecha_ingreso_uvm;
        $u->celular  = $request->celular;
        $u->puesto  = $request->puesto;
        $u->campus  = $request->campus;
        $u->num_empleado  = $request->num_empleado;
        $u->metas_ni  = isset($request->metas_ni)? $request->metas_ni : "" ;
        $u->metas_pno  = isset($request->metas_pno)? $request->metas_pno : "" ;
		$u->metas_rev  = isset($request->metas_rev)? $request->metas_rev : "" ;
		$u->metas_registros  = isset($request->metas_registros)? $request->metas_registros : "" ;
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
                return response()->json(['error'=>true, 'mensaje' => 'credenciales_invalidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error'=>true, 'mensaje' => 'no_se_ha_podido_crear_el_token'], 401);
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
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(['error'=>false,'profile'=>$user]);
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
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
		$u = $user;
		
		$_uploadFile = $this->_uploadFile($u->foto, "foto", uniqid(), "/img/", $request);
		
		
		
		$rules =  [
			'nombre' => 'required',
			'apellido' => 'required',
			'fecha_ingreso_uvm' => '',
			'celular' => 'required',
			'puesto' => 'required',
			'num_empleado' => 'required',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
		

			
		$u = User::findOrFail($user->id);
        $u->nombre  = $request->nombre;
		$u->apellido  = $request->apellido;
		$u->foto  = $_uploadFile;
        $u->fecha_ingreso_uvm  = $request->fecha_ingreso_uvm;
		$u->celular  = $request->celular;
        $u->puesto  = $request->puesto;
		$u->num_empleado  = $request->num_empleado;
		if(isset($request->password)){
			$u->password = bcrypt($request->password);
		}
		$u->save();

        return response()->json(['error'=>false,'profile'=>$u]);
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
        $iniciativas = Iniciativa::where('is_active', '=', 1)->get(['id', 'titulo']);
        $valoraciones = DB::table('votaciones')
                     ->select(DB::raw('avg(calificacion) as calificacion, iniciativa_id'))
                     ->orderBy('calificacion', 'DESC')
                     ->groupBy('iniciativa_id')
                     ->get();

			 
					 
					 
        return response()->json(['error'=> false, 'iniciativas'=>Iniciativa::allForJsondetallando()], 200);
    }

    /**
     * Obtener las iniciativas
     */
    public function guardar_iniciativas(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
		
		
		$rules =  [
			'titulo' => 'required',
			'descripcion' => 'required',
			'categoria_id' => 'required',
			'id_subcategoria' => 'required',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
		
		
		
	    //guardo la iniciativa
        $iniciativas = new Iniciativa();
        $iniciativas->titulo      = $request->titulo;
        $iniciativas->descripcion = $request->descripcion;

        //guardo la nueva relacion de iniciativas_detalles
        $iniciativas->id_categoria     = $request->categoria_id;
        $iniciativas->id_subcategoria  = $request->id_subcategoria;
        $iniciativas->id_user          = $user->id;
        //$iniciativas->propuesta        = $request->propuesta;
        //$iniciativas->orden_propuesta  = $request->orden_propuesta;
        $iniciativas->evidencia_video  = isset($request->evidencia_video)? $request->evidencia_video : "";
        $iniciativas->evidencia_foto   = isset($request->evidencia_foto)? $request->evidencia_foto : "" ;
        $iniciativas->evidencia_texto  = isset($request->evidencia_texto)? $request->evidencia_texto : "";
        $iniciativas->is_active = 1;
        $iniciativas->save();
    
		
		$indicadores = $request->indicadores;
		foreach ($indicadores as $indicador) {
			DB::table("iniciativas_indicadores")->insert(["id_indicadores"=>$indicador, "id_iniciativas"=>$iniciativas->id]);
		}
		
		$propuestas = $request->propuestas;
		foreach ($propuestas as $propuesta) {
			DB::table("iniciativas_propuestas")->insert(["descripcion"=>$propuesta, "id_iniciativas"=>$iniciativas->id]);
		}
		
		
        return response()->json(['error'=> false, 'mensaje'=>'Iniciativas guardadas con exito'], 200);
    }




    /**
     * Obtener los decalogos
     */
    public function decalogos(Request $request){

        $decalogos = Decalogo::where('is_active', '=', 1)->get(['id', 'decalogo']);

        return response()->json(['error'=> false, 'decalogos'=>$decalogos], 200);
    }



    /**
     * Listar tips _> MIS TIPS
     */
    public function tips(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;

        $tips = Tips::allForJson();

        return response()->json(['error'=> false, 'data' => $tips], 200);
    }



    /**
     * Listar tips
     */
    public function guardar_tips(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

		
		$rules =  [
			'titulo' => 'required',
			'comentario' => 'required',
			'id_categoria' => 'required|numeric|min:1',
			'id_subcategoria' => 'required|numeric|min:1',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
		
		
        $t                  = new Tips;
        $t->tip             = $request->titulo;
        $t->comentario      = $request->comentario;
        $t->id_user         = $user->id;
        $t->id_categoria    = $request->id_categoria;
        $t->id_subcategoria = $request->id_subcategoria;
        $t->is_active = 1;
        $t->save();


        //retornamos los valores obtenidos
        return response()->json([
            'error'         => false, 
            'mensaje'       => 'Tip guardado exitosamente'
            ], 200);
    }


    /**
     * Guardar votacion
     */
    public function guardar_votaciones(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

		
		$rules = Votaciones::where('id_iniciativa', '=', $request->id_iniciativa)
					->where('id_user', '=', $user->id)
					->first();
		if($rules !== null){
			  return response()->json(['error'=> true, 'mensaje'=>'Ya haz votado por esta iniciativa'], 401);
		}
		
		
        //creando un objeto vacio
        $votaciones = new Votaciones();

        //llenando los datos del objeto con los traido del request
        $votaciones->id_iniciativa = $request->id_iniciativa;
        $votaciones->calificacion = $request->calificacion;
        $votaciones->comentario = $request->comentario;
        $votaciones->id_user = $user->id;

        $votaciones->save();

        return response()->json(['error'=> false, 'mensaje'=>'La calificafion de la iniciativa fue recibida exitosamente'], 200);
    }


    /**
     * Obtener las votaciones
     */
    public function listar_votaciones(Request $request){

        $votaciones = Votaciones::get([
            'id', 
            'calificacion', 
            'id_iniciativa', 
            'id_user'
            ]);

        $iniciativa = Iniciativa::where('is_active', 1)->get(['id', 'titulo']);
        $user = User::get(['id', 'name']);

        return response()->json([
            'error'=> false, 
            'votaciones'=>$votaciones,
            'iniciativa'=>$iniciativa,
            'users'     =>$user
            ], 200);
    }

    /**
     * Obtener las votaciones
     */
    public function top_ten(Request $request){

        $topten = Iniciativa::top_ten();

        return response()->json([
            'error'      => false, 
            'topten'    => $topten
            ], 200);
    }


    /**
     * Listar tips
     */
    public function listar_tips(Request $request){

        $categorias    = Categorias::where('is_active',1)->get(['id','categoria']);
        $subcategorias = Subcategorias::where('is_active', 1)->get(['id', 'categoria_id','subcategoria']);

        $tips = Tips::where('is_active', '=', 1)         // obteniendo los tips activos
                    ->get([ 'id',
							'tip',                       // Obteniendo las columnas que nos interesan
                            'comentario', 
                            'id_user',
                            'id_categoria',
                            'id_subcategoria']);

        $valoraciones = DB::table('tips_votaciones')
                        ->select(DB::raw('avg(calificacion) as calificacion, tip_id'))
                        ->orderBy('calificacion', 'DESC')
                        ->groupBy('tip_id')
                        ->get();
        
		
		foreach($tips as $key => $value){
			$array["name"] = $value->users->name;
			$array["campus"] = $value->users->campus;
			$array["foto"] = $value->users->foto;
			
		
			$votos = Tips::votos($value->id);
			$categoria = Tips::categoria($value->id_categoria);
			$subcategoria = Tips::subcategoria($value->id_subcategoria);
		
			$value = $value->toArray();
			
			$value["votaciones"] = $votos;
			$value["categoria"] = $categoria;
			$value["subcategoria"] = $subcategoria;
			$value["users"] = $array;
			
			$tips[$key] = $value;
			
		}
		

        //retornamos los valores obtenidos
        return response()->json([
            'error'             => false, 
            'tips'              => $tips, 
            'categorias'        => $categorias,
            'subcategorias'     => $subcategorias,
            'calificacion_tips' => $valoraciones
            ], 200);
    }



    /**
     * Obtener mis iniciativas ( iniciativas dek usuario logueado)
     */
    public function misiniciativas(Request $request){

        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

        $iniciativas = Iniciativa::allForJson($user->id);

	

        return response()->json(['error'=> false, 'data' => $iniciativas], 200);

       

    }



    /**
     * Guardar preguntas
     */
    public function guardar_pregunta(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

        $pregunta = new Preguntas();
        $pregunta->pregunta=$request->pregunta;
        $pregunta->user_id=$user->id;
        $pregunta->save();
        
        return response()->json(['error'=> false, 'mensaje' => 'Pregunta guardada con exito'], 200);
    }


    /**
     * Guardar respuestas
     */
    public function guardar_respuesta(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

        $p = Preguntas::find($request->preguntas_id);

        $respuestas = new Respuestas();
        $respuestas->respuesta=$request->respuesta;
        $respuestas->preguntas_id=$request->preguntas_id;
        $respuestas->user_id=$user->id;
        $respuestas->quien_pregunto=$user->id;
        $respuestas->save();
        
        return response()->json(['error'=> false, 'mensaje' => 'Respuesta guardada con exito'], 200);
    }


    /**
     * Listar las preguntas y respuestas
     */
    public function preguntas_respuestas(Request $request){
        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

        $preguntas = Preguntas::where('user_id', $user->id)->get(['id','pregunta']);
        $respuestas = Respuestas::where('quien_pregunto', $user->id)->get(['id', 'respuesta', 'preguntas_id']);
        
        return response()->json(['error'=> false, 'preguntas'=> $preguntas, 'respuestas' => $respuestas ], 200);
    }





    /**
     * Guardar votaciones de los tips
     */
    public function guardar_votaciones_tips(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

		
		$rules = Tips_votaciones::where('tip_id', '=', $request->tip_id)
					->where('id_user', '=', $user->id)
					->first();
		if($rules !== null){
			  return response()->json(['error'=> true, 'mensaje'=>'Ya haz votado por este tip'], 401);
		}
		
		
        //creando un objeto vacio
        $votaciones = new Tips_votaciones();

        //llenando los datos del objeto con los traido del request
        $votaciones->tip_id       = $request->tip_id;
        $votaciones->calificacion = $request->calificacion;
        $votaciones->comentario   = $request->comentario;
        $votaciones->id_user      = $user->id;

        $votaciones->save();

        return response()->json(['error'=> false, 'mensaje'=>'La calificafion del tip fue recibida exitosamente'], 200);
    }


    /**
     * Guardar votaciones de los tips
     */
    public function guardar_votaciones_iniciativas(Request $request){

        //obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

		$rules = Iniciativas_votaciones::where('iniciativas_id', '=', $request->iniciativas_id)
					->where('id_user', '=', $user->id)
					->first();
		if($rules !== null){
			  return response()->json(['error'=> true, 'mensaje'=>'Ya haz votado por esta inicativa'], 401);
		}
        //creando un objeto vacio
        $votaciones = new Iniciativas_votaciones();

        //llenando los datos del objeto con los traido del request
        $votaciones->iniciativas_id = $request->iniciativas_id;
        $votaciones->calificacion   = $request->calificacion;
        $votaciones->comentario     = $request->comentario;
        $votaciones->id_user        = $user->id;

        $votaciones->save();

        return response()->json(['error'=> false, 'mensaje'=>'La calificafion de la iniciativa fue recibida exitosamente'], 200);
    }


	
	public function postUpdateMetas(Request $request){
	
		//obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
	
	
		$rules =  [
			'meta' => 'required',
			'value' => 'required',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
	
	
		$update = DB::table('users')
					->where('id', '=', $user->id)
					->update(["{$request->meta}" => $request->value]);
		
		return response()->json(['error'=> false, 'mensaje'=>"La de la meta {$request->meta} ha sido actulizada"], 200);
		
	}

	
	
	public function getDetailIniciativa(Request $request){
		$rules =  [
			'id' => 'required',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
		
		$data = Iniciativa::findOrFail($request->id);
		$indicadores = Iniciativa::indicadores($request->id);
		$data->offsetSet('indicadores', Indicadores::whereIn('id', $indicadores)->get(['id', 'titulo']) );
		$data->offsetSet('propuestas', Iniciativa::propuestas($request->id) );
		
		foreach($data->comments as $key => $value){
			$data->comments[$key]->offsetSet('name', $value->users->name );
			unset($data->comments[$key]->users);
		}
		$data->offsetSet('comments', $data->comments );
		
		return response()->json(['error'=> false, 'mensaje'=>"Detalle de iniciativa", 'data'=>	$data], 200);
	
	}
	 
	
	public function postComment(Request $request){
		//obteniendo el user del token
        $user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
		
		$rules =  [
			'id_iniciativa' => 'required',
			'comentario' => 'required',
		];
		
		$validation = Validator::make($request->toArray(), $rules);
        if ($validation->fails()) {
			return response()->json(['error'=>true,'message'=>$validation->messages()], 200);
		}
		
		
		$data = new Comments();
		$data->comentario = $request->comentario;
		$data->id_iniciativa = $request->id_iniciativa;
		$data->id_user = $user->id;
		$data->save();
		
		$data = Comments::where('id_iniciativa', '=', $request->id_iniciativa)->get();
		foreach($data as $key => $value){
			$value->name = $value->users->name;//$value->users->name;
		}
		
		$data = $data->toArray();
		foreach($data as $key => $value){
			unset($data[$key]['users']);
		}
		
		return response()->json(['error'=> false, 'mensaje'=>"Comentarios iniciativa", 'data'=>$data], 200);

	}
	
	
	
	
	public function getSearch(Request $request){
		
		$user = JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();
		
		$data = Iniciativa::allForJsonSearch($request->search);
		return response()->json(['error'=> false, 'mensaje'=>"Resultado de busquedaa", 'data'=>$data], 200);
	}
	
	
	
	
	
	
	
	/*************
	 * PRIVATE FUNCTIONS 
	 *************/
	private function _uploadFile($default, $getFile = null, $name = null, $path = null, $request){
        //$file->getClientOriginalName();
        //$file->getClientMimeType();
        //$file->getClientSize();
        //$file->getClientOriginalExtension();
        //$file->getMaxFilesize();
        //$file->getErrorMessage();


        if($request->hasFile("{$getFile}")){


            $file 	   = $request->file("{$getFile}");
            $name = empty($name)? $file->getClientOriginalName() : "{$name}.{$file->getClientOriginalExtension()}";

				
            //indicamos que queremos guardar un nuevo archivo en el disco local
			$file->move(public_path("{$path}"), $name );
            //Storage::disk('local')->put("{$path}{$name}",  File::get($file));
            return $name;
          


        }

		return $default;
	}


	


}// fin de la clase


