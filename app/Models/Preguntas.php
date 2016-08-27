<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
	protected $table = 'preguntas';
	protected $fillable = ['pregunta', 'id_user'];
}
