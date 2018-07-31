<?php

namespace App\Http\Controllers;
use App\User;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //中间件
    public function __construct(){
        $this->middleware('auth',[
            'except' => [''],
        ]);
    }
    //个人设置页面
    public function setting(){
    	return view('user.setting');
    }

    //个人设置逻辑
    public function settingstore(){
    	return '个人设置逻辑';
    }

    //个人中心主页
    public function show(User $user){
        // 这个人的信息, 包含关注/粉丝/文章数
        $users = User::withCount(['posts','stars','fans'])->find($user->id);
        // 这个人的文章列表, 取最近的10条 
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        // 这个人关注的用户, 包含关注/粉丝/文章
        $stars   = $user->stars();
        $susers  = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->get();
        // 这个人粉丝的用户, 包含关注/粉丝/文章
        $fans    = $user->fans();
        $fusers  = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->get();
    	return view('user.show',compact('users','posts','fusers','susers'));
    }

    //关注用户
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [ 'error'=>0, 'msg'=>'' ];
    }

    //取消关注
    public function doUnFan(User $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [ 'error'=>0, 'msg'=>'' ];
    }
}
