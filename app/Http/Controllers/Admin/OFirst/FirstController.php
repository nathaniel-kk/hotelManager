<?php

namespace App\Http\Controllers\Admin\OFirst;

use App\Http\Controllers\Controller;
use App\Models\CheckRecord;
use App\Models\CustInfo;
use App\Models\Log;
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
        if(strlen($id_code)==11){
            $data = TimeRecord::UserEarlyLeave($id_code);
            $res = Log::EarlyLeaveDate($id_code);
            return $data&&$res?
                response()->success(200, '退房成功!', null) :
                response()->fail(100, '退房失败!', null);
        }
        return response()->fail(100, '身份证号错误!', null);
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
        $data = TimeRecord::getDateMoney();
        return $data?
            response()->success(200, '获取成功!', $data) :
            response()->fail(100, '获取失败!', null);
    }


    //获取近日入住情况
    Public function getDateUser(){
        $data = TimeRecord::getDateUser();
        return $data?
            response()->success(200, '获取成功!', $data) :
            response()->fail(100, '获取失败!', null);
    }
}
