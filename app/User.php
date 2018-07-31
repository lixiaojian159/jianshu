<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //关联模型：获取用户的关注数
    public function starCount(){
        return $this->hasMany(Fan::class,'fan_id','id')->count();
    }

    //关联模型：获取用户的关注列表
    public function stars(){
        return $this->hasMany(Fan::class,'fan_id','id');
    }

    //关联模型:获取用户的粉丝数
    public function fanCount(){
        return $this->hasMany(Fan::class,'star_id','id')->count();
    }

    //关联模型:获取用户的粉丝列表
    public function fans(){
        return $this->hasMany(Fan::class,'star_id','id');
    }

    //关联模型：获取用户的文章数
    public function postCount(){
        return $this->hasMany(Post::class,'user_id','id')->count();
    }

    //关联模型:获取用户的文章列表
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }

    //关联模型:我是否已经关注了某个用户
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }

    //关联模型:我是否已经被某个人关注
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //增加我对某个用户的关注
    public function doFan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    //取消我的某个用户的关注
    public function doUnFan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }
}
