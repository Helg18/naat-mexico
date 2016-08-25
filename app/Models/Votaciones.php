<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votaciones extends Model
{
	protected $table = 'votaciones';
	protected $fillable = ['id_iniciativa', 'calificacion', 'id_user', 'comentario'];
}
