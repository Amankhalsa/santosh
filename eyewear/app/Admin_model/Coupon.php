<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_code','coupon_desc','coupon_amount','coupon_type','coupon_status','coupon_expiry_date','coupon_condition'];
}
