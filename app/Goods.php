<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{	
	//和商品详情表关联
    public function GetGoodsDetail()
    {
    	return $this->hasOne('App\GoodsDetail', 'gid');
    }

    //商品分类关联
    public function getGoodSort()
    {
    	return $this->belongsTo('App\GoodSort', 'typeid');
    }

    //商品属性关联
    public function attributes()
    {
    	return $this->belongsToMany('\App\Attributes', 'goods_attributes');
    }
}
