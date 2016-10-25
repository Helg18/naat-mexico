<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votaciones extends Model
{
	protected $table = 'votaciones';
	protected $fillable = ['id_iniciativa', 'calificacion', 'id_user', 'comentario'];

	public function iniciativa(){
		return $this->belongsTo('App\Models\Iniciativa');
	}







	public static function votos($id_user){
			return self::where('id_user', $id_user)->get();
	}





		public static function allForJson(){

			$data = [];

			foreach(self::all() as $c){
				$data[] = [
				'id_iniciativas' => $c->id_iniciativas,
				'calificacion'   => $c->calificacion,
				'id_user'        => $c->id_user,
				'comentario'     => $c->comentario,
				'is_active'      => $c->is_active
				];
			}
			return $data;
		}

	}
