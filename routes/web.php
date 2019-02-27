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
Route::get('/login', "AuthController@showLogin");
Route::post('/login', "AuthController@doLogin");
Route::get('/dashboard', "AuthController@dashboard");
Route::get('/logout', "AuthController@logout");

Route::get('/register/firm', "FirmsController@showRegister");
Route::post('/register', "FirmsController@store");