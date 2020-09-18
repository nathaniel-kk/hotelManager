<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    protected $primaryKey = 'log_id';
    protected $guarded = [];


    //
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
