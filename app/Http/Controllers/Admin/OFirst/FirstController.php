<?php

namespace App\Http\Controllers\Admin\OFirst;

use App\Http\Controllers\Controller;
use App\Models\CheckRecord;
use App\Models\CustInfo;
use App\Models\Reservation;
use App\Models\TimeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirstController extends Controller
{
    //获取入住总人次
    public function getUserCount(){
        $number = CheckRecord::getUserCount();
        return $number?
            response()->success(200, '获取成功!', $number) :
            response()->fail(100, '获取失败!', null);
    }

    //获取预约今天到店人数
    public function getUserCountOrder(){
        $number = Reservation::getUserCountOrder();
        return $number?
            response()->success(200, '获取成功!', $number) :
            response()->fail(100, '获取失败!', null);
    }

    //获取即将离店人数
    Public function getUserCountLeave(){
        $number = TimeRecord::getUserCountLeave();
        return $number?
            response()->success(200, '获取成功!', $number) :
            response()->fail(100, '获取失败!', null);
    }

    //获取当前入住人数
    Public function getUserCountCheck(){
        $number = TimeRecord::getUserCountCheck();
        return $number?
            response()->success(200, '获取成功!', $number) :
            response()->fail(100, '获取失败!', null);
    }

    //获取客户信息
    Public function getUserCountData(){
        $data = CustInfo::getUserCountData();
        return $data?
            response()->success(200, '获取成功!', $data) :
            response()->fail(100, '获取失败!', null);
    }

    //用户提前退房
    Public function UserEarlyLeave(Request $request){
        $id_code = $request['id_code'];
        $data = TimeRecord::UserEarlyLeave($id_code);
        return $data?
            response()->success(200, '退房成功!', null) :
            response()->fail(100, '退房失败!', null);
    }

    //获取可入住房间
    Public function getSureClass(){
        $room_id = CheckRecord::getSureClass();
        return $room_id?
            response()->success(200, '获取成功!', $room_id) :
            response()->fail(100, '获取失败!', null);
    }

    //获取近日经营情况
    Public function getDateMoney(){
        $data = DB::table('check_record')
            ->Join('time_record','time_record.time_id','=','check_record.time_id')
            ->Join('room_info','room_info.room_id','=','check_record.room_id')
            ->Join('room_class','room_info.class_id','=','room_class.class_id')
            ->select('check_record.id','time_record.in_time','room_info.room_id','room_class.price')
            ->distinct('check_record.id')
         //   ->sum('room_class.price');
        ->get();

        $sum = 0;
        foreach ($data as $v){
            $sum += $v['price'];
        }
        echo $sum;
        die();
    }
}
