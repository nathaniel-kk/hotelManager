<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    protected $primaryKey = 'log_id';
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
}
