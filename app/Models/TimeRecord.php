<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    protected $table = 'time_record';
    public $timestamps = false;
    protected $primaryKey = 'time_id';
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
