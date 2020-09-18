<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeRecord extends Model
{
    protected $table = 'time_record';
    public $timestamps = false;
    protected $primaryKey = 'time_id';

    //获取即将离店人数
    public static function getUserCountLeave(){
        $number = 0;
        $orderdate = date_format(now(),'Y-m-d').' 00:00:00';
        $laterdate = date_format(now(),'Y-m-d').' 23:59:59';
        foreach (TimeRecord::pluck('out_time') as $date){
            if($date>=$orderdate && $date<=$laterdate){
                $number++;
            }
        }
        return $number;
    }

    //获取当前入住人数
    Public static function getUserCountCheck(){
        $number = 0;
        foreach (TimeRecord::pluck('res_time') as $date){
            if($date>=now()){
                $number++;
            }
        }
        $number = 45 - $number;
        return $number;
    }

    //用户提前退房
    Public static function UserEarlyLeave($id_code){
        if ($id_code){
            $data = DB::table('check_record')
                ->Join('cust_info','check_record.cust_id','=','cust_info.cust_id')
                ->Join('time_record','time_record.time_id','=','check_record.time_id')
                ->where('cust_info.id_code',$id_code)
                ->update(['time_record.res_time' => now()]);
        }
        return $data;
    }
}
