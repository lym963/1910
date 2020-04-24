@extends('layouts.shop')
@section('title', '购物车列表')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$cartCount}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="checkAll"/> 全选</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     
     <div class="dingdanlist">
      <table>
          @foreach($cartInfo as $vv)  
       <tr>
        <td width="4%"><input type="checkbox" name="1" class="box"  goods_price="{{$vv->goods_price}}" value="{{$vv->cart_id}}"  /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$vv->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$vv->goods_name}}</h3>
         <time>{{$vv->create_time}}</time>
        </td>
        <td align="right" id="num"><input type="text" id="buy_{{$vv->cart_id}}" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$vv->goods_price}}</strong></th>
       </tr>
          @endforeach
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:void(0)" id="confirm" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <script>
       //全选全部选
       $("#checkAll").click(function(){
          var _this=$(this);
          var state=_this.prop("checked");

          $(".box").prop("checked",state);
          getTotalMoney()
       })
       //获取总价格
       function getTotalMoney(){
          var box=$(".box:checked");
          if(box.length==0){
            $("#money").text("￥"+0)
          }
          var money=0
          box.each(function(k){
             var price=$(this).attr("goods_price")
             var num=$(this).parents("tr").find("#num input").val()
             money+=Number(price)*Number(num)
          })
          $("#money").text("￥"+money)
       }
       //点击去结算
       $("#confirm").click(function(){
         var box=$(".box:checked");
         if(box.length==0){
            alert("请您最少选择一件商品哟~~")
            return false;
         }
         var id="";
         box.each(function(k){
            id+=$(this).val()+","
         })
         
         id=id.trim().substr(0,id.length-1)
         //讲商品id传到结算方法
         location.href="/pay?id="+id
       })
    </script>
    @endsection