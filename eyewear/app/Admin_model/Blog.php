<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
   protected $fillable = ['blog_image_name','blog_name','blog_slug_name','blog_desc','blog_status'];
}
