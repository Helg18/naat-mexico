<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
	protected $table = 'comentarios';
	
	public function users(){
	 return $this->belongsTo('App\Models\User', 'id_user');
	}
	
	/**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     
	public function getNameAttribute(){
        return $this->users->name;
    }
	*/
	
	/**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }
	
	
}