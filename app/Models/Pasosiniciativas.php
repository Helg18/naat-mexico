<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasosiniciativas extends Model
{	
	protected $table = 'pasosiniciativas';
	protected $fillable = ['pasosiniciativas', 'iniciativa_id'];
}
