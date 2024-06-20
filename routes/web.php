<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DateController;
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

//User login and registration forms
Route::middleware('islogout')->group(function(){

    Route::view("/","auth.login")->name("login");
    Route::view("/register","auth.register")->name("register");
    
});


//To handle login form, calling login function of AuthController
Route::post("/login", [AuthController::class,"login"])->name("login.post");

//To handle logout
Route::get("/logout",[AuthController::class,"logout"])->name("logout");

//To handle registration form, calling register function of AuthController
Route::post("/register", [AuthController::class,"register"])->name("register.post");


//middleware to check whether user is logged in or not, before giving access to those routes
Route::middleware('islogin')->group(function (){

    //Listing of all the birthdays
    Route::get("/home", [DateController::class,"index"])->name("home");

    //To handle add date form, calling create function of DateController
    Route::post("/create", [DateController::class,"create"])->name("date.post");

    //To handle delete, calling create function of DateController
    Route::delete("/delete/{id}", [DateController::class,"delete"])->name("date.delete");

    //To view user profile page
    Route::get("/profile", [AuthController::class,"profile"])->name("profile");

    //To handle user profile update post form
    Route::post("/profile", [AuthController::class,"updateProfile"])->name("profile.post");

});

//To handle unknown routes
Route::fallback(function (){
    return view('login');
});
