<?php

namespace App\Http\Controllers\Admin\OAuth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\OAuth\Auth\RegisteredRequest;
use App\Model\User;
use App\Models\Users;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth('user')->attempt($credentials)) {
                return response()->fail(100, '账号或者用户名错误!', null);
            }
//            if (self::checkUser()) {
//                self::logout();
//                return response()->fail(100, '用户未启用!', null);
//            }
            return self::respondWithToken($token, '登陆成功!');
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->fail(500, '登陆失败!', null, 500);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {

        }
        return auth()->check() ?
            response()->fail(100, '注销登陆失败!', null) :
            response()->success(200, '注销登陆成功!', null);
    }

    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (\Exception $e) {
        }
        return $newToken != null ?
            self::respondWithToken($newToken, '刷新成功!') :
            response()->fail(100, '刷新token失败!');
    }

    protected function credentials($request)
    {
        return ['id' => $request['id'], 'password' => $request['password']];
    }

//    protected function checkUser()
//    {
//        return auth()->user()->account_state == '0' ?
//            true :
//            false;
//    }

    protected function respondWithToken($token, $msg)
    {
        return response()->success(200, $msg, array(
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("user")->factory()->getTTL() * 60
        ));
    }

    /**
     * 注册用户
     *
     * @param RegisteredRequest $registeredRequest
     * @return mixed
     * @throws \Exception
     */
    public function registered(Request $registeredRequest)
    {
        return Admin::createUser(self::userHandle($registeredRequest)) ?
            response()->success(200, '注册成功!', null) :
            response()->fail(100, '注册失败!', null);
    }

    /**
     * 用户信息处理
     * @param $request
     * @return array
     */
    protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['work_id'] = $registeredInfo['work_id'];
        return $registeredInfo;
    }

    /**
     * 获取用户信息
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function info()
    {
        $UserInfo = Admin::getUserInfo(auth()->id(), array('id', 'work_id'));
        return $UserInfo != null ?
            response()->success(200, '获取成功!', $UserInfo) :
            response()->fail(100, '获取失败!');
    }



}
