<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //
    public function index()
    {
        $data=Goods::get();
//        dump($data);
        return view('goods/goods',["data"=>$data]);
    }
}
