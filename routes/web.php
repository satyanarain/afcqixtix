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
 
    
Route::group(['middleware' => ['auth']], function () {
 Route::get('/', 'PagesController@dashboard');
 Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
 Route::get('showdashboard', 'PagesController@showDashboard')->name('showdashboard');
    Route::get('notifications/getall', 'NotificationsController@getAll')->name('notifications.get');
    Route::post('notifications/markread', 'NotificationsController@markRead')->name('notifications.markread');
     Route::get('notifications/markall', 'NotificationsController@markAll')->name('notifications.markall'); 
 
 
     Route::get('users/data', 'UsersController@anyData')->name('users.data');
    Route::get('users/taskdata/{id}', 'UsersController@taskData')->name('users.taskdata');
    Route::get('users/closedtaskdata/{id}', 'UsersController@closedTaskData')->name('users.closedtaskdata');
    Route::get('users/clientdata/{id}', 'UsersController@clientData')->name('users.clientdata');
    Route::get('users/travelprofile/{id}', 'UsersController@showTravelModal')->name('users.createtravelprofile')->middleware('user.addtravel');
    Route::post('users/savetraveldetail/{id}', 'UsersController@saveTravelDetail')->name('users.savetraveldetail');
    Route::get('users/edittravelprofile/{id}', 'UsersController@showEditTravelModal')->name('users.edittravelprofile');
    Route::get('users/{user_id}/showtravelprofile/{travel_id}', 'UsersController@showTravelDetail')->name('users.showtravelprofile');
    Route::get('users/{user_id}/deletetravelprofile/{travel_id}', 'UsersController@deleteTravelDetail')->name('users.deletetravelprofile');
    Route::patch('users/updatetravelprofile/{id}', 'UsersController@updateTravelDetail')->name('users.updatetravelprofile');
    Route::post('users/changeprofileimage', 'UsersController@changeProfileImage')->middleware('user.changeprofileimage')->name('changeprofileimage');
    Route::get('users/editbankdetail/{id}', 'UsersController@editBankDetail')->name('users.editbankdetail')->middleware('user.editbankdetail');
    Route::patch('users/updatebankdetail/{id}', 'UsersController@updateBankDetail')->name('users.updatebankdetail');
    Route::post('users/changename', 'UsersController@changeName')->name('users.changename');
    Route::post('users/changecontact', 'UsersController@changeContact')->name('users.changecontact');
    Route::post('users/changeaddress', 'UsersController@changeAddress')->name('users.changeaddress');
    Route::resource('users', 'UsersController');
    Route::get('users/printtraveldetails/{id}', 'UsersController@printTravelDetails')->name('users.printtraveldetails');
    /* ROLES */
    Route::resource('roles', 'RolesController');
    
});
//Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
//Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
//Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);