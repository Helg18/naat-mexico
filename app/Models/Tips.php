<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
	protected $table = 'reglasdeljuego';
	protected $fillable = ['tip', 'comentario', 'id_user', 'id_categoria', 'id_subcategoria'];
}
