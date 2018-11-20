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

Route::group(['namespace'=>'Api\V1', 'prefix'=>'v1'], function(){
	Route::post('login', 'AuthController@login');
	Route::get('getsqlitedbname', 'CommonController@getSqliteDbName');
	Route::group(['middleware'=>'jwt.auth'], function(){
		Route::post('logout', 'AuthController@logout');
		Route::post('shiftstart', 'ShiftStartController@store');
		Route::post('tripstart', 'TripStartController@store');
	    Route::post('sellticket', 'TicketController@store');
	    Route::post('importtickets', 'TicketController@importTickets');
	    Route::post('payouts', 'PayoutsController@store');
	    Route::post('inspections', 'InspectionController@store');
	});



	/*Inventory Notification CRON JOBs*/
	Route::get('notifications/inventory', 'Notifications\InventoryController@index');
});
