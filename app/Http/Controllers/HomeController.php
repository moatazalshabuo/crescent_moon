<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function notifecation(){
        $count = Order::where(["user_id"=>Auth::id(),"natifecation"=>1,"status"=>1])->count();
        $data = Order::select("users.count_family","users.name","orders.*")->
        join("users","users.id","=","orders.user_id")->
        where(['orders.user_id'=>Auth::id(),"orders.status"=>1])->offset(0)->limit(5)->get();

        return response()->json(['count'=>$count,'data'=>$data]);
    }

    public function remove_noti(){
        Order::where(["user_id"=>Auth::id(),"natifecation"=>1,"status"=>1])->update([
            'natifecation'=>0
        ]);
    }

}
