<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::whereNotIn("type_user", [2, 3])->get();
        $order = Order::select("orders.*", "meals.name as mname", "users.name as uname", "users.count_family")
            ->where("orders.status", 1)
            ->join("meals", "meals.id", "=", "orders.meals_id")
            ->join("users", "users.id", "=", "meals.user_id")
            ->get();
        return view("admin/index", compact('user', "order"));
    }

    public function users()
    {

        $beneficiaries = User::where(["type_user" => 3, "status" => 0])->get();
        $donors =        User::where(["type_user" => 2, "status" => 0])->get();
        return view(
            "admin/accept_users",
            compact('beneficiaries', "donors")
        );
    }

    public function control_users()
    {

        $beneficiaries = User::where(["type_user" => 3])->get();
        $donors =        User::where(["type_user" => 2])->get();

        return view(
            "admin/control_user",
            compact('beneficiaries', "donors")
        );
    }

    public function store_user(Request $request)
    {
        request()->validate([
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            "name" => ['required'],
            "Nati_Id" => ["required", 'string', 'min:12'],
            "phone" => ["required"],
            "address" => ["required"]
        ], [
            "email.required" => "يرجى ادخال الايميل",
            "email.unique" => "الايميل مسجل مسبقا ",
            "username.required" => "يرجى ادخال اسم المستخدم ",
            "username.unique" => "اسم المستخدم مسجل مسبقا ",
            "name.required" => "يرجى ادخال الاسم",
            "phone.required" => "يرجى ادخال رقم الهاتف",
            "address.required" => "يرجى ادخال العنوان"
        ]);
        return User::create([
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "email" => $request->email,
            "username" => $request->username,
            "type_user" => $request->type_user,
            "count_family" => $request->count_family,
            "Nati_Id" => $request->Nati_Id,
            "phone" => $request->phone,
            "address" => $request->address,
            "status" => 1
        ]);
    }
    public function delete()
    {
        User::whereIn('id', request('ids'))->delete();
    }
    public function active()
    {
        User::whereIn('id', request('ids'))->update([
            'status' => 1
        ]);
    }

    public function confirm_page()
    {
        $order = Order::select("orders.*", "meals.name as mname", "users.name as uname", "users.count_family")->where("orders.status", 0)
            ->join("users", "users.id", "=", "orders.user_id")
            ->join("meals", "meals.id", "=", "orders.meals_id")
            ->get();

        return view("admin/confirm_order", compact("order"));
    }
    public function accept_order()
    {
        Order::whereIn('id', request('ids'))->update([
            'status' => 1
        ]);
    }

    public function unaccept_order(Request $request)
    {
        foreach ($request->ids as $id) {
            $order = Order::find($id);
            $meals = Meals::find($order->meals_id);
            $meals->qauntity = $meals->qauntity + $order->qauntity;
            $meals->update();
            $order->delete();
        }
    }

    public function active_users(Request $request){

        User::whereIn('id', $request->ids)->update([
            'status' => 1
        ]);
    }
}
