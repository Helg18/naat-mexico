<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iniciativas_votaciones extends Model
{
	protected $table = 'iniciativas_votaciones';
	protected $fillable = ['votaciones_id', 'calificacion', 'id_user', 'comentario'];

	
}
