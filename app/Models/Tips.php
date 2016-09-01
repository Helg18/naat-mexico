<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;
use App\Models\Tips_votaciones;
use DB;

class Tips extends Model
{
	protected $table = 'tips';
	protected $fillable = ['tip', 'comentario', 'id_user', 'id_categoria', 'id_subcategoria'];


	public static function allForJson(){

		$data = [];

		foreach(self::all() as $c){
			$data[] = [
			'id'           => $c->id,
			'tip'          => $c->tip,
			'comentario'   => $c->comentario,
			'id_user'      => $c->id_user,
			'categoria'    => $c->categoria($c->id_categoria),
			'subcategoria' => $c->subcategoria($c->id_subcategoria),
			'votos' => $c->votos($c->id)
			];
		}
		return $data;
	}


	public static function categoria($categoria){
		return Categorias::find($categoria)->get(['categoria']);
	}


	public static function subcategoria($subcategoria){
		return Subcategorias::find($subcategoria)->first(['subcategoria']);
	}

	public static function votos($tips_id){
		return DB::table('tips_votaciones')
                     ->select(DB::raw('TRUNCATE (avg(calificacion), 1) as calificacion, comentario'))
                     ->where('id', $tips_id)
                     ->get();
	}




}
