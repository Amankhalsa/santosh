<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $fillable = ['color_code','color_name','color_image_name'];
}
