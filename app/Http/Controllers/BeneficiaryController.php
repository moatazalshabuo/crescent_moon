<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    public function restrant(){
        $donors = User::where("type_user",2)->get();
        return view("beneficiary/restrant",compact('donors'));
    }

    public function order($id){
        $user = User::find($id);
        $meals = Meals::where("user_id",$id)->get();
        return view('beneficiary/order',compact("meals",'user'));
    }

    public function add_order(Request $request){
        foreach($request->ids as $id){
            Order::create([
                "meals_id"=>$id,
                "user_id"=>Auth::id(),
                "qauntity"=>$request->qauntity
            ]);
            $meals = Meals::find($id);
            $meals->qauntity = $meals->qauntity - $request->qauntity;
            $meals->update();
        }
    }
}
