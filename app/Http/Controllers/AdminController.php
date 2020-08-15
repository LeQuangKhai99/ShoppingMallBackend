<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('login');
    }

    public function postLogin(Request $request){
        $remember = ($request->remember == 'on') ? true : false;
        if (auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->pass
        ], $remember)){
            return redirect()->route('categories.index');
        }
        else{
            return redirect()->route('login')->with('mess', 'Sai thông tin đăng nhập');
        }
    }
}
