<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    public $timestamps = false;
    protected $primaryKey = 'id';

    //获取预约今天到店人数
    public static function getUserCountOrder(){
        $number = 0;
        $orderdate = date_format(now(),'Y-m-d').' 00:00:00';
        $laterdate = date_format(now(),'Y-m-d').' 23:59:59';
        foreach (Reservation::pluck('arrival_time') as $date){
            if($date>=$orderdate && $date<=$laterdate){
                $number++;
            }
        }
        return $number;
    }
}
