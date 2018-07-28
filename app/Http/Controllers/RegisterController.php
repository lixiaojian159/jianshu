<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
    	return view('register.index');
    }

    public function register(Request $request){

    	$this->validate($request,[
    		    'name'     => 'required|unique:users,name|min:2',
    		    'email'    => 'required|unique:users,email|email',
    		    'password' => 'required|min:5|confirmed',
    	]);

    	$data['name']  = $request->get('name');
    	$data['email'] = $request->get('email');
    	$data['password'] =  bcrypt($request->get('password'));
    	User::create($data);
    	session()->flash('success','注册成功。');
    	
    	return redirect('/login');
    }
}
