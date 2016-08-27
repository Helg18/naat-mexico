<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
	protected $table = 'respuestas';
	protected $fillable = ['respuesta', 'id_user', 'id_pregunta', 'id'];
}
