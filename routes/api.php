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

    Route::get('/guest/view/firms', "Api\GuestController@showAllFirms");
    Route::post('/guest/view/firm', "Api\GuestController@viewFirm");
    Route::post('/guest/contact/firm', "Api\GuestController@contactFirm");
    Route::post('/guest/search/firm', "Api\GuestController@searchFirm");
    Route::post('/login', "Api\OauthController@login");
});


Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/get/user', "Api\MobileController@getUser");
    Route::get('/user/cases', "Api\MobileController@getCases");
    Route::post('/user/view/case', "Api\MobileController@getCase");
    Route::post('/user/schedule/meeting', "Api\MobileController@scheduleMeeting");
    Route::post('/user/add/casetask', "Api\MobileController@addCaseTask");
    Route::post('/user/add/casenote', "Api\MobileController@addCaseNote");
    Route::get('/logout', "Api\MobileController@logout");

});


    //Daily Todo management routes
    Route::post('user/add/todo', 'TodosController@addTodo');
    Route::post('user/todos/getTodos', 'TodosController@getTodos');


    // Unread Messages Routes
    Route::post('/user/count/unread', "MessageController@getUnreadMessages");

    // Fetch Users in a specific firm department
    Route::post('/associate/fetch/departmenters', "DepartmentsController@fetchUsersInDepartment");

    // Count Open cases for a specific lawyer
    Route::post('/associate/count/allcases', "CasesController@countAllCases");
    Route::post('/associate/count/opencases', "CasesController@countOpenCases");

    // Count uncompleted Tasks Assigned to me
    Route::post('/user/count/tasks', "TasksController@countUncompletedTasks");



