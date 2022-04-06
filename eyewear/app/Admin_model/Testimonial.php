<?php

namespace App\admin_model;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['testimonial_image_name','testimonial_given_by','testimonial_desig','testimonial_company','testimonial_status'];
}
