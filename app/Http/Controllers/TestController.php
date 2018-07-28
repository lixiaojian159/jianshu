<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class TestController extends Controller
{
    //测试app容器类
    public function test_app(){
    	$app = app();
    	dump($app);
    }

    //测试auth
    public function test_auth(){
    	$user = Auth::user();
    	dd($user);
    }
}
