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
}
