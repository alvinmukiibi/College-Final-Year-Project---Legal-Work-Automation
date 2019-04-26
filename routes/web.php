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

    // User Role Management Routes
    Route::get('/admin/manage/roles', "UserRolesController@viewRoles");
    Route::get('/admin/manage/roles/{role}', "UserRolesController@getRole");
    Route::post('admin/add/role', "UserRolesController@addRole");
    Route::post('admin/edit/role', "UserRolesController@editRole");
    // Associate role routes
    Route::get('/user/profile', "UserController@showProfile");

    // Meeting management routes
    Route::get('/user/manage/meetings', "MeetingsController@showMeetings");
    Route::post('/user/schedule/meeting', "MeetingsController@scheduleMeeting");

    // Messages management routes
    Route::get('/user/manage/mailbox', "MessageController@showMailbox");
    Route::post('/user/send/message', "MessageController@sendMessage");
    Route::get('/user/make/chat/{msg}/{user}', "MessageController@showChat");
    Route::get('/user/download/attachment/{attachment}', "MessageController@downloadAttachment");
    Route::post('/user/delete/conversation', "MessageController@deleteConversation");

    // Website management routes
    Route::get('/admin/manage/website', "WebsiteController@showWebsite");

    // Calendar & Event routes
    Route::get('/user/manage/calendar', "UserController@showCalendar");

    // Intake routes
    Route::get('/associate/make/intake', "CasesController@showIntakeForm");
    Route::post('/associate/register/intake', "CasesController@makeIntake");
    Route::get('/associate/view/intakes', "CasesController@viewIntakes");
    Route::get('/associate/view/case/{case}', "CasesController@viewCase");
    Route::get('/associate/make/case/{case}', "CasesController@makeCase");
    Route::get('/associate/reject/case/{case}', "CasesController@rejectCase");
    Route::get('/associate/share/case/{case}', "CasesController@shareCase");
    Route::post('/associate/submit/share', "CasesController@submitShare");
    Route::post('/associate/close/case', "CasesController@closeCase");

    // Due Diligence routes
    Route::get('/associate/make/due_diligence/{case}', "DueDiligenceController@makeDueDiligence");
    Route::post('/associate/add/duediligence', "DueDiligenceController@addDueDiligence");
    Route::get('/associate/download/file/{file}', "DueDiligenceController@downloadFile");

    // Case Routes
    Route::post('/associate/add/document', "CasesController@addDocumentToCase");
    Route::post('/associate/schedule/casemeeting', "MeetingsController@scheduleCaseMeeting");

    // Case Task Routes
    Route::post('/associate/add/casetask', "CasesController@addCaseTask");
    Route::get('/associate/complete/task/{task}', "CasesController@completeTask");

    //Note Routes
    Route::post('/associate/add/note', "CasesController@addNote");

    // Proceeding Routes
    Route::get('/associate/view/proceedings/{case}', "CasesController@viewProceedings");
    Route::post('/associate/add/proceeding', "CasesController@addProceeding");

    Route::post('/admin/savelawfirmProfile', "WebsiteController@savelawfirmProfile");

    // calendar management routes
    Route::get('/admin/manage/calendar', "CalendarController@viewCalendar");

    // Task management routes
    Route::get('/user/manage/tasks', "TasksController@viewTasks");
    Route::post('/user/assign/task', "TasksController@assignTask");
    Route::post('/user/complete/task', "TasksController@completeTask");

    // Case Type management routes
    Route::get('/admin/manage/casetypes', "CaseTypesController@viewCaseTypes");
    Route::get('/admin/manage/casetypes/{casetype}', "CaseTypesController@getCaseType");
    Route::post('/admin/add/casetype', "CaseTypesController@addCaseType");
    Route::post('/admin/edit/casetype', "CaseTypesController@editCaseType");

    // Requisition management routes
    Route::get('/associate/manage/requisitions', "RequisitionsController@viewRequisitions");
    Route::post('/associate/make/requisition', "RequisitionsController@makeRequisition");
    Route::get('/associate/cancel/requisition/{requisition}', "RequisitionsController@cancelRequisition");
    Route::get('/finance/manage/requisitions', "RequisitionsController@manageRequisitions");
    Route::get('/finance/approve/requisition/{requistion}', "RequisitionsController@approveRequisition");
    Route::get('/finance/serve/requisition/{requistion}', "RequisitionsController@markAsServed");
    Route::post('/finance/decline/requisition', "RequisitionsController@declineRequisition");
    Route::get('/finance/submit/requisition/{requisition}', "RequisitionsController@submitRequisition");
    Route::get('/partner/manage/requisitions', "RequisitionsController@partnerManageRequisitions");

    // Case Payment Routes
    Route::post('/associate/record/payment', "PaymentsController@recordPayment");
    Route::get('/associate/view/payments/{case}', "PaymentsController@viewPayments");
    Route::get('/finance/manage/payments', "PaymentsController@managePayments");
    Route::get('/finance/view/receipt/{case}/{payment}', "PaymentsController@viewReceipt");
    Route::get('/finance/send/receipt/{case}/{payment}', "PaymentsController@sendReceipt");

    // Time tracking routes
    Route::post('/associate/add/time', "TimeController@addEntry");
    Route::get('/associate/view/times/{case}', "TimeController@viewEntries");

    // Invoice routes
    Route::post('/associate/make/invoice', "InvoicesController@makeInvoice");
    Route::get('/associate/view/invoices/{case}', "InvoicesController@viewInvoices");
    Route::get('/associate/print/invoice/{case}/{invoice}', "InvoicesController@printInvoice");
    Route::get('/finance/manage/invoices', "InvoicesController@manageInvoices");
    Route::get('/finance/send/invoice/{case}/{invoice}', "InvoicesController@sendInvoice");
    //logout route
    Route::get('/logout', "AuthController@logout");

});
Route::group(['prefix' => 'api'], function () {
    Route::get('/firm/verifyEmail/{token}', "LawFirmController@verifyEmail")->middleware('checkMethod');
    Route::get('/user/verifyEmail/{token}', "StaffController@verifyEmail");
    Route::get('/user/todos/getTodos/{id}/', "TodosController@getTodos");
});

 //fallback routes
 Route::fallback(function(){
     return response()->view('page404', [], 404);
});

