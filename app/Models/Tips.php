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

	
	//protected $hidden = ['users'];

	public function users(){
	 return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     
    public function setUsersAttribute($value)
    {
       $this->attributes['users'] = $value;
    }
	*/
	
	
	public static function allForJson(){

		$data = [];

		foreach(self::all() as $c){

			$users = User::findOrFail($c->id_user);
		
			$data[] = [
			'id'           => $c->id,
			'tip'          => $c->tip,
			'comentario'   => $c->comentario,
			'id_user'      => $c->id_user,
			'categoria'    => $c->categoria($c->id_categoria),
			'subcategoria' => $c->subcategoria($c->id_subcategoria),
			'votaciones' => $c->votos($c->id),
			
			'users'=>[
					'name'=>$users->name,
					'campus'=>$users->campus,
					'foto'=>$users->foto,
					],
			
			];
			
			
			
		}
		return $data;
	}


	public static function categoria($categoria){
		return Categorias::find($categoria);
	}


	public static function subcategoria($subcategoria){
		return Subcategorias::find($subcategoria);
	}

	public static function votos($tips_id){
		$votos = DB::table('tips_votaciones')
                     ->select(DB::raw('TRUNCATE (avg(calificacion), 1) as calificacion, comentario'))
                     ->where('tip_id', $tips_id)
                     ->get();

					 
		$data = [];
                        foreach($votos as $voto){
                                $data=[
										'tip_id'=>$tips_id,
                                       	'calificacion' => $voto->calificacion,
                                ];
                        }


                return $data;

	}




}
