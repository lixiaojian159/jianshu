<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = [ 'fan_id', 'user_id' ];

    //获取关注用户信息
    public function fuser(){
    	return $this->hasOne(User::class,'id','fan_id');
    }

    //获取粉丝用户信息
    public function suser(){
    	return $this->hasOne(User::class,'id','star_id');
    }
}
