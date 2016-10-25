<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use App\Models\Votaciones;
use App\Models\IniciativasDetalles;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\User;
use DB;

class Iniciativa extends Model
{

	protected $table = 'iniciativas';
	protected $fillable = ['iniciativa', 'is_active'];
	
	protected $hidden = ['created_at', 'updated_at'];

	public function users(){
	 return $this->belongsTo('App\Models\User', 'id_user');
	}
	
	
  public function votaciones(){
    return $this->hasMany('App\Models\Votaciones');
  }


  public function comments(){
	 return $this->hasMany('App\Models\Comments', 'id_iniciativa');
  }
  
	public static function subcategorias($id_subcategoria){
			return Subcategorias::with('id', $id_subcategoria)
                     ->get();
	}



public static function categoria($id_categoria){

	return Categorias::where('id', $id_categoria)->first(['id','categoria']);
}



	public static function votos($id_iniciativa){
		     $votos =  DB::table('iniciativas_votaciones')
                     ->select(DB::raw('TRUNCATE (avg(calificacion), 1) as calificacion, iniciativas_id'))
                     ->where('iniciativas_id', $id_iniciativa)
                     ->get();
			$data = [];
			foreach($votos as $voto){
				$data=[
					'calificacion' => $voto->calificacion,
					'iniciativa_id' => $voto->iniciativas_id
				];
			}
			
		return $data;
	}
	
	
	public static function propuestas($id_iniciativa){
			return DB::table('iniciativas_propuestas')->where('id_iniciativas', $id_iniciativa)->lists("descripcion");
	}

	public static function indicadores($id_iniciativa){
			return DB::table('iniciativas_indicadores')->where('id_iniciativas', $id_iniciativa)->lists("id_indicadores");
	}


	public static function detalles($id_iniciativa){
		$detalles = IniciativasDetalles::where('id_iniciativas', $id_iniciativa)->get(['id_iniciativas', 'id_categoria', 'id_subcategoria', 'id_user', 'propuesta', 'orden_propuesta', 'evidencia_video', 'evidencia_foto', 'evidencia_texto', 'is_active']);
		
		$data = [];
		foreach ($detalles as $c) {
			$data = [
								'id_iniciativas'  => $c->id_iniciativas, 
								'id_categoria'    => $c->id_categoria, 
								'categoria'       => $c->categoria($c->id_categoria),
								'id_subcategoria' => $c->id_subcategoria,  
								//'subcategoria'    => $c->subcategorias($c->subcategoria),  
								'id_user'         => $c->id_user, 
								'propuesta'       => $c->propuesta, 
								'orden_propuesta' => $c->orden_propuesta, 
								'evidencia_video' => $c->evidencia_video, 
								'evidencia_foto'  => $c->evidencia_foto, 
								'evidencia_texto' => $c->evidencia_texto, 
								'is_active'       => $c->is_active
								];
		}
		return $data;

	}

	public static function detallados($id_iniciativa, $id_user){
		$detalles = IniciativasDetalles::where('id_iniciativas', $id_iniciativa)->where('id_user', $id_user)->get(['id_iniciativas', 'id_categoria', 'id_subcategoria', 'id_user', 'propuesta', 'orden_propuesta', 'evidencia_video', 'evidencia_foto', 'evidencia_texto', 'is_active']);
		
		$data = [];
		foreach ($detalles as $c) {
			$data = [
								'id_iniciativas'  => $c->id_iniciativas, 
								'id_categoria'    => $c->id_categoria, 
								'categoria'       => $c->categoria($c->id_categoria),
								'id_subcategoria' => $c->id_subcategoria,  
								//'subcategoria'    => $c->subcategorias($c->subcategoria),  
								'id_user'         => $c->id_user, 
								'propuesta'       => $c->propuesta, 
								'orden_propuesta' => $c->orden_propuesta, 
								'evidencia_video' => $c->evidencia_video, 
								'evidencia_foto'  => $c->evidencia_foto, 
								'evidencia_texto' => $c->evidencia_texto, 
								'is_active'       => $c->is_active
								];
		}
		return $data;

	}
	
