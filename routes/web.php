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


Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'AdminController@index');

Route::get('/admin', 'AdminController@index');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/profile', 'AdminController@profile');
Route::get('/admin/change_password', 'AdminController@change_password');
Route::post('/admin/update_profile', 'AdminController@update_profile');
Route::post('/admin/update_password', 'AdminController@update_password');

Route::get('/admin/supervisors', 'AdminSupervisorController@index');
Route::get('/admin/supervisors/add', 'AdminSupervisorController@add');
Route::post('/admin/supervisors/insert', 'AdminSupervisorController@insert');
Route::get('/admin/supervisors/updateStatus/{id}', 'AdminSupervisorController@statusUpdate');
Route::get('/admin/supervisors/delete/{id}', 'AdminSupervisorController@delete');
Route::get('/admin/supervisors/edit/{id}', 'AdminSupervisorController@edit');
Route::get('/admin/supervisors/getChat/{id}', 'AdminSupervisorController@getChat');
Route::get('/admin/supervisors/updateChatNotification', 'AdminSupervisorController@updateChatNotification');
Route::post('/admin/supervisors/update', 'AdminSupervisorController@update');
Route::post('/admin/supervisors/sendMessage', 'AdminSupervisorController@sendMessage');

Route::get('/admin/employees', 'AdminEmployeeController@index');
Route::get('/admin/employees/add', 'AdminEmployeeController@add');
Route::post('/admin/employees/insert', 'AdminEmployeeController@insert');
Route::get('/admin/employees/updateStatus/{id}', 'AdminEmployeeController@statusUpdate');
Route::get('/admin/employees/delete/{id}', 'AdminEmployeeController@delete');
Route::get('/admin/employees/edit/{id}', 'AdminEmployeeController@edit');
Route::post('/admin/employees/update', 'AdminEmployeeController@update');

Route::get('/admin/clients', 'AdminClientController@index');
Route::get('/admin/clients/add', 'AdminClientController@add');
Route::post('/admin/clients/insert', 'AdminClientController@insert');
Route::get('/admin/clients/updateStatus/{id}', 'AdminClientController@statusUpdate');
Route::get('/admin/clients/delete/{id}', 'AdminClientController@delete');
Route::get('/admin/clients/edit/{id}', 'AdminClientController@edit');
Route::post('/admin/clients/update', 'AdminClientController@update');
Route::get('/admin/clients/getEmployees/{id}', 'AdminClientController@getEmployees');
Route::get('/admin/client/sites/{id}','AdminClientController@add_sites');
Route::post('/admin/client/insert_sites/{id}','AdminClientController@insert_sites');
Route::get('/admin/client/profile/{id}','AdminClientController@profile');
Route::get('/admin/client/site/delete/{id}','AdminClientController@delete_site');
Route::get('/admin/client/site/edit','AdminClientController@edit_site');
Route::post('admin/client/site/update','AdminClientController@update_site');
Route::get('/admin/client/site/validate','AdminClientController@valiDation');

Route::get('/admin/sites', 'AdminSiteController@index');
Route::get('/admin/sites/add', 'AdminSiteController@add');
Route::post('/admin/sites/insert', 'AdminSiteController@insert');
Route::get('/admin/sites/delete/{id}', 'AdminSiteController@delete');
Route::get('/admin/sites/edit/{id}', 'AdminSiteController@edit');
Route::post('/admin/sites/update', 'AdminSiteController@update');
Route::get('/admin/client/sites','ClientController@sites');

Route::get('/admin/reports','AdminReportController@index');
Route::get('/admin/reports/delete/{id}', 'AdminReportController@delete');
Route::get('/admin/reports/view/{id}', 'AdminReportController@view');
Route::get('/admin/leaves','AdminLeavesController@leaves');
Route::get('/change_status/{id}/{status}','AdminLeavesController@change_status');
Route::get('/admin/positions','AdminController@position');
Route::get('/positions/delete/{id}','AdminController@delete_position');
Route::get('/positions/add','AdminController@add_position');
Route::post('/positions/insert','AdminController@add_insert');
Route::get('/positions/edit/{id}','AdminController@position_edit');
Route::post('/positions/update','AdminController@add_update');
Route::get('/delete/image','AdminSupervisorController@delete_img');
Route::get('/employee/sites','AdminEmployeeController@manage_sites');
Route::get('/employee/reports','AdminReportController@index');
Route::get('/employee/reports/add','AdminEmployeeController@add_report');
Route::post('/employee/reports/genrate','AdminEmployeeController@genrateReport');
Route::get('/employee/leaves','AdminLeavesController@leaves');
Route::get('/employee/leaves/add','AdminEmployeeController@leave_add');
Route::post('/employee/leaveRequest','AdminEmployeeController@leaveRequest');
Route::get('/admin/financial_documents','AdminFinancialDocumentController@document');
Route::get('/admin/financial_documents/add','AdminFinancialDocumentController@add');
Route::post('/admin/financial_documents/insert','AdminFinancialDocumentController@insert');
Route::get('/admin/financial_documents/delete/{id}','AdminFinancialDocumentController@delete');
Route::get('/admin/financial_documents/edit/{id}','AdminFinancialDocumentController@edit');
Route::post('/admin/financial_documents/update','AdminFinancialDocumentController@update');
Route::get('/employee/attendance/{id}','AdminSupervisorController@employee_attendance');



