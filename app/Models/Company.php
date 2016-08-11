<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelableTrait;
use App\Models\Plan;
use App\Models\Purchase;
use App\Models\User;
use \DB;

class Company extends Model
{
    use ModelableTrait;
    //

    public function users()
    {
        return $this->belongsToMany('\App\Models\User')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

    public function purchases(){
        return $this->hasMany('\App\Models\Purchase');
    }

    public function quizzes(){
        return $this->hasMany('\App\Models\Quiz');
    }

    public function userByRespondents(){
        return User::
            whereRaw(DB::raw("
                id IN (
                    SELECT user_id FROM quiz_user WHERE quiz_id IN (
                        SELECT id FROM quizzes WHERE company_id=".$this->id."
                    )
                )
            "))
            ->get();
    }

    public function makePurchase($plan_id){

        $plan = Plan::find($plan_id);
        $purchase = new Purchase();
        $purchase->company_id = $this->id;
        $purchase->plan_name = $plan->name;
        $purchase->limit_user = $plan->limit_user;
        $purchase->limit_quiz = $plan->limit_quiz;
        $purchase->days_expiration = $plan->days_expiration;
        $purchase->price = $plan->price;
        $purchase->user_id = \Auth::user()->id;
        $purchase->save();

        $date = new \DateTime();
        $date->modify("+{$plan->days_expiration} day");


        $this->limit_user = $plan->limit_user;
        $this->limit_quiz = $plan->limit_quiz;
        $this->expiration = $date->format('Y-m-d');
        $this->save();

    }

    public static function allByRole(){
        if(\Auth::user()->can('companies.all')){

            return self::whereRaw(DB::Raw('(is_for_nse IS NULL || is_for_nse != 1) '))->get();
        }else{
            return self::where('user_id',\Auth::user()->id)->get();
        }
    }

    static function  quiz_nse(){

        return self::where('is_for_nse',1)->first()->quizzes()->first();

    }
}