	public static function groupByCategory($data){
			
		$array = ["destreza" => ["tecnicas_de_venta"=>array(),
								 "oferta_academica" => array(),
								 "generacion_de_base_de_datos"=>array(),
								 "gestion_de_base_de_datos"=>array(),
								 "manejo_del_tiempo"=>array(),
								],
				  "uso_de_herramientas" => [
								  "salesforce" => array(),
								"comunidad_comercial_uvm" => array(),
								"microstrategy" => array(),
								"blackboard" => array(),
								"herramientas_de_venta" => array(),
								],
				  "desarrollo_de_talento" => [
								 "colaboracion" => array(),
								"clima_laboral" => array(),
								"crecimiento" => array(),
								"productividad" => array(),
							]
				];
		
		foreach($data as $value){
			switch("{$value['id_categoria']}-{$value['id_subcategoria']}"){
				case "1-6":
					$array["destreza"]["tecnicas_de_venta"][] =  $value;
				break;
				case "1-9":
					$array["destreza"]["oferta_academica"][] =  $value;
				break;
				case "1-10":
					$array["destreza"]["generacion_de_base_de_datos"][] =  $value;
				break;
				case "1-11":
					$array["destreza"]["gestion_de_base_de_datos"][] =  $value;
				break;
				case "1-12":
					$array["destreza"]["manejo_del_tiempo"][] =  $value;
				break;
				
				case "2-7":
					$array["uso_de_herramientas"]["salesforce"][] =  $value;
				break;
				case "2-13":
					$array["uso_de_herramientas"]["comunidad_comercial_uvm"][] =  $value;
				break;
				case "2-14":
					$array["uso_de_herramientas"]["microstrategy"][] =  $value;
				break;
				case "2-15":
					$array["uso_de_herramientas"]["blackboard"][] =  $value;
				break;
				case "2-16":
					$array["uso_de_herramientas"]["herramientas_de_venta"][] =  $value;
				break;
				
				case "3-8":
					$array["desarrollo_de_talento"]["colaboracion"][] =  $value;
				break;
				case "3-17":
					$array["desarrollo_de_talento"]["clima_laboral"][] =  $value;
				break;
				case "3-18":
					$array["desarrollo_de_talento"]["crecimiento"][] =  $value;
				break;
				case "3-19":
					$array["desarrollo_de_talento"]["productividad"][] =  $value;
				break;
			}
		}
		
		//return $array ;
		return $data;
	
	}

	
	
	public static function allForJsondetallando(){

		$data = [];

		foreach(self::all() as $c){
			$item = $c->toArray();
			$item["votaciones"]  = $c->votos($c->id);
			$item["propuestas"]  = $c->propuestas($c->id);
			$item["indicadores"] = $c->indicadores($c->id);
			
			$users = User::findOrFail($c->id_user);
			$array["name"] = $users->name;
			$array["campus"] = $users->campus;
			$array["foto"] = $users->foto;
			$item["users"] = $array;
			
			
			
			$item["subcategoria"] = Subcategorias::findOrFail($c->id_subcategoria) ;
			$item["categoria"] = self::categoria($c->id_categoria);
			
			unset($item["created_at"]);
			unset($item["updated_at"]);
			$data[] = $item;
		}
		$data = self::groupByCategory($data);
		return $data;
	}

	public static function top_ten(){
		
			$topten =  DB::table('votaciones')
                     ->select(DB::raw('avg(calificacion) as calificacion, id_iniciativa'))
                     ->orderBy('calificacion', 'DESC')
                     ->groupBy('id_iniciativa')
                     ->take(10)
                     ->lists("id_iniciativa");
                     
			$iniciativas = Iniciativa::whereIn("id", $topten)->get();
			$data 	     = [];

			foreach($iniciativas as $c){
				$item = $c->toArray();
				$item["votaciones"]  = $c->votos($c->id);
				$item["propuestas"]  = $c->propuestas($c->id);
				$item["indicadores"] = $c->indicadores($c->id);
				
				$users = User::findOrFail($c->id_user);
				$array["name"] = $users->name;
				$array["campus"] = $users->campus;
				$array["foto"] = $users->foto;
				$item["users"] = $array;
				
				$item["subcategoria"] = Subcategorias::findOrFail($c->id_subcategoria) ;
				$item["categoria"] = self::categoria($c->id_categoria);
				
				
				unset($item["created_at"]);
				unset($item["updated_at"]);
				$data[] = $item;
			}
			$data = self::groupByCategory($data);
			return $data;

	}


	public static function allForJson($id){

		$data = [];
		$items = self::where("id_user", "=", $id)->get();
		
		foreach($items as $c){
			$item = $c->toArray();
			$item["votaciones"]  = $c->votos($c->id);
			$item["propuestas"]  = $c->propuestas($c->id);
			$item["indicadores"] = $c->indicadores($c->id);
			
			
			$users = User::findOrFail($c->id_user);
			$array["name"] = $users->name;
			$array["campus"] = $users->campus;
			$array["foto"] = $users->foto;
			$item["users"] = $array;
			
			
			$item["subcategoria"] = Subcategorias::findOrFail($c->id_subcategoria) ;
			$item["categoria"] = self::categoria($c->id_categoria);
			
			unset($item["created_at"]);
			unset($item["updated_at"]);
			$data[] = $item;
		}
		return $data;
	}
	 
	
	public static function allForJsonSearch($search){

		$data = [];
		$items = self::where(function($query) use($search){
					$query->orWhere('titulo', 'LIKE', "%{$search}%");
					$query->orWhere('descripcion', 'LIKE', "%{$search}%");
		})->get();
		
		foreach($items as $c){
			$item = $c->toArray();
			$item["votaciones"]  = $c->votos($c->id);
			$item["propuestas"]  = $c->propuestas($c->id);
			$item["indicadores"] = $c->indicadores($c->id);
			
			
			$users = User::findOrFail($c->id_user);
			$array["name"] = $users->name;
			$array["campus"] = $users->campus;
			$array["foto"] = $users->foto;
			$item["users"] = $array;
			
			$item["subcategoria"] = Subcategorias::findOrFail($c->id_subcategoria) ;
			$item["categoria"] = self::categoria($c->id_categoria);
			
			unset($item["created_at"]);
			unset($item["updated_at"]);
			$data[] = $item;
		}
		$data = self::groupByCategory($data);
		return $data;
	}





}
