<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_access extends Model
{
    protected $fillable = [

        'role_id', 'access_id',
    ];
}
