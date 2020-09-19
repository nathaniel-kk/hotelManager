<?php

namespace App\Http\Controllers\DC;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\ChekInRequest;
use App\Models\CheckRecord;
use App\Models\CustInfo;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\TimeRecord;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    //客户入住
    /*
     * 客户姓名
     * 身份证号
     * 联系电话
     * 房间号
     * 入住天数
     */
    public function checkIn(ChekInRequest $request){




             $date = $request;

             $t1 = CustInfo::Add($date); //cust_id

            $day1 = date("Y/m/d H:i:s", time());//当前时间
            $da = time() + 60 * 60 * 24 * $request['day'];
            $day = date("Y/m/d 15:00:00", $da);//预计离开时间
            $t2 = Reservation::Add($t1, $day1);//添加客户到达时间

            $t3 = TimeRecord::Add($day1, $day);//time_id

            $t4 = CheckRecord::Add($t3, $t1, $request['room_id']);

            Log::cust_in($request);


            if ($t1 && $t2 && $t3 && $t4 != null) {
                return response()
                    ->success(200, '成功', null);
            } else {
                return response()
                    ->fail(100,'失败', null);
            }





    }
}
