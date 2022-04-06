<?php

namespace App\admin_model;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['enq_name','enq_email','enq_mobile','enq_source','enq_msg'];
}
