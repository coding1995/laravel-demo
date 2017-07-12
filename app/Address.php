<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [

        'id', 'uid', 'name', 'address', 'tel','emailno',
    ];
}
