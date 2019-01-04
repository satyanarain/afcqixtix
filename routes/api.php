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
	Route::group([], function(){
		Route::post('logout', 'AuthController@logout');
		Route::post('shiftstart', 'ShiftStartController@store');
		Route::post('tripstart', 'TripStartController@store');
		Route::post('tripcancellation', 'TripCancellationController@store');
	    Route::post('sellticket', 'TicketController@store');
	    Route::post('importtickets', 'TicketController@importTickets');
	    Route::post('payouts', 'PayoutsController@store');
	    Route::post('inspections', 'InspectionController@store');

	    Route::post('updatebatteryandgprslevel', 'ETMController@updateBatteryAndGPRSLevel');

	    Route::post('startmidlogoff', 'ETMController@startMidLogOff');

	    //test api for ankleahwer
	    Route::post('updateprofile', 'TestController@updateProfile');
	});	

	Route::get('getetmhealthstatusdata', 'ETMController@getETMHealthStatusData');
	Route::get('getetmhealthstatusdata/{depot}/{etmNo}/{status}', 'ETMController@getETMHealthStatusDataByParameters')->name('getetmhealthstatusdata');

	/*Inventory Notification CRON JOBs*/
	Route::get('notifications/inventory', 'Notifications\InventoryController@index');

	//Route::get('notifications/inventory', 'Notifications\InventoryController@index');
	
});
