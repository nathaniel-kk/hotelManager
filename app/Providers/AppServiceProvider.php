<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($code = 200, $msg = 'success', $data = '',$status = 200) {
            $content = array('code' => $code, 'msg' => $msg, 'data' => $data);
            return response()->json($content,$status);
        });
        Response::macro('fail', function ($code = 100, $msg = 'fail', $data = '',$status = 200) {
            $content = array('code' => $code, 'msg' => $msg, 'data' => $data);
            return response()->json($content,$status);
        });
    }
}
