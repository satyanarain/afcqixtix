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
    Route::resource('bus_types', 'BusTypesController');
    
    /************************masters created by satya 28-12-2017 depot***************************** */
    Route::get('services/data', 'ServiceController@anyData')->name('services.data');
    Route::post('services/store', 'ServiceController@store');
    Route::resource('services', 'ServiceController');
    /************************masters created by satya 28-12-2017 depot***************************** */
    Route::get('vehicles/data', 'VehicleController@anyData')->name('services.data');
    Route::post('vehicles/store', 'VehicleController@store');
    Route::resource('vehicles', 'VehicleController');

    /* ROLES */
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::patch('settings/permissionsUpdate', 'SettingsController@permissionsUpdate');
    Route::resource('settings', 'SettingsController');
//     Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('changepasswords/update', 'ChangepasswordsController@updatePassword');
    Route::resource('changepasswords', 'ChangepasswordsController');
});
