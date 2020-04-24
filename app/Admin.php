<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // protected $table="admin";
    // protected $primaryKey="admin_id";
    // protected $guarded=[];
    // public $timestamps=false;
    // protected $dates = ['admin_time'];
     //定义表名
     protected $table = "admin";
     //定义主键
     protected $primaryKey = "admin_id";
     //不自动增加时间
     protected $guarded=[];
     public $timestamps = false;
     protected $dates = ['admin_time'];
     
}
