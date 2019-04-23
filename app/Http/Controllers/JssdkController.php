<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class JssdkController extends Controller
{
    //
    public function test()
    {
        $timestamp = time();
        $nonceStr = Str::random(5);
         $jsapi_ticket = getJsapiTicket();
        $url = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        $sign = "$nonceStr.$jsapi_ticket.$timestamp.$url";
        $js_config = [
            'appId' => env('WX_APPID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        return view('sdk/sdk',['js_config'=>$js_config]);
    }
}
