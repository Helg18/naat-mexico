<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    public function company(){
        return $this->belongsTo('\App\Models\Company');
    }
}
