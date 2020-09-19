<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin/oAuth')->namespace('Admin\OAuth')->group(function () {
    Route::post('login', 'AuthController@login'); //登陆
    Route::post('logout', 'AuthController@logout'); //退出登陆
    Route::post('refresh', 'AuthController@refresh'); //刷新token
    Route::post('registered', 'AuthController@registered'); //注册用户
    Route::get('info', 'AuthController@info'); //注册用户
});

Route::prefix('dc')->namespace('DC')->group(function (){
    Route::post('checkIn','CheckInController@checkIn');//客户入住信息登录
    Route::get('getAllInfo','CustManageController@getAllInfo');//获取全部用户
    Route::post('searchCust','CustManageController@searchCust');//搜索客户信息
    Route::get('getInfoByID','CustManageController@getInfoByID');//回显用户
    Route::post('modify','CustManageController@modify');//修改用户
    Route::post('deleteInfo','CustManageController@deleteInfo');//删除用户
    Route::get('getAll','InRecordController@getAll');//获取所有入住记录
    Route::post('delInfo','InRecordController@delInfo');//删除用户记录
    Route::post('SearchByName','InRecordController@SearchByName');//搜索用户入住记录
});
