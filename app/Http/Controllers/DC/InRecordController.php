<?php

namespace App\Http\Controllers\DC;

use App\Http\Controllers\Controller;
use App\Models\CheckRecord;
use App\Models\CustInfo;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\TimeRecord;
use Illuminate\Http\Request;

class InRecordController extends Controller
{
    //入住记录管理


    public function getAll() {

       $date =  CustInfo::getRecord();

        return $date ?
            response()->success(200,'成功',$date):
            response()->fail(100,'失败',null);
    }

    /**
     * @param Request $request
     *              id
     */
    public function delInfo(Request $request) {

        $date = CustInfo::SerchByID($request['id']);
        Log::cust_del($date);

        $t1 = CustInfo::deleteinfo($request['id']);
        $t2 = Reservation::deletetime($request['id']);
        $t3 = CheckRecord::deleteid($request['id']);
        $t4 = TimeRecord::deleTetime($t3);
        if($t1&&$t2&&$t3&&$t4 >0){
            return response()->success(200,'删除成功',null);
        }else {
            return response()->fail(100, '失败', null);

        }

    }

    /**
     * @param Request $request
     *              name
     */
    public function SearchByName(Request $request) {
        $date = CustInfo::SearchByName($request['name']);
        return $date ?
            response()->success(200,'成功',$date):
            response()->fail(100,'失败',null);
    }
}
