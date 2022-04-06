<?php

namespace App\admin_model;

use Illuminate\Database\Eloquent\Model;

class ImageResize extends Model
{
    protected $fillable = ['resize_section_name','resize_width','resize_height','resize_status'];
}
