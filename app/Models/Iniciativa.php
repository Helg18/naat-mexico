<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Votaciones;
use App\Models\IniciativasDetalles;
use App\Models\Categorias;
use App\Models\Subcategorias;
use DB;

class Iniciativa extends Model
{
	protected $table = 'iniciativas';
	protected $fillable = ['iniciativa', 'is_active'];

  public function votaciones(){
    return $this->hasMany('App\Models\Votaciones');
  }


	public static function subcategorias($id_subcategoria){
			return Subcategorias::with('id', $id_subcategoria)
                     ->get();
	}



public static function categoria($id_categoria){

	return Categorias::where('id', $id_categoria)->first(['categoria']);
}



	public static function votos($id_iniciativa){
			return DB::table('votaciones')
                     ->select(DB::raw('TRUNCATE (avg(calificacion), 1) as calificacion, iniciativa_id'))
                     ->where('iniciativa_id', $id_iniciativa)
                     ->get();
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

	public static function allForJsondetallando(){

		$data = [];

		foreach(self::all() as $c){
			$data[] = [
			'id'        => $c->id,
			'titulo'    => $c->titulo,
			'is_active' => $c->is_active,
			'votaciones'=> $c->votos($c->id),
			'detalles'  => $c->detalles($c->id)
			];
		}
		return $data;
	}

	public static function top_ten(){
			$topten =  DB::table('votaciones')
                     ->select(DB::raw('avg(calificacion) as calificacion, iniciativa_id'))
                     ->orderBy('calificacion', 'DESC')
                     ->groupBy('iniciativa_id')
                     ->take(10)
                     ->get();
      $data = [];
   		foreach ($topten as $c) {
   			$data[] = [
								'iniciativa_id'   => $c->iniciativa_id,
								'calificacion'    => $c->calificacion,
								'detalles'        => Iniciativa::detalles($c->iniciativa_id)
								];
   		}

   		return $data;

	}


	public static function allForJson(){

		$data = [];

		foreach(self::all() as $c){
			$data[] = [
			'id'        => $c->id,
			'titulo'    => $c->titulo,
			'is_active' => $c->is_active,
			'votaciones'=> $c->votos($c->id),
			'detalles'  => $c->detalles($c->id)
			];
		}
		return $data;
	}




}
