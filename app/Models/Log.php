<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;



class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    protected $primaryKey = 'log_id';
    protected $guarded = [];
    protected $fillable = ['type', 'info'];
    Public static function EarlyLeaveDate($id_code){
        $date = DB::table('check_record')
            ->Join('cust_info','check_record.cust_id','=','cust_info.cust_id')
            ->Join('time_record','time_record.time_id','=','check_record.time_id')
            ->where('cust_info.id_code',$id_code)
            ->select('time_record.res_time','cust_info.name','check_record.room_id')
            ->get();
        $res = Log::create([
            'type'=>'1',
            'info'=>$date[0]->res_time.' '.'[退房]'.' '.$date[0]->name.' '.'-'.' '.$date[0]->room_id,
        ]);
        return $res;
    }




    public static function cust_in($date){

            Log::create([
                'type'=> 0,
                'info'=> $date['name'].'-'.$date['room_id']
                ]);

    }

    public static function cust_del($date){
        self::crate([
            'type'=>1,
            'info' => auth()->id.'-'.'删除'.'-'.$date['time_id'].$date['room_id'].$date['name'].$date['id_code'].$date['tel'].$date['in_time'].$date['out_time'].$date['res_time'],
        ]);
    }
    public static function custdel($date){
        self::create([
            'type'=>1,
            'info'=> auth()->id.'-'.'删除'.'-'.$date['cust_id'].$date['name'].$date['sex'].$date['tel'].$date['id_code'].$date['arrival_time']
        ]);

    }
}
