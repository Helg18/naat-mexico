<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
	protected $table = 'iniciativas';
	protected $fillable = ['iniciativa', 'is_active'];
}
