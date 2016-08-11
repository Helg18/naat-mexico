<?php
/**
 * Created by PhpStorm.
 * User: jfcr2204
 * Date: 4/28/16
 * Time: 07:32
 */

namespace App\Traits;

trait ModelableTrait{


    public function is_active_slug(){
        if($this->is_active){
            return "Activo";
        }else{
            return "Inactivo";
        }
    }

    function canDelete(){

        //Validate
        return true;
    }

    static function actives(){
        return self::where('is_active',1)->get();
    }

}