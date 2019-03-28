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
    Route::get('/firm/changePassword', "LawFirmController@showChangePasswordForm")->name("firm.changePassword");
    Route::post('/firm/changePassword', "LawFirmController@doChangePassword");

    Route::get('/admin/profile', "UserController@showProfile");
    Route::post('/admin/saveProfile', "UserController@saveAdminProfile");
    Route::get('/admin/departments', "DepartmentsController@showDepartments");
    Route::get('/admin/departments/{department}', "DepartmentsController@getDepartment");
    Route::post('/admin/addDepartment', "DepartmentsController@addDepartment");
    Route::post('/admin/editDepartment', "DepartmentsController@editDepartment");

    Route::get('/admin/manage/staff', "StaffController@showStaff");
    Route::post('/admin/add/staff', "StaffController@addStaff");
});
Route::group(['prefix' => 'api'], function () {

Route::get('/firm/verifyEmail/{token}', "LawFirmController@verifyEmail")->middleware('checkMethod');

});
