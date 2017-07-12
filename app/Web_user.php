<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web_user extends Model
{
    //
//    const SEX_UN = 3;//保密
//    const SEX_GRIL = 2;//女
//    const SEX_BOY = 1;//男
//
//    public function sex($ind = null){
//        $arr = [
//            self::SEX_UN => '保密',
//            self::SEX_BOY=> '男',
//            self::SEX_GRIL=> '女',
//        ];
//        if($ind != null){
//            return array_key_exists($ind, $arr)?$arr[$ind]:$arr[self::SEX_UN];
//        }
//
//        return $arr;
//    }
}
