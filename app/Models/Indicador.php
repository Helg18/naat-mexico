<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Votaciones;
use App\Models\IniciativasDetalles;
use App\Models\Categorias;
use App\Models\Subcategorias;
use DB;

class Indicador extends Model
{
	protected $table = 'iniciativas_indicadores';
}
