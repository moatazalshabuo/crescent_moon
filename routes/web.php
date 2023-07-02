<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('check_notifecation',[HomeController::class,"notifecation"]);
Route::get("remove_noti",[HomeController::class,"remove_noti"]);
Route::post('/login-user', [App\Http\Controllers\LoginCoustomController::class, 'index'])->name('login-user');
Route::post('/register-user', [App\Http\Controllers\RegisterController::class, 'index'])->name('register-user');


Route::controller(AdminController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::prefix("admin")->group(function () {
            Route::get("index", "index")->name("admin.index");
            Route::get("users",'users')->name("admin.users");
            Route::get("control-users",'control_users')->name("admin.control_users");
            Route::post("store-user","store_user")->name("admin.store");
            Route::delete("users","delete")->name("admin.delete");
            Route::get("users/active","active")->name("admin.active");
            Route::get("confirm-order","confirm_page")->name("admin.confirmOrder");
            Route::post("accept-order","accept_order");
            Route::post("unaccept-order","unaccept_order");
            Route::post("active_users","active_users");
        });
    });
});

Route::controller(DonorsController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::prefix("donors")->group(function () {
            Route::get("manage-meals", "ManageMeals")->name("donors.ManageMeals");
            Route::post("store-meals","storeMeals")->name("meals.store");
            Route::put("meals","updateQauntity")->name("meals.update.qauntit");
            Route::put("meals/min/","updateQauntitymin")->name("meals.update.qauntit.min");
            Route::delete("meals","delete")->name("meals.delete");
        });
    });
});

Route::controller(BeneficiaryController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::prefix("beneficiary")->group(function () {
            Route::get("restrant", "restrant")->name("beneficiary.restrant");
            Route::get("order/{id}","order")->name("beneficiary.order");
            Route::post("order","add_order")->name("beneficiary.add_order");

        });
    });
});
