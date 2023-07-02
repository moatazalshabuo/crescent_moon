<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorsController extends Controller
{
    public function ManageMeals(){
        $meals = Meals::where("user_id",Auth::id())->get();
        return view("donors/manage_meals",compact("meals"));
    }

    public function storeMeals(Request $request){
        $request->validate([
            "name"=>["required","string","max:40"],
            "qauntity"=>["required","integer","min:0","max:10000000"]
        ]);
        Meals::create([
            'name'=>$request->name,
            "qauntity"=>$request->qauntity,
            "descripe"=>$request->descripe,
            "user_id"=>Auth::id()
        ]);
    }

    public function delete(){
        Meals::whereIn('id',request('ids'))->delete();
    }

    public function updateQauntity(Request $request){

        foreach($request->ids as $id){
            $meals = Meals::find($id);
            $meals->qauntity = $meals->qauntity + $request->qauntity;
            $meals->update();
        }

        echo "done";
    }
    public function updateQauntitymin(Request $request){

        foreach($request->ids as $id){
            $meals = Meals::find($id);
            $meals->qauntity = $meals->qauntity - $request->qauntity;
            $meals->update();
        }

        echo "done";
    }
}
