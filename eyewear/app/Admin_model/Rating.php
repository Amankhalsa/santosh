<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id','product_id','user_name','rating','review'];
}
