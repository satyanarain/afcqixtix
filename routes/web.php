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

Auth::routes();

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('password/create/{token}', 'UsersController@createdPassword')->name('password.create');
Route::post('password/create', 'UsersController@setPassword');
Route::get('password/create/{token}', 'UsersController@createdPassword')->name('password.create');
Route::post('password/create', 'UsersController@setPassword');

Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
Route::get('notifications/markall', 'NotificationsController@markAll')->name('notifications.markall');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'PagesController@dashboard');
    Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
    Route::get('showdashboard', 'PagesController@showDashboard')->name('showdashboard');
    Route::get('notifications/getall', 'NotificationsController@getAll')->name('notifications.get');
    Route::post('notifications/markread', 'NotificationsController@markRead')->name('notifications.markread');

    Route::get('users/data', 'UsersController@anyData')->name('users.data');
      Route::get('user/statusupdate/{id}', 'UsersController@statusUpdate');
    Route::post('users/store', 'UsersController@store');
    Route::resource('users', 'UsersController');
    Route::post('users/changeprofileimage', 'UsersController@changeProfileImage')->middleware('user.changeprofileimage')->name('changeprofileimage');
    /*     * **********************masters created by satya 22-11-2017 depot***************************** */
    Route::get('depots/data', 'DepotsController@anyData')->name('depots.data');
    Route::post('depots/store', 'DepotsController@store');
    Route::resource('depots', 'DepotsController');
    /************************masters created by satya 28-12-2017 depot***************************** */
    Route::get('bus_types/data', 'BusTypesController@anyData')->name('bustypes.data');
    Route::post('bus_types/store', 'BusTypesController@store');
    Route::get('bus_types/sort_order/{id}', 'BusTypesController@sortOrder');
    Route::get('bus_types/view_detail/{id}', 'BusTypesController@viewDetail');
    Route::get('bus_types/order_list', 'BusTypesController@orderList');
    Route::resource('bus_types', 'BusTypesController');
    
    /************************masters created by satya 28-12-2017 depot***************************** */
    Route::get('services/data', 'ServiceController@anyData')->name('services.data');
    Route::post('services/store', 'ServiceController@store');
    Route::get('services/sort_order/{id}', 'ServiceController@sortOrder');
    Route::get('services/view_detail/{id}', 'ServiceController@viewDetail');
    Route::get('services/order_list', 'ServiceController@orderList');
    Route::resource('services', 'ServiceController');
    /************************masters created by satya 28-12-2017 depot***************************** */
    Route::get('vehicles/data', 'VehicleController@anyData')->name('services.data');
    Route::post('vehicles/store', 'VehicleController@store');
    Route::resource('vehicles', 'VehicleController');
    
    Route::get('shifts/data', 'ShiftController@anyData')->name('shifts.data');
    Route::post('shifts/store', 'ShiftController@store');
    Route::resource('shifts', 'ShiftController');
    
    Route::get('stops/data', 'StopController@anyData')->name('stops.data');
    Route::post('stops/store', 'StopController@store');
    Route::resource('stops', 'StopController');
    
    Route::get('routes/data', 'RouteController@anyData')->name('routes.data');
    Route::post('routes/store', 'RouteController@store');
    Route::resource('routes', 'RouteController');
    
    Route::get('duties/data', 'DutyController@anyData')->name('duties.data');
    Route::post('duties/store', 'DutyController@store');
    Route::resource('duties', 'DutyController');
    
    Route::get('targets/data', 'TargetController@anyData')->name('targets.data');
    Route::post('targets/store', 'TargetController@store');
    Route::get('targets/getduties/{id}', 'TargetController@getDuty');
    
    Route::resource('targets', 'TargetController');
    
    Route::get('trips/data', 'TripController@anyData')->name('trips.data');
    Route::post('trips/store', 'TripController@store');
    Route::resource('trips', 'TripController');
    Route::get('fares/previous', 'FaresController@Previous')->name('fares.previous');
    Route::post('fares/data', 'FaresController@anyData')->name('fares.data');
    Route::get('fares/fare_list/{id}','FaresController@fareList');
     Route::get('fares/view_detail/{id}','FaresController@viewDetail');
    Route::resource('fares', 'FaresController');
  
    Route::get('concession_fare_slabs/data', 'ConcessionFareSlabController@anyData')->name('concession_fare_slabs.data');
    Route::post('concession_fare_slabs/store', 'ConcessionFareSlabController@store');
    Route::resource('concession_fare_slabs', 'ConcessionFareSlabController');
    
    Route::get('concessions/data', 'ConcessionController@anyData')->name('concessions.data');
    Route::get('concessions/sort_order/{id}','ConcessionController@sortOrder');
    Route::post('concessions/store', 'ConcessionController@store');
    
      Route::get('concessions/sort_order/{id}', 'ConcessionController@sortOrder');
    Route::get('concessions/view_detail/{id}', 'ConcessionController@viewDetail');
    Route::get('concessions/order_list', 'ConcessionController@orderList');
    
    Route::resource('concessions', 'ConcessionController');
    Route::get('trip_cancellation_reasons/data', 'TripCancellationReasonController@anyData')->name('trip_cancellation_reasons.data');
    Route::post('trip_cancellation_reasons/store', 'TripCancellationReasonController@store');
    Route::get('trip_cancellation_reasons/sort_order/{id}', 'TripCancellationReasonController@sortOrder');
    Route::get('trip_cancellation_reasons/view_detail/{id}', 'TripCancellationReasonController@viewDetail');
    Route::get('trip_cancellation_reasons/order_list', 'TripCancellationReasonController@orderList');
    Route::resource('trip_cancellation_reasons', 'TripCancellationReasonController');
    
    
     Route::get('inspector_remarks/data', 'InspectorRemarkController@anyData')->name('inspector_remarks.data');
    Route::post('inspector_remarks/store', 'InspectorRemarkController@store');
     Route::get('inspector_remarks/sort_order/{id}', 'InspectorRemarkController@sortOrder');
    Route::get('inspector_remarks/view_detail/{id}', 'InspectorRemarkController@viewDetail');
    Route::get('inspector_remarks/order_list', 'InspectorRemarkController@orderList');
    Route::resource('inspector_remarks', 'InspectorRemarkController');
    
    Route::get('payout_reasons/data', 'PayoutReasonController@anyData')->name('payout_reasons.data');
    Route::post('payout_reasons/store', 'PayoutReasonController@store');
    Route::get('payout_reasons/sort_order/{id}', 'PayoutReasonController@sortOrder');
    Route::get('payout_reasons/view_detail/{id}', 'PayoutReasonController@viewDetail');
    Route::get('payout_reasons/order_list', 'PayoutReasonController@orderList');
    Route::resource('payout_reasons', 'PayoutReasonController');
    
    Route::get('denominations/data', 'DenominationController@anyData')->name('payout_reasons.data');
    Route::post('denominations/add_new', 'DenominationController@addNew');
    Route::post('denominations/store', 'DenominationController@store');
    Route::resource('denominations', 'DenominationController');
   
    
    Route::get('pass_types/data', 'PassTypeController@anyData')->name('pass_types.data');
    Route::post('pass_types/store', 'PassTypeController@store');
     Route::get('pass_types/sort_order/{id}', 'PassTypeController@sortOrder');
    Route::get('pass_types/view_detail/{id}', 'PassTypeController@viewDetail');
    Route::get('pass_types/order_list', 'PassTypeController@orderList');
    Route::resource('pass_types', 'PassTypeController');
    
    Route::get('crew_details/data', 'CrewDetailController@anyData')->name('crew_details.data');
    Route::post('crew_details/store', 'CrewDetailController@store');
    Route::resource('crew_details', 'CrewDetailController');
    /* ROLES */
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::post('permissions/savemenuall', 'PermissionsController@saveMenuAll');
    Route::patch('settings/permissionsUpdate', 'SettingsController@permissionsUpdate');
    Route::resource('settings', 'SettingsController');
    Route::post('changepasswords/update', 'ChangepasswordsController@updatePassword');
    Route::resource('changepasswords', 'ChangepasswordsController');
    
    
    
});
