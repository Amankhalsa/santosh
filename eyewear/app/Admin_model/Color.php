<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['product_id','color','image','color_parent_id'];
}
