<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //登录页面
    public function index(){
    	return view('login.index');
    }

    //登录逻辑
    public function login(Request $request){
    	
        $this->validate($request,[
                'email'    => 'required|email',
                'password' => 'required|min:5',
        ]);

        $data['email']    = $request->get('email');
        $data['password'] = $request->get('password');
        $remember = $request->get('is_remember');

        if(Auth::attempt($data,$remember)){
            return redirect('/posts');
        }else{
            session()->flash('danger','账户或者密码错误。');
            return redirect()->back();
        }

    }

    //退出
    public function logout(){
    	Auth::logout();
        session()->flash('success','成功退出。');
        return redirect('login');
    }
}
