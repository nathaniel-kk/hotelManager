<?php

namespace App\Http\Controllers\DC;

use App\Http\Controllers\Controller;
use App\Models\CheckRecord;
use App\Models\CustInfo;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\TimeRecord;
use Illuminate\Http\Request;

class CustManageController extends Controller
{
    /**
     *
     */
   public function getAllInfo(){
        $date = CustInfo::Get();
       return $date ?
           response()->success(200,'成功',$date):
           response()->fail(100,'失败',null);

   }

    /**
     * @param Request $request
     *                  客户姓名
     */
    public function searchCust(Request $request) {
        $rs = CustInfo::select($request['name']);
        return $rs ?
            response()->success(200,'成功',$rs):
            response()->fail(100,'失败',null);
    }

    /**
     * @param Request $request
     * 获取ID并回显
     */
    public function getInfoByID(Request $request) {

        $info = CustInfo::selectByID($request['id']);
        return $info ?
            response()->success(200,'成功',$info):
            response()->fail(100,'失败',null);

    }

    public function modify(Request $request) {
            $rs = CustInfo::modify($request);
            if($rs == 1){
              return  response()->success(200,'成功',null);
            }else{
              return  response()->fail(100,'失败',null);
            }
    }

    /**
     * @param Request $request
     *          id
     */
    public function deleteInfo(Request $request){
            $rs = CustInfo::SerchbID($request['id']);
            log::custdel($rs);

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

}
