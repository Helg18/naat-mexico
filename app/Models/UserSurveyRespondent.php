<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NseLevel;
use \DB;

class UserSurveyRespondent extends Model
{

    //
    protected $guarded = ['created_at','updated_at'];


    public function nse(){
        return NseLevel::whereRaw(DB::raw($this->nse_points . " BETWEEN min AND max"))->first();
    }

    public function getAgeAttribute(){

        $date = new \DateTime($this->day_of_birth);
        $now = new \DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
}
