<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    
    public $fillable = ['uid', 'num_id', 'buy', 'written', 'postcodes', 'address', 'tel', 'num', 'state'];
}
