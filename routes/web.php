<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("index");
});

Route::resource('/home', "FirmsController"); //binding the controller to its resources
Route::get('/login', "AuthController@showLogin")->name("login");
Route::post('/login', "AuthController@doLogin");
Route::get('/logout', "AuthController@logout");
Route::group(['middleware' => 'auth:web'], function()
{
    Route::get('/register/firm', "FirmsController@showRegister")->name("register.firm");
    Route::post('/register', "FirmsController@store");
    Route::get('/dashboard', "AuthController@dashboard")->name("dashboard");
    Route::get('/view/firm/{firm}', "FirmsController@showFirm")->name("show.firm");
    Route::get('/firm/activate/{firm}', "FirmsController@activate")->name("firm.activate");
    Route::get('/firm/deactivate/{firm}', "FirmsController@deactivate")->name("firm.deactivate");
});
Route::group(['prefix' => 'api'], function () {

Route::get('/firm/verifyEmail/{token}', "LawFirmController@verifyEmail")->middleware('checkMethod');

});



