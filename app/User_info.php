<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $fillable = [

        'uid', 'ipaddr', 'logintime', 'pass_wrong_time_status',
    ];
}
