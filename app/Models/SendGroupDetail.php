<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendGroupDetail extends Model
{
    //
    protected $fillable = ['email'];

    public function send_group(){
        return $this->belongsTo('App\Models\SendGroup');
    }
}
