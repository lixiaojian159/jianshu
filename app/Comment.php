<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [ 'post_id', 'content', 'user_id'];

	//关联模型
	public function post(){
		return $this->belongsTo(Comment::class,'id','post_id');
	}

	//关联模型
	public function user(){
		return $this->belongsTo(User::class,'user_id','id');
	}
}
