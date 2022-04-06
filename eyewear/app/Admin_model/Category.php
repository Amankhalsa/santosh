<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    public function more_images(){
        return $this->hasMany( CategoryMoreImages::class, "category_id" );
    }

    public function color_images(){
        return $this->hasMany( Color::class, "product_id" );
    }
}
