<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckRecord extends Model
{
    protected $table = 'check_record';
    public $timestamps = false;
    protected $primaryKey = 'id';

    //获取入住总人次
    public static function getUserCount(){
        $number = CheckRecord::count('id');
        return $number;
    }

    //获取可入住房间
    Public static function getSureClass(){
        $room_id = DB::table('check_record')
            ->Join('time_record', 'time_record.time_id', '=', 'check_record.time_id')
            ->where('time_record.out_time', '<', now())
            ->select('check_record.room_id')
            ->get();
        return $room_id;
    }
}
