<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCoustomController extends Controller
{
    public function index(){
        $login = [ "username" => request("username"),"password" => request("password")];
        if(Auth::attempt($login)){
            // if(Auth::user()->type_user == 1){
                return redirect()->route("home");
            // }
        }else{
            return redirect()->back()->with("delete","حدث خطاء اثناء تسجيل الدخول الرجاء المحاوله لاحقا",413);
        }
    }
}
