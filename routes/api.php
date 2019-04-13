<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['guest:api']], function () {
    Route::post("login", "Api\OauthController@login");
});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', "Api\OauthController@details");
});

//Daily Todo management routes
Route::post('user/add/todo', 'TodosController@addTodo');
Route::post('user/todos/getTodos', 'TodosController@getTodos');


// Unread Messages Routes
Route::post('/user/count/unread', "MessageController@getUnreadMessages");

// Fetch Users in a specific firm department
Route::post('/associate/fetch/departmenters', "DepartmentsController@fetchUsersInDepartment");
