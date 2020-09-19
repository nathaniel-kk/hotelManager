<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustInfo extends Model
{
    protected $table = 'cust_info';
    public $timestamps = false;
    protected $primaryKey = 'cust_id';
    protected $guarded = [];

    /**
     * 添加客户信息
     * @param $date
     */
    public static function Add($date){


        $rs = CustInfo::create([
            'name' => $date['name'],
            'tel' => $date['phone_number'],
            'id_code' => $date['id'],
        ]);
       return $rs['cust_id'];
    }
    /**
     * 获取客户信息
     */
    //首次入住时间没有实现
    public static function Get(){
        $rs = DB::table('cust_info')
            ->Join('reservation','reservation.cust_id','=','cust_info.cust_id')
            ->select('cust_info.cust_id','cust_info.name','cust_info.sex','cust_info.id_code','cust_info.tel','reservation.arrival_time')
            ->get();
        return $rs;

    }
    //首次入住时间没有实现
    public static function select($name){
        $rs = DB::table('cust_info')
            ->Join('reservation','reservation.cust_id','=','cust_info.cust_id')
            ->where('cust_info.name',$name)
            ->select('cust_info.cust_id','cust_info.name','cust_info.sex','cust_info.id_code','cust_info.tel','reservation.arrival_time')
            ->get();
        return $rs;
    }

    public static function selectByID($ID){
        $rs = CustInfo::where('cust_id',$ID)
            ->get();
        return $rs;
    }

    public static function modify($info){
        $rs = CustInfo::where('cust_id',$info['id'])
            ->update([
                'name'=>$info['name'],
                'sex'=>$info['sex'],
                'id_code'=>$info['id_card']
            ]);
        return $rs;
    }

    public static function deleteinfo($id){
        $rs = CustInfo::where('cust_id',$id)
            ->delete();
        return $rs;
    }

    public static function getRecord(){
        $rs = DB::table('cust_info')
            ->Join('check_record','check_record.cust_id','=','cust_info.cust_id')
            ->Join('time_record','time_record.time_id','=','cust_info.cust_id')
            ->select('check_record.time_id','check_record.room_id','cust_info.cust_id','cust_info.name','cust_info.id_code','cust_info.tel','time_record.in_time','time_record.out_time','time_record.res_time')
            ->get();
        return $rs;
    }

    public static function SearchByName($name){
        $rs = DB::table('cust_info')
            ->Join('check_record','check_record.cust_id','=','cust_info.cust_id')
            ->Join('time_record','time_record.time_id','=','cust_info.cust_id')
            ->where('cust_info.name',$name)
            ->select('check_record.time_id','check_record.room_id','cust_info.cust_id','cust_info.name','cust_info.id_code','cust_info.tel','time_record.in_time','time_record.out_time','time_record.res_time')
            ->get();
        return $rs;

    }
    public static function SerchByID($ID){
        $rs = DB::table('cust_info')
            ->Join('check_record','check_record.cust_id','=','cust_info.cust_id')
            ->Join('time_record','time_record.time_id','=','cust_info.cust_id')
            ->where('cust_info.name',$ID)
            ->select('check_record.time_id','check_record.room_id','cust_info.cust_id','cust_info.name','cust_info.id_code','cust_info.tel','time_record.in_time','time_record.out_time','time_record.res_time')
            ->get();
        return $rs;
    }

    public static function SerchbID($date){
        $rs = DB::table('cust_info')
            ->Join('reservation','reservation.cust_id','=','cust_info.cust_id')
            ->where('cust_info.name',$date)
            ->select('cust_info.cust_id','cust_info.name','cust_info.sex','cust_info.id_code','cust_info.tel','reservation.arrival_time')
            ->get();
        return $rs;
    }

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
