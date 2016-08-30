<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;	

class IniciativasDetalles extends Model
{

	protected $table = 'iniciativas_detalles';
	protected $fillable = ['id_iniciativas', 'id_categoria', 'id_subcategoria', 'id_user', 'propuesta', 'orden_propuesta', 'evidencia_video', 'evidencia_foto', 'evidencia_texto', 'is_active'];




public static function categoria($id_categoria){
	return Categorias::where('id', $id_categoria)->get(['categoria']);
}


}
