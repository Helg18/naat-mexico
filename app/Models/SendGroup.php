<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use DB;
use PHPExcel_IOFactory;
use App\Models\SendGroupDetail;

class SendGroup extends Model
{
    //

    public function emails(){
        return $this->hasMany('App\Models\SendGroupDetail');
    }

    static function allWithSecurity(){


        if(Shinobi::is('customer')){
            //Only my own company
            return self::whereRaw(DB::raw("company_id = " . \Auth::user()->company()->id))->get();
        }else{
            return self::all();
        }

    }


    function from_xls($request){

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $file = $request->file('file');
            $objPHPExcel = PHPExcel_IOFactory::load($file->getPathname());
            $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


            foreach ($objHoja as $iIndice=>$objCelda):
                if(!strpos($objCelda["A"],"@")) continue;
                if($this->emails()->where('email',$objCelda["A"])->first()) continue;
                $this->emails()->save(new SendGroupDetail([
                    'email'=>$objCelda["A"]
                ]));
            endforeach;

        }
    }
}
