<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','content','user_id'];

    protected $dates = ['deleted_at'];

    //关联模型:获取作者用户
    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

    //关联模型:获取文章的评论
    public function comments(){
    	return $this->hasMany(Comment::class,'post_id','id')->orderBy('created_at','desc');
    }

    //自己：查看是否已经赞了该文章
    public function is_zan($user_id){
        $res = Zan::where('post_id',$this->id)->where('user_id',$user_id)->get();
        return $res;
    }

    //关联模型:和用户进行关联
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    //关联模型:获取该文章的所有点赞
    public function zans(){
        return $this->hasMany(Zan::class);
    }
}
