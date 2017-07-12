<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [

        'username', 'email', 'password','remember_token','status','tel','token',
    ];


}
