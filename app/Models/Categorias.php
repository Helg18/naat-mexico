<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
	protected $table = 'categorias';
	protected $fillable = ['categoria', 'is_active'];

	
	public function subcategory(){
		return $this->hasMany('App\Models\Subcategorias', 'categoria_id');
	}

}
