<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premios extends Model
{
	protected $table = 'premios';
	protected $fillable = [
											  'premios', 
											  'descripcion_premios', 
											  'is_active',
											  'id'
										  ];
  
}