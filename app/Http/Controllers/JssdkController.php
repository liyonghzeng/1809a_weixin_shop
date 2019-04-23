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
        $current_url = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        $string1  =   "jsapi_ticket=$jsapi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_url";

        $sign = sha1($string1);
        $js_config = [
            'appId' => env('WX_APPID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        return view('sdk/sdk',['js_config'=>$js_config]);
    }
    public  function test2(){
        $img = $_GET['img'];
        $media_id=Explode(',',$img);
        $urll = [];
        foreach ($media_id as $k=>$v){
            $urll[]= 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.getAccessToken().'&media_id='.$v;
        }
        print_r($urll);

    }
}
