<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regla extends Model
{
	protected $table = 'reglasdeljuego';
	protected $fillable = ['regla', 'descripcion_regla', 'is_active'];
}
