<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
	protected $table = 'subcategorias';
	protected $fillable = ['subcategoria', 'is_active', 'categoria_id'];

}
