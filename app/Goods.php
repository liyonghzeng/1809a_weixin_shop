<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods'; 
    public $timestamps = false;
    public $primaryKey = 'goods_id';
 }

