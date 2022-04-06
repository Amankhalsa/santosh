<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class CategoryMoreImages extends Model
{
    protected $table = "categories_more_images";
    protected $fillable = ['category_id','category_image_name'];
}
