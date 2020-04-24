<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view("index",["name"=>"范英刚"]);
    }
    public function doAdd(){
        $data=request()->all();
        dd($data);
    }
    public function goods($od,$name=null){
        echo $od;
        dd($name);
    }
}
