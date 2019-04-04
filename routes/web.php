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

    // Change Password from default routes
    Route::get('/changePassword', "AuthController@showChangePasswordForm")->name("firm.changePassword");
    Route::post('/changePassword', "AuthController@doChangePassword");

    // Profile Routes
    Route::get('/admin/profile', "UserController@showProfile");
    Route::post('/admin/saveProfile', "UserController@saveUserProfile");
    // Department Management Routes
    Route::get('/admin/departments', "DepartmentsController@showDepartments");
    Route::get('/admin/departments/{department}', "DepartmentsController@getDepartment");
    Route::post('/admin/addDepartment', "DepartmentsController@addDepartment");
    Route::post('/admin/editDepartment', "DepartmentsController@editDepartment");
    // Staff Management Routes
    Route::get('/admin/manage/staff', "StaffController@showStaff");
    Route::post('/admin/add/staff', "StaffController@addStaff");
    Route::get('/admin/activate/staff/{staff}', "StaffController@activateStaff");
    Route::get('/admin/deactivate/staff/{staff}', "StaffController@deactivateStaff");

    // Associate role routes
    Route::get('/associate/profile', "UserController@showProfile");

    // Meeting management routes
    Route::get('/user/manage/meetings', "MeetingsController@showMeetings");
    Route::post('/user/schedule/meeting', "MeetingsController@scheduleMeeting");

    // Messages management routes
    Route::get('/user/manage/mailbox', "MessageController@showMailbox");
    Route::post('/user/send/message', "MessageController@sendMessage");
    Route::get('/user/make/chat/{msg}/{user}', "MessageController@showChat");
    Route::get('/user/download/attachment/{attachment}', "MessageController@downloadAttachment");
    Route::post('/user/delete/conversation', "MessageController@deleteConversation");


});
Route::group(['prefix' => 'api'], function () {
    Route::get('/firm/verifyEmail/{token}', "LawFirmController@verifyEmail")->middleware('checkMethod');
    Route::get('/user/verifyEmail/{token}', "StaffController@verifyEmail");
    Route::get('/user/todos/getTodos/{id}/', "TodosController@getTodos");
});
