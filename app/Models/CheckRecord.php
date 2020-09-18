<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckRecord extends Model
{
    protected $table = 'check_record';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    public static function Add($time,$cust,$room){
        $rs = CheckRecord::create([
           'time_id'=>$time,
           'cust_id'=>$cust,
           'room_id'=>$room
        ]);
        return $rs;
    }

    public static function deleteid($id){
        $rs = CheckRecord::where('cust_id',$id)
            ->get();
        foreach ($rs as $a){
           $time = $a['time_id'];
        }
        CheckRecord::where('cust_id',$id)->delete();
        return $time;

    }

}
