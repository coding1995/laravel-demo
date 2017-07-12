<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['username','is_admin','sex','password','grade','pic','tel','email','remember_token'];
}
