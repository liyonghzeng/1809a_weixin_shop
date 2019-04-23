<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    //
    public function index()
    {
        $data=Goods::get();
        $goosranking = 'goods:zz:';
        $is= Redis::zRevRange($goosranking,0,100,true);
        if($is!=null){
            $ii= Array_keys($is);
            $choun =array_chunk($ii,3);
            $vv=array_shift($choun);
            $ly=[];
            foreach ($vv as $k=>$v) {
                $ly[]=Goods::where(['goods_id'=>$v])->first();
            }
        }else{
            $ly='';
        }
        return view('goods/goods',["data"=>$data,"ly"=>$ly]);
    }
    public function Browse($id)
    {
//       $res = Goods::where(['goods_id'=>$id])->first();
//        $data=$res->browse+1;
//        Goods::where(['goods_id'=>$id])->update(['browse'=>$data]);
//       return view('goods/browse',["res"=>$res, 'data'=>$data]);
//       $data=$res->browse+1;
//        Goods::where(['goods_id'=>$id])->update(['browse'=>$data]);
        $goods_browse='goods:browse'.$id;
        $res = Goods::where(['goods_id'=>$id])->first();
        $data =  Redis::incr($goods_browse);
        Goods::where(['goods_id'=>$id])->update(['browse'=>$data]);
//        dump($res);
        //浏览排名
        $goosranking = 'goods:zz:';      //定义key
        Redis::zadd($goosranking,$data,$id);
        $ii=Redis::zRangeByscore ($goosranking,0,100,['withscores'=>true] ); //倒叙
//       print_r($ii);
        $is= Redis::zRevRange($goosranking,0,100,true);//正序
//        print_r($is);
//        $iii= Redis::zRange($goosranking,0,100);
//       print_r($iii);
     return view('goods/browse',["res"=>$res, 'data'=>$data]);


    }

}
