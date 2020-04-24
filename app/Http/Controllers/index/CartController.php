<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
class CartController extends Controller
{
    //购物车列表
    public function listcart(){
        $user=session("userLogin");
        if(!$user){ 
            return redirect("/login");
        }
        $cartInfo=Cart::where("user_id",$user->user_id)->get();
        $cartCount=Cart::where("user_id",$user->user_id)->count();
        $cartId=array_column($cartInfo->toArray(),"cart_id");
        $cartNum=array_column($cartInfo->toArray(),"cart_num");
        $checkNum=array_combine($cartId,$cartNum);
        return view("index.listcart",compact("cartInfo","cartCount","checkNum"));
    }
    //添加购物车
    public function addcart(){
        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
        $user=session("userLogin");
        if(!$user){ 
            ShowMsg("00001","未登录");
            die;
        }
        $goods=Goods::select("goods_id","goods_name","goods_img","goods_price","goods_num")->find($goods_id);
        //判断库存
        if($goods->goods_num<$buy_number){
            ShowMsg("00001","库存不足");
            die;
        }
        $where=[
            "user_id"=>$user->user_id,
            "goods_id"=>$goods_id
        ];
        $cart=Cart::where($where)->first();
        if($cart){
            //更新购买数量
            $buy_number=$buy_number+$cart->cart_num;
            if($buy_number>$goods->goods_num){
                $buy_number=$goods->goods_num;
            }
            $res=Cart::where("cart_id",$cart->cart_id)->update(["cart_num"=>$buy_number,"goods_xj"=>$goods->goods_price*$buy_number,"update_time"=>time()]);
        }else{
            $data=[
                "user_id"=>$user->user_id,
                "cart_num"=>$buy_number,
                "create_time"=>time(),
                "goods_xj"=>$goods->goods_price*$buy_number
            ];
            $data=array_merge($data,$goods->toArray());
            unset($data["goods_num"]);
            $res=Cart::insert($data);
        }
        if($res!==false){
            ShowMsg("00000","添加成功");
        }
    }
    //确认订单
    public function pay(){
        $user=session("userLogin");
        if(!$user){ 
            return redirect("/login");
        }
        $id=request()->id;
        $where=[
            ["user_id","=",$user->user_id],
            ["goods_id","=",$id]
        ];
        $id=explode(",",$id);
        $cartInfo=Cart::whereIn("cart_id",$id)->get();
        $total=Cart::whereIn("cart_id",$id)->sum("goods_xj");
        return view("index.pay",["cartInfo"=>$cartInfo,"total"=>$total]);
    }
    //订单
    public function success(){
        return view("index.success");
    }
}
