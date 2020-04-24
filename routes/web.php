<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/index',"IndexController@index");
//Route::view("index","index",["name"=>"李昱民"]);
Route::post("/doAdd","IndexController@doAdd");

Route::get('/goods/{id}/{name?}',"IndexController@goods")->where(["name"=>"[a-zA-z\x{4e00}-\x{9fa5}]{0,5}"]);

//后台管理
Route::domain('admin.laravel.com')->group(function () {
    Route::middleware("isLogin")->get("/","Admin\GoodsController@index");//预览详情
//品牌管理
Route::prefix("/brand")->middleware("isLogin")->group(function(){
    Route::get("create","Admin\BrandController@create");//添加页面
    Route::post("store","Admin\BrandController@store");//添加执行
    Route::match(["get","post"],"index","Admin\BrandController@index");//预览详情
    Route::get("edit/{id}","Admin\BrandController@edit");//编辑展示
    Route::post("update/{id}","Admin\BrandController@update");//修改执行
    Route::get("destroy/{id}","Admin\BrandController@destroy");//执行删除
});
//分类管理
Route::prefix("/category")->middleware("isLogin")->group(function(){
    Route::get("create","Admin\CategoryController@create");//添加页面
    Route::post("store","Admin\CategoryController@store");//添加执行
    Route::get("index","Admin\CategoryController@index");//预览详情
    Route::get("edit/{id}","Admin\CategoryController@edit");//编辑展示
    Route::post("update/{id}","Admin\CategoryController@update");//修改执行
    Route::get("destroy/{id}","Admin\CategoryController@destroy");//执行删除
});
//商品管理
Route::prefix("/goods")->middleware("isLogin")->group(function(){
    Route::get("create","Admin\GoodsController@create");//添加页面
    Route::post("store","Admin\GoodsController@store");//添加执行
    Route::get("index","Admin\GoodsController@index");//预览详情
    Route::get("edit/{id}","Admin\GoodsController@edit");//编辑展示
    Route::post("update/{id}","Admin\GoodsController@update");//修改执行
    Route::get("destroy/{id}","Admin\GoodsController@destroy");//执行删除
});
//管理员管理
Route::prefix("/admin")->middleware("isLogin")->group(function(){
    Route::get("create","Admin\AdminController@create");//添加页面
    Route::post("store","Admin\AdminController@store");//添加执行
    Route::get("index","Admin\AdminController@index");//预览详情
    Route::get("edit/{id}","Admin\AdminController@edit");//编辑展示
    Route::post("update/{id}","Admin\AdminController@update");//修改执行
    Route::get("destroy/{id}","Admin\AdminController@destroy");//执行删除
});
//友情链接管理
Route::prefix("/site")->middleware("isLogin")->group(function(){
    Route::get("create","Admin\SiteController@create");//添加页面
    Route::post("store","Admin\SiteController@store");//添加执行
    Route::match(["get","post"],"index","Admin\SiteController@index");//预览详情
    Route::get("edit/{id}","Admin\SiteController@edit");//编辑展示
    Route::post("update/{id}","Admin\SiteController@update");//修改执行
    Route::get("destroy/{id}","Admin\SiteController@destroy");//执行删除
    Route::match(["get","post"],"ajax","Admin\SiteController@ajax");//预览详情
});
//后台登陆
Route::view('/login/index',"admin.login.index");
Route::post("/login/doLogin","Admin\LoginController@doLogin");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});

//前台管理
Route::domain('www.laravel.com')->group(function () {
    Route::get("/","Index\IndexController@index")->name("shop.index");//首页
    Route::get("/login","Index\IndexController@login");//登陆
    Route::post("/doLogin","Index\IndexController@doLogin");//执行登陆
    Route::get("/reg","Index\IndexController@reg");//注册
    Route::match(["get","post"],"/register","Index\IndexController@register");//执行注册
    Route::post("/sendSms","Index\IndexController@sendSms");//手机号注册
    Route::post("/sendEmail","Index\IndexController@sendEmail");//邮箱注册
    Route::get("/prolist/{id?}","Index\ProController@prolist");//商品列表
    Route::get("/proinfo/{id}","Index\ProController@proinfo")->name("shop.goodsDetail");//商品详情
    Route::get("/listcart","Index\CartController@listcart")->name("shop.listcart");//购物车列表
    Route::get("/addcart","Index\CartController@addcart");//购物车添加
    Route::get("/pay","Index\CartController@pay");//确认订单
    Route::get("/success","Index\CartController@success");//确认订单


    Route::get("/new","Index\NewController@new");
});
