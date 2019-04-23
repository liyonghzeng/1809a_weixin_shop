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
        $nonceStr = Str::random(10);
         $jsapi_ticket = getJsapiTicket();
        $urll = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        $string1  = "$nonceStr.$jsapi_ticket.$timestamp.$urll";
        $sign = sha1($string1);
        $js_config = [
            'appId' => env('WX_APPID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        return view('sdk/sdk',['js_config'=>$js_config]);
    }
}
