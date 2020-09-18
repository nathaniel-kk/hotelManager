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

Route::prefix('admin/ofirst')->namespace('Admin\OFirst')->group(function () {
    Route::get('getusercount', 'FirstController@getUserCount'); //获取入住总人次
    Route::get('getusercountorder', 'FirstController@getUserCountOrder'); //获取预约今天到店人数
    Route::get('getusercountleave', 'FirstController@getUserCountLeave'); //获取即将离店人数
    Route::get('getusercountcheck', 'FirstController@getUserCountCheck'); //获取当前入住人数
    Route::get('getusercountdata', 'FirstController@getUserCountData'); //获取客户信息
    Route::post('userearlyleave', 'FirstController@UserEarlyLeave'); //用户提前退房
    Route::get('getsureclass', 'FirstController@getSureClass'); //获取可入住房间
    Route::get('getdatemoney', 'FirstController@getDateMoney'); //获取近日经营情况
    Route::get('getdateuser', 'FirstController@getDateUser'); //获取近日入住情况
});
