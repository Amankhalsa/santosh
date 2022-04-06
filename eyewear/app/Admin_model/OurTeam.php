<?php

namespace App\admin_model;

use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    protected $fillable = ['member_image_name','member_name','member_designation','member_status'];
}
