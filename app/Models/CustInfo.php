<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustInfo extends Model
{
    protected $table = 'cust_info';
    public $timestamps = false;
    protected $primaryKey = 'cust_id';

    //获取客户信息
    Public static function getUserCountData (){
        $data = DB::table('check_record')
                ->Join('cust_info','check_record.cust_id','=','cust_info.cust_id')
                ->Join('time_record','time_record.time_id','=','check_record.time_id')
                ->where('time_record.res_time',null)
                ->select('check_record.room_id','cust_info.name','cust_info.id_code','time_record.in_time','time_record.out_time')
                ->get();
        return $data;
    }

}
