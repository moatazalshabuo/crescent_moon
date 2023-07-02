<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "username" => ["required","unique:users,username"],
            "phone"=>["required"],
            "address"=>["required"]
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "username"=>$request->username,
            "type_user"=>$request->type_user,
            "count_family"=>$request->count_family,
            "phone"=>$request->phone,
            "address"=>$request->address,
            "status"=>0
        ]);
        return redirect()->route("login")->with("success","تم تسجيلك بنجاح الرجاء القيام بتسجيل الدخول");
    }
}
