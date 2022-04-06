<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable= ['product_id','user_id'];

}
