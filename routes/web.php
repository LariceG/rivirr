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
Route::get('/', 'EmployerController@home');

Route::get('/admin', 'AdminController@index');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/profile', 'AdminController@profile');
Route::get('/admin/change_password', 'AdminController@change_password');
Route::post('/admin/update_profile', 'AdminController@update_profile');
Route::post('/admin/update_password', 'AdminController@update_password');


Route::get('/admin/recruits', 'AdminRecruitController@index');
Route::get('/admin/recruits/add', 'AdminRecruitController@add_recruit');
Route::get('/admin/recruits/edit/{id}', 'AdminRecruitController@edit_recruit');
Route::get('/admin/recruits/delete/{id}', 'AdminRecruitController@delete');
Route::post('/admin/recruits/insert', 'AdminRecruitController@insert');
Route::post('/admin/recruits/update', 'AdminRecruitController@update');


Route::get('/admin/categories', 'AdminCategoryController@index');
Route::get('/admin/categories/add', 'AdminCategoryController@add_category');
Route::get('/admin/categories/edit/{id}', 'AdminCategoryController@edit_category');
Route::get('/admin/categories/delete/{id}', 'AdminCategoryController@delete');
Route::post('/admin/categories/insert', 'AdminCategoryController@insert');
Route::post('/admin/categories/update', 'AdminCategoryController@update');

Route::get('/admin/majors', 'AdminMajorController@index');
Route::get('/admin/majors/add', 'AdminMajorController@add_major');
Route::get('/admin/majors/edit/{id}', 'AdminMajorController@edit_major');
Route::get('/admin/majors/delete/{id}', 'AdminMajorController@delete');
Route::post('/admin/majors/insert', 'AdminMajorController@insert');
Route::post('/admin/majors/update', 'AdminMajorController@update');

Route::get('/admin/perks', 'AdminPerksController@index');
Route::get('/admin/perks/add', 'AdminPerksController@add_perk');
Route::get('/admin/perks/edit/{id}', 'AdminPerksController@edit_perk');
Route::get('/admin/perks/delete/{id}', 'AdminPerksController@delete');
Route::post('/admin/perks/insert', 'AdminPerksController@insert');
Route::post('/admin/perks/update', 'AdminPerksController@update');

Route::get('/admin/employers', 'AdminEmployerController@index');
Route::get('/admin/employers/add', 'AdminEmployerController@add_employer');
Route::get('/admin/employers/edit/{id}', 'AdminEmployerController@edit_employer');
Route::get('/admin/employers/delete/{id}', 'AdminEmployerController@delete');
Route::post('/admin/employers/insert', 'AdminEmployerController@insert');
Route::post('/admin/employers/update', 'AdminEmployerController@update');
Route::get('/admin/employers/gallery_delete/{id}', 'AdminEmployerController@gallery_delete');
Route::post('/admin/employers/employerActive', 'AdminEmployerController@employerActive');


Route::get('/admin/employees', 'AdminEmployeeController@index');
Route::get('/admin/employees/add', 'AdminEmployeeController@add_employer');
Route::get('/admin/employees/edit/{id}', 'AdminEmployeeController@edit_employer');
Route::get('/admin/employees/delete/{id}', 'AdminEmployeeController@delete');
Route::post('/admin/employees/insert', 'AdminEmployeeController@insert');
Route::post('/admin/employees/update', 'AdminEmployeeController@update');
Route::get('/admin/employers/home_video/{id}', 'AdminEmployerController@home_video');
Route::get('/admin/bookings', 'AdminBookingController@index');
Route::get('/admin/bookings/view/{id}', 'AdminBookingController@view');
Route::get('/admin/industries', 'AdminIndustriesController@index');
Route::get('/admin/industries/delete/{id}','AdminIndustriesController@delete');
Route::get('/admin/inductries/add','AdminIndustriesController@add');
Route::post('/admin/inductries/insert','AdminIndustriesController@insert');
Route::get('/admin/inductries/edit_industries/{id}','AdminIndustriesController@edit_industries');
Route::post('/admin/inductries/update/{id}','AdminIndustriesController@update');

Route::get('/employer', 'EmployerController@index');
Route::post('/employer/login','EmployerController@login');
Route::get('/signup', 'EmployerController@signup');
Route::post('/sign_up', 'EmployerController@sign_up');
Route::get('/logout', 'EmployerController@logout');
Route::get('/profile/{id}', 'Employe_profile@profile');
Route::post('/rating/{id}', 'Employe_profile@rating');
Route::get('/edit_profile/{id}', 'EmployerController@edit_profile');
Route::post('/editprofile/{id}', 'EmployerController@editprofile');
Route::get('/about', 'PagesController@about');

Route::get('/search', 'SearchController@index');







