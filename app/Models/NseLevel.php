<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelableTrait;

class NseLevel extends Model
{
    //
    use ModelableTrait;

    static function ordered(){
        return self::orderBy('min','desc')->get();
    }
}
