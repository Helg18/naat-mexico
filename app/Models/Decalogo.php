<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decalogo extends Model
{
	protected $table = 'decalogos';
	protected $fillable = [
											  'decalogo', 
											  'is_active'
										  ];
  
}
