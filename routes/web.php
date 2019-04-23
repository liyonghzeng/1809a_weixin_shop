<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/goods', 'GoodsController@index');

Route::get('/addBrowse/{id}', 'GoodsController@Browse');


Route::get('cart/index/{id}', 'CartController@index');

Route::get('cart/list', 'CartController@list');

Route::get('/text/{id}', 'weixin\WxPayController@text');//微信支付

Route::post('weixin/pay/notify', 'weixin\WxPayController@notify');//微信支付回调


Route::get('/order/paystatus', 'OrderController@payStatus');//

Route::get('order/index/{id}', 'OrderController@index');

Route::get('order/list', 'OrderController@list');

Route::get('order/house/{id}', 'OrderController@house');

Route::get('order/house/{id}', 'WxPayController@house');


Route::get('Oderd/index', 'OderdControllers@index');

//jssdk
Route::get('/test', 'JssdkController@test');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
