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

    //获取近日经营情况
    Public static function getDateMoney(){
        $data = DB::table('check_record')
            ->Join('time_record','time_record.time_id','=','check_record.time_id')
            ->Join('room_info','room_info.room_id','=','check_record.room_id')
            ->Join('room_class','room_info.class_id','=','room_class.class_id')
            ->select('check_record.id','time_record.in_time','room_info.room_id','room_class.price')
            ->distinct('check_record.id')
            ->get();

        $num = $data->count('id');
        $date =array();
        $i = array();
        $j = array();
        for ($b = 0; $b < 5; $b++) {
            $count = 0;
            for ($a = 0; $a < $num; $a++) {
                if ($data[$a]->in_time > date("Y-m-d"." 00:00:00", time() - $b * 24 * 60 * 60) && $data[$a]->in_time < date("Y-m-d"." 23:59:59", time() - $b * 24 * 60 * 60)) {
                    $count += $data[$a]->price;
                }
            }
            $c = 0;
            $i[$b][$c]=date("m-d", time() - $b * 24 * 60 * 60);
            $j[$b][$c]=$count;
            $date[$b]['in_time'] =  $i[$b][$c];
            $date[$b]['money'] =  $j[$b][$c];
        }
        return $date;
    }

    //获取近日入住情况
    Public static function getDateUser (){
        $data =array();
        $i = array();
        $j = array();

        for($b=0;$b<5;$b++){
            $number = 0;
            foreach (TimeRecord::pluck('in_time') as $date) {
                if ($date > date("Y-m-d"." 00:00:00", time() - $b * 24 * 60 * 60) && $date < date("Y-m-d"." 23:59:59", time() - $b * 24 * 60 * 60)) {
                    $number++;
                }
            }
            $a = 0;
            $i[$b][$a]=date("m-d", time() - $b * 24 * 60 * 60);
            $j[$b][$a]=$number;
            $data[$b]['in_time'] =  $i[$b][$a];
            $data[$b]['number'] =  $j[$b][$a];
            $a++;
        }
            return $data;
    }
    protected $guarded = [];

    public static function Add($time1,$time2){
        $rs = TimeRecord::create([
            'in_time' => $time1,
            'out_time'=>$time2
        ]);
        return $rs['time_id'];
    }

    public static function deleTetime($id){
        $rs = TimeRecord::where('time_id',$id)
            ->delete();
        return $rs;
    }
}
