<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brand";
    protected $primaryKey="brand_id";
    protected $guarded=[];
    public $timestamps=false;
}
