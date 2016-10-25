<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips_votaciones extends Model
{	
	protected $table = 'tips_votaciones';
	protected $fillable = ['tip_id', 'calificacion', 'id_user', 'comentario'];
}