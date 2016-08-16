<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
	protected $table = 'fechas';
	protected $fillble = [
											  'fecha', 
											  'descripcion_fecha', 
											  'is_active',
											  'id'
										  ];
  
}
