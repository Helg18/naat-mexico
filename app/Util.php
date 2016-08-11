<?php
namespace App;

use App\Ticket;
use \DB;
use App\User;
use App\Product;
use App\Event;

class Util{

    static $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    static $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    static $mesesCortos = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

    static function dateSpanish($date=false,$mesYDia=false,$dayShort=false){

        if(!$date) $date = date('Y-m-d');


        $t = strtotime($date);

        if($dayShort){
            return date('d',$t)."-".self::$mesesCortos[date('n',$t)-1];
        }

        if($mesYDia){
            return date('d',$t)." ".self::$meses[date('n',$t)-1];
        }
        return self::$dias[date('w',$t)]." ".date('d',$t)." de ".self::$meses[date('n',$t)-1]. " del ".date('Y',$t) ;
    }

    static function spanishArray(){
        return[
            'dias'          =>  self::$dias,
            'meses'         =>  self::$meses,
            'mesesCortos'   =>  self::$mesesCortos,
        ];
    }



    static function randomFooterColor($howMany=0){
        $colors = ['danger','info','pink', 'primary', 'success','warning'];
        if($howMany<=count($colors)) return $colors;


        $tmp = (int) $howMany / count($colors);
        $big = [];

        for ($x =0 ; $x<=$tmp; $x++){
            foreach($colors as $c){
                array_push($big,$c) ;
            }
        }
        return $big;
    }

    static function totalSales($event=false){
        $tmp = DB::table('tickets')
            ->selectRaw(DB::raw('
                count(1) as tickets_count,
                sum(subtotal) as subtotal,
                sum(tax) as tax,
                sum(total) as total,
                sum(cash) as cash,
                sum(residue) as residue
            '))
            ->where('status',1);

        if($event){
            $tmp->whereRaw(DB::raw("
                turn_id IN (select id from turns WHERE event_id={$event->id})
            "));
        }

        $data = $tmp->get();
        return count($data) ? $data[0] : false;
    }

    static function totalCounts($event=false){
        return[
            'users'     =>  User::actives(true),
            'products'  =>  Product::actives(true),
            'events'    =>  Event::actives(true),
        ];
    }
}