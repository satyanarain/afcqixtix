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
//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
//Route::auth();
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('password/create/{token}', 'UsersController@createdPassword')->name('password.create');
Route::post('password/create', 'UsersController@setPassword');
 
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
     /* ROLES */
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::patch('settings/permissionsUpdate', 'SettingsController@permissionsUpdate');
    Route::resource('settings', 'SettingsController');
    
});
//Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
//Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
//Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);