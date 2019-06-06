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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Api\ApiController@login');

Route::post('getProfile', 'Api\ApiController@getProfile');

Route::post('updateProfile', 'Api\ApiController@updateProfile');

Route::post('changePassword', 'Api\ApiController@changePassword');

Route::post('updateLocation', 'Api\ApiController@updateLocation');

Route::post('markAttendance', 'Api\ApiController@markAttendance');

Route::post('genrateReport', 'Api\ApiController@genrateReport');

Route::post('ReportsList', 'Api\ApiController@ReportsList');

Route::post('singleReportDetails', 'Api\ApiController@singleReportDetails');

Route::post('userDashboard', 'Api\ApiController@userDashboard');

Route::post('leaveRequest', 'Api\ApiController@leaveRequest');

Route::post('LeavesList', 'Api\ApiController@LeavesList');

Route::post('sendMessage', 'Api\ApiController@sendMessage');

Route::post('ConversationList', 'Api\ApiController@ConversationList');
