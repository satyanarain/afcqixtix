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
Route::get('/401', function () {
    return view('/errors/401');
})->name('401');
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
//Route::resource('create_passwords', 'CreatePasswordsController', ['only'=> ['index','create','store','update']]);
Route::resource('create_passwords', 'CreatePasswordsController');
 
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
//Route::get('notifications/markall', 'NotificationsController@markAll')->name('notifications.markall');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'PagesController@dashboard');
    Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
    Route::get('showdashboard', 'PagesController@showDashboard')->name('showdashboard');
//    Route::get('notifications/getall', 'NotificationsController@getAll')->name('notifications.get');
//    Route::post('notifications/markread', 'NotificationsController@markRead')->name('notifications.markread');

    Route::get('users/data', 'UsersController@anyData')->name('users.data');
    Route::get('users/statusupdate/{id}', 'UsersController@statusUpdate');
    Route::get('users/roleupdate/{id}', 'UsersController@roleUpdate');
    Route::post('users/store', 'UsersController@store');
    Route::resource('users', 'UsersController');
     Route::post('users/changeprofileimage', 'UsersController@changeProfileImage')->middleware('user.changeprofileimage')->name('changeprofileimage');
    /*     * **********************masters created by satya 22-11-2017 depot***************************** */
    Route::get('depots/data', 'DepotsController@anyData')->name('depots.data');
    Route::post('depots/store', 'DepotsController@store');
    Route::get('depots/order_list', 'DepotsController@orderList');
    Route::resource('depots', 'DepotsController');
    /************************masters created by satya 28-12-2017 depot***************************** */
    /************************ Manage Depot Vehicle ***************************** */
    Route::get('depots/{depot_id}/vehicles', 'VehicleController@index');
    Route::get('depots/{depot_id}/vehicles/create', 'VehicleController@create');
    Route::resource('depots.vehicles', 'VehicleController');
    /************************ Manage Depot Vehicle ***************************** */
    /************************ Manage Depot Crew ***************************** */
    Route::get('crew/view_detail/{id}', 'CrewController@viewDetail');
    Route::get('depots/{depot_id}/crew', 'CrewController@index');
    Route::get('depots/{depot_id}/crew/create', 'CrewController@create');
    Route::resource('depots.crew', 'CrewController');
//    Route::get('crew_details/data', 'CrewDetailController@anyData')->name('crew_details.data');
//    Route::post('crew_details/store', 'CrewDetailController@store');
//    Route::resource('crew_details', 'CrewDetailController');
    /************************ Manage Depot Crew ***************************** */
    /************************ Manage Bus Types ***************************** */
    Route::get('bus_types/data', 'BusTypesController@anyData')->name('bustypes.data');
    Route::post('bus_types/store', 'BusTypesController@store');
    Route::get('bus_types/sort_order/{id}', 'BusTypesController@sortOrder');
    Route::get('bus_types/view_detail/{id}', 'BusTypesController@viewDetail');
    Route::get('bus_types/order_list', 'BusTypesController@orderList');
    Route::resource('bus_types', 'BusTypesController');
    /************************ Manage Bus Types ***************************** */
    /*************************Manage Bus Type Services********************** */
    Route::get('services/view_detail/{id}', 'ServiceController@viewDetail');
    Route::get('bus_types/{bus_type_id}/services', 'ServiceController@index');
    Route::get('bus_types/{bus_type_id}/services/create', 'ServiceController@create');
    Route::resource('bus_types.services', 'ServiceController');
//    Route::get('services/data', 'ServiceController@anyData')->name('services.data');
//    Route::post('services/store', 'ServiceController@store');
    Route::get('services/sort_order/{id}/{bus_type_id}/', 'ServiceController@sortOrder');
    Route::get('services/order_list/{bus_type_id}', 'ServiceController@orderList');
//    Route::resource('services', 'ServiceController');
     /*************************Manage Bus Type Services********************** */
    /*************************Manage Bus Type Service Fares********************** */
    Route::get('fares/previous', 'FaresController@Previous')->name('fares.previous');
    Route::post('fares/data', 'FaresController@anyData')->name('fares.data');
    Route::get('fares/fare_list/{id}','FaresController@fareList');
    Route::get('fares/view_detail/{id}','FaresController@viewDetail');
    Route::resource('bus_types.services.fares', 'FaresController');
    //Route::resource('fares', 'FaresController');
    /*************************Manage Bus Type Service Fare********************** */
    /*************************Manage Bus Type Service Concession Fare********************** */
    //Route::get('concession_fare_slabs/data', 'ConcessionFareSlabController@anyData')->name('concession_fare_slabs.data');
    //Route::post('concession_fare_slabs/store', 'ConcessionFareSlabController@store');
    //Route::resource('concession_fare_slabs', 'ConcessionFareSlabController');
    Route::resource('bus_types.services.concession_fare_slabs', 'ConcessionFareSlabController');
    /*************************Manage Bus Type Service Concession Fare********************** */
    /*************************Manage Bus Type Service Concession********************** */
//    Route::get('concessions/data', 'ConcessionController@anyData')->name('concessions.data');
    Route::get('concessions/sort_order/{id}/{service_id}/{bus_type_id}/','ConcessionController@sortOrder');
//    Route::post('concessions/store', 'ConcessionController@store');
    Route::get('concessions/view_detail/{id}', 'ConcessionController@viewDetail');
    Route::get('concessions/order_list/{service_id}', 'ConcessionController@orderList');
    Route::resource('bus_types.services.concessions', 'ConcessionController');
    /*************************Manage Bus Type Service Concession********************** */
    /*************************Manage Bus Type Service Pass Type********************** */
//    Route::get('pass_types/data', 'PassTypeController@anyData')->name('pass_types.data');
//    Route::post('pass_types/store', 'PassTypeController@store');
    Route::get('pass_types/sort_order/{id}/{service_id}/{bus_type_id}/', 'PassTypeController@sortOrder');
    Route::get('pass_types/view_detail/{id}', 'PassTypeController@viewDetail');
    Route::get('pass_types/order_list/{service_id}', 'PassTypeController@orderList');
    Route::resource('bus_types.services.pass_types', 'PassTypeController');
    /*************************Manage Bus Type Service Pass Type********************** */
    
    /************************masters created by satya 28-12-2017 depot***************************** */
//    Route::get('vehicles/data', 'VehicleController@anyData')->name('services.data');
//    Route::post('vehicles/store', 'VehicleController@store');
//    Route::resource('vehicles', 'VehicleController');
    
    Route::get('shifts/data', 'ShiftController@anyData')->name('shifts.data');
    Route::post('shifts/store', 'ShiftController@store');
      Route::get('shifts/sort_order/{id}', 'ShiftController@sortOrder');
    Route::get('shifts/view_detail/{id}', 'ShiftController@viewDetail');
    Route::get('shifts/order_list', 'ShiftController@orderList');
    Route::resource('shifts', 'ShiftController');
    
    Route::get('stops/data', 'StopController@anyData')->name('stops.data');
    Route::post('stops/store', 'StopController@store');
    Route::resource('stops', 'StopController');
    
    Route::get('routes/data', 'RouteController@anyData')->name('routes.data');
    Route::get('routes/view_detail/{id}', 'RouteController@viewDetail');
    Route::get('route_master/{route_id}/routes', 'RouteController@index');
    Route::post('routes/store', 'RouteController@store');
    Route::resource('route_master.routes', 'RouteController');
    
    Route::get('route_master/data', 'RouteMasterController@anyData')->name('routes.data');
    Route::get('route_master/view_detail/{id}', 'RouteMasterController@viewDetail');
    Route::post('route_master/store', 'RouteMasterController@store');
    Route::resource('route_master', 'RouteMasterController');
    
//    Route::get('duties/data', 'DutyController@anyData')->name('duties.data');
//    Route::post('duties/store', 'DutyController@store');
    
    Route::get('duties/sort_order/{id}/{route_id}/', 'DutyController@sortOrder');
    Route::get('duties/view_detail/{id}', 'DutyController@viewDetail');
    Route::get('duties/order_list/{route_id}', 'DutyController@orderList');
    Route::get('route_master/{route_master_id}/duties', 'DutyController@index');
    Route::get('route_master/{route_master_id}/duties/create', 'DutyController@create');
    Route::resource('route_master.duties', 'DutyController');
    
//    Route::get('trips/data', 'TripController@anyData')->name('trips.data');
//    Route::get('trips/getsubcat/{id}', 'TripController@getSubCat');
    Route::get('trips/view_detail/{id}', 'TripController@viewDetail');
//    Route::post('trips/store', 'TripController@store');
    Route::resource('route_master.duties.trips', 'TripController');
    Route::get('tripsheet', 'TripController@tripSheet')->name('tripsheet');
    Route::post('gettripsbyrouteandduty', 'TripController@getTripsByRouteAndDuty')->name('gettripsbyrouteandduty');
    Route::post('getticketsbyparams', 'TripController@getTicketsByParams')->name('getticketsbyparams');
    Route::post('getdutiesbyroute', 'TripController@getDutiesByRoute')->name('getdutiesbyroute');
    Route::post('gettripsbylogin', 'TripController@getTripsByLogin')->name('gettripsbylogin');

    //Route::get('targets/data', 'TargetController@anyData')->name('targets.data');
    //Route::post('targets/store', 'TargetController@store');
    //Route::get('targets/getduties/{id}', 'TargetController@getDuty');
    //Route::get('routes/{route_id}/targets', 'TargetController@index');
    Route::resource('route_master.duties.targets', 'TargetController');
    
    
    
    
  
    
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
   
    Route::get('etm_details/data', 'EtmDetailController@anyData')->name('etm_details.data');
    Route::get('etm_details/view_detail/{id}', 'EtmDetailController@viewDetail');
    Route::resource('etm_details', 'EtmDetailController');
    Route::get('etm/health_status', 'EtmDetailController@healthStatus');
    Route::get('etm/parameters', 'EtmDetailController@parameters')->name('etm.parameters');
    Route::post('etm/parameters', 'EtmDetailController@storeParameters');
    Route::get('etm/getparametersbystatus/{status}', 'EtmDetailController@getParametersByStatus')->name('etm.getparametersbystatus');
    /* ROLES */
    Route::get('roles/data', 'RolesController@anyData')->name('roles.data');
    Route::get('roles/view_detail/{id}', 'RolesController@viewDetail');
    Route::resource('roles', 'RolesController');
     
    Route::resource('permissions', 'PermissionsController');
    Route::post('permissions/savemenuall', 'PermissionsController@saveMenuAll');
    //Route::patch('settings/permissionsUpdate', 'SettingsController@permissionsUpdate');
    //Route::resource('settings', 'SettingsController');
    Route::post('changepasswords/update', 'ChangepasswordsController@updatePassword');
    Route::get('trip_cancellation_reasons/order_list', 'TripCancellationReasonController@orderList');
    
    
    Route::resource('changepasswords', 'ChangepasswordsController');
    
    
    //Route::get('versions/data', 'VersionController@anyData')->name('stops.data');
    //Route::post('stops/store', 'StopController@store');
    Route::get('versions/view_differences/{id}', 'VersionController@viewDifferences');
    Route::post('versions/approve_change/{id}', 'VersionController@approveChange');
    Route::get('versions/view_detail/{tablename}/{id}/{logtable}', 'VersionController@viewDetail');
    Route::resource('versions', 'VersionController');
    Route::get('settings/view_detail/{id}', 'SettingController@viewDetail');
    Route::resource('settings', 'SettingController');
    
    //Manage inventory route
    //@Auther Subhash Chandra, {email: subash_chandra@opiant.in}
    Route::group(['prefix'=>'inventory', 'namespace'=>'Inventory', 'as'=>'inventory.'], function(){
        Route::resource('centerstock', 'CenterstockController')->except('show');
        Route::group(['prefix'=>'centerstock', 'as'=>'centerstock.'], function(){
            Route::get('summary', 'CenterstockController@summary')->name('summary');
        });

        Route::resource('depotstock', 'DepotstockController')->except('show');
        Route::group(['prefix'=>'depotstock', 'as'=>'depotstock.'], function(){
            Route::post('getseries', 'DepotstockController@getSeries')->name('getseries');
            Route::post('getstartsequence', 'DepotstockController@getStartSequence')->name('getstartsequence');
            Route::post('validateendsequence', 'DepotstockController@validateEndSequence')->name('validateendsequence');
            Route::post('validatequantity', 'DepotstockController@validateQuantity')->name('validatequantity');
            Route::get('summary', 'DepotstockController@summary')->name('summary');
        });

        Route::resource('crewstock', 'CrewstockController')->except('show');
        Route::group(['prefix'=>'crewstock', 'as'=>'crewstock.'], function(){
            Route::post('getseries', 'CrewstockController@getSeries')->name('getseries');
            Route::post('getstartsequence', 'CrewstockController@getStartSequence')->name('getstartsequence');
            Route::post('validateendsequence', 'CrewstockController@validateEndSequence')->name('validateendsequence');
            Route::post('validatequantity', 'CrewstockController@validateQuantity')->name('validatequantity');
            Route::get('summary', 'CrewstockController@summary')->name('summary');
            Route::get('getdepotwisecrew/{depotId}', 'CrewstockController@getDepotWiseCrews')->name('getdepotwisecrew');
        });

        Route::resource('returncrewstock', 'ReturnCrewstockController');
        Route::group(['prefix'=>'return', 'as'=>'return.'], function(){
            Route::post('getseries', 'ReturnCrewstockController@getSeries')->name('getseries');
            Route::post('getstartsequence', 'ReturnCrewstockController@getStartSequence')->name('getstartsequence');
            Route::post('validateendsequence', 'ReturnCrewstockController@validateEndSequence')->name('validateendsequence');
            Route::post('validatequantity', 'ReturnCrewstockController@validateQuantity')->name('validatequantity');
        });
    });

    Route::group(['prefix'=>'notification', 'namespace'=>'Notification', 'as'=>'notification.'], function(){
        Route::group(['prefix'=>'inventory', 'as'=>'inventory.', 'namespace'=>'Inventory'], function(){
            Route::get('/', 'IndexController@index')->name('index');
            Route::resource('centerstock', 'CenterStockController')->only(['index', 'store', 'edit', 'update']);
            Route::resource('depotstock', 'DepotStockController')->only(['index', 'store', 'edit', 'update']);
            Route::get('getitemsandadmins', 'CenterStockController@getItemsandAdmins')->name('getitemsandadmins');
        });
    });
    
    
    Route::get('waybills/data', 'WaybillController@anyData')->name('waybill.data');
    Route::get('waybills/view_detail/{id}', 'WaybillController@viewDetail');
    Route::get('waybills/close/{id}', 'WaybillController@close')->name('waybills.close');
    Route::get('waybills/auditdetail/{id}', 'WaybillController@auditdetail')->name('waybills.auditdetail');
    Route::post('waybills/saveaudit', 'WaybillController@saveaudit')->name('waybills.saveaudit');
    Route::get('waybills/auditlist', 'WaybillController@auditlist')->name('waybills.auditlist');
    Route::get('waybills/cash_collection', 'WaybillController@cash_collection')->name('waybills.cash_collection');
    Route::post('waybills/getabstractdetail', 'WaybillController@getabstractdetail')->name('waybills.getabstractdetail');
    Route::post('waybills/storecash', 'WaybillController@storecash')->name('waybills.storecash');
    Route::post('waybills/getdata/{id}', 'WaybillController@getData');
    Route::post('waybills/getfiltereddata', 'WaybillController@getfiltereddata')->name('waybills/getfiltereddata');
    Route::resource('waybills', 'WaybillController')->except('show');
    
    /******************************Created by satya 06-12-2018**************************************************/
    /******************************Start Report Routes**************************************************/
    //   Route::resource('centerstock', 'CenterStockController')->only(['index', 'store', 'edit', 'update']);
    
    Route::group(['prefix'=>'reports', 'namespace'=>'Reports', 'as'=>'reports.'], function(){

        Route::group(['prefix'=>'etm', 'namespace'=>'ETM', 'as'=>'etm.'], function(){
            /*audit_status*/
            Route::resource('audit_status', 'AuditStatusController')->only('index'); 
            Route::post('audit_status/getpdfreport', 'AuditStatusController@getPdfReport')->name('audit_status.getpdfreport');
            Route::get('audit_status/getexcelreport', 'AuditStatusController@getExcelReport')->name('audit_status.getexcelreport');
            Route::get('audit_status/displayData', 'AuditStatusController@displayData')->name('audit_status.displaydata');
            Route::get('audit_status/getetmsbydepotid/{id}', 'AuditStatusController@getETMsByDepotId')->name('audit_status.getetmsbydepotid');

            /*trip_cancellation*/
            Route::resource('trip_cancellation', 'TripCancellationController')->only('index'); 
            Route::post('trip_cancellation/getpdfreport', 'TripCancellationController@getPdfReport')->name('trip_cancellation.getpdfreport');
            Route::get('trip_cancellation/getexcelreport', 'TripCancellationController@getExcelReport')->name('trip_cancellation.getexcelreport');
            Route::get('trip_cancellation/displayData', 'TripCancellationController@displayData')->name('trip_cancellation.displaydata');

            /*penalty_ticket_details*/
            Route::resource('penalty_ticket_details', 'PenaltyTicketDetailsController')->only('index'); 
            Route::post('penalty_ticket_details/getpdfreport', 'PenaltyTicketDetailsController@getPdfReport')->name('penalty_ticket_details.getpdfreport');
            Route::get('penalty_ticket_details/getexcelreport', 'PenaltyTicketDetailsController@getExcelReport')->name('penalty_ticket_details.getexcelreport');
            Route::get('penalty_ticket_details/displayData', 'PenaltyTicketDetailsController@displayData')->name('penalty_ticket_details.displaydata');

            /*passes_validated_details*/
            Route::resource('passes_validated_details', 'PassesValidatedDetailsController')->only('index'); 
            Route::post('passes_validated_details/getpdfreport', 'PassesValidatedDetailsController@getPdfReport')->name('passes_validated_details.getpdfreport');
            Route::get('passes_validated_details/getexcelreport', 'PassesValidatedDetailsController@getExcelReport')->name('passes_validated_details.getexcelreport');
            Route::get('passes_validated_details/displayData', 'PassesValidatedDetailsController@displayData')->name('passes_validated_details.displaydata');

            /*not_sync*/        
            Route::resource('not_sync', 'NotSyncController')->only('index'); 
            Route::post('not_sync/getpdfreport', 'NotSyncController@getPdfReport')->name('not_sync.getpdfreport');
            Route::get('not_sync/getexcelreport', 'NotSyncController@getExcelReport')->name('not_sync.getexcelreport');
            Route::get('not_sync/displayData', 'NotSyncController@displayData')->name('not_sync.displaydata');

            /*issue_details*/
            Route::resource('issue_details', 'IssueDetailsController')->only('index'); 
            Route::post('issue_details/getpdfreport', 'IssueDetailsController@getPdfReport')->name('issue_details.getpdfreport');
            Route::get('issue_details/getexcelreport', 'IssueDetailsController@getExcelReport')->name('issue_details.getexcelreport');
            Route::get('issue_details/displayData', 'IssueDetailsController@displayData')->name('issue_details.displaydata');

            /*activity_log*/
            Route::resource('activity_log', 'ActivityLogController')->only('index'); 
            Route::post('activity_log/getpdfreport', 'ActivityLogController@getPdfReport')->name('activity_log.getpdfreport');
            Route::get('activity_log/getexcelreport', 'ActivityLogController@getExcelReport')->name('activity_log.getexcelreport');
            Route::get('activity_log/displayData', 'ActivityLogController@displayData')->name('activity_log.displaydata');

            /*pending_activity_log*/
            Route::resource('pending_activity_log', 'PendingActivityLogController')->only('index'); 
            Route::post('pending_activity_log/getpdfreport', 'PendingActivityLogController@getPdfReport')->name('pending_activity_log.getpdfreport');
            Route::get('pending_activity_log/getexcelreport', 'PendingActivityLogController@getExcelReport')->name('pending_activity_log.getexcelreport');
            Route::get('pending_activity_log/displayData', 'PendingActivityLogController@displayData')->name('pending_activity_log.displaydata');
        });

        Route::group(['prefix'=>'ppt', 'namespace'=>'PPT', 'as'=>'ppt.'], function(){
            /*depot_stock*/
            Route::resource('depot_stock', 'DepotStockController')->only('index'); 
            Route::post('depot_stock/getpdfreport', 'DepotStockController@getPdfReport')->name('depot_stock.getpdfreport');
            Route::get('depot_stock/getexcelreport', 'DepotStockController@getExcelReport')->name('depot_stock.getexcelreport');
            Route::get('depot_stock/displayData', 'DepotStockController@displayData')->name('depot_stock.displaydata');

            /*crew_stock*/
            Route::resource('crew_stock', 'CrewStockController')->only('index'); 
            Route::post('crew_stock/getpdfreport', 'CrewStockController@getPdfReport')->name('crew_stock.getpdfreport');
            Route::get('crew_stock/getexcelreport', 'CrewStockController@getExcelReport')->name('crew_stock.getexcelreport');
            Route::get('crew_stock/displayData', 'CrewStockController@displayData')->name('crew_stock.displaydata');

            /*receipt_from_main_office*/
            Route::resource('receipt_from_main_office', 'ReceiptFromMainOfficeController')->only('index'); 
            Route::post('receipt_from_main_office/getpdfreport', 'ReceiptFromMainOfficeController@getPdfReport')->name('receipt_from_main_office.getpdfreport');
            Route::get('receipt_from_main_office/getexcelreport', 'ReceiptFromMainOfficeController@getExcelReport')->name('receipt_from_main_office.getexcelreport');
            Route::get('receipt_from_main_office/displayData', 'ReceiptFromMainOfficeController@displayData')->name('receipt_from_main_office.displaydata');

            /*issues_to_ticket_section*/
            Route::resource('issues_to_ticket_section', 'IssuesToTicketSectionController')->only('index'); 
            Route::post('issues_to_ticket_section/getpdfreport', 'IssuesToTicketSectionController@getPdfReport')->name('issues_to_ticket_section.getpdfreport');
            Route::get('issues_to_ticket_section/getexcelreport', 'IssuesToTicketSectionController@getExcelReport')->name('issues_to_ticket_section.getexcelreport');
            Route::get('issues_to_ticket_section/displayData', 'IssuesToTicketSectionController@displayData')->name('issues_to_ticket_section.displaydata');

            /*issues_to_crew*/
            Route::resource('issues_to_crew', 'IssuesToTicketCrewController')->only('index'); 
            Route::post('issues_to_crew/getpdfreport', 'IssuesToTicketCrewController@getPdfReport')->name('issues_to_crew.getpdfreport');
            Route::get('issues_to_crew/getexcelreport', 'IssuesToTicketCrewController@getExcelReport')->name('issues_to_crew.getexcelreport');
            Route::get('issues_to_crew/displayData', 'IssuesToTicketCrewController@displayData')->name('issues_to_crew.displaydata');

            /*consumption*/
            Route::resource('consumption', 'ConsumptionController')->only('index'); 
            Route::post('consumption/getpdfreport', 'ConsumptionController@getPdfReport')->name('consumption.getpdfreport');
            Route::get('consumption/getexcelreport', 'ConsumptionController@getExcelReport')->name('consumption.getexcelreport');
            Route::get('consumption/displayData', 'ConsumptionController@displayData')->name('consumption.displaydata');

            /*returned_by_conductor*/
            Route::resource('returned_by_conductor', 'ReturnedByConductorController')->only('index'); 
            Route::post('returned_by_conductor/getpdfreport', 'ReturnedByConductorController@getPdfReport')->name('returned_by_conductor.getpdfreport');
            Route::get('returned_by_conductor/getexcelreport', 'ReturnedByConductorController@getExcelReport')->name('returned_by_conductor.getexcelreport');
            Route::get('returned_by_conductor/displayData', 'ReturnedByConductorController@displayData')->name('returned_by_conductor.displaydata');

            /*denomination_wise_stock_ledger*/
            Route::resource('denomination_wise_stock_ledger', 'DenominationWiseStockLedgerController')->only('index'); 
            Route::post('denomination_wise_stock_ledger/getpdfreport', 'DenominationWiseStockLedgerController@getPdfReport')->name('denomination_wise_stock_ledger.getpdfreport');
            Route::get('denomination_wise_stock_ledger/getexcelreport', 'DenominationWiseStockLedgerController@getExcelReport')->name('denomination_wise_stock_ledger.getexcelreport');
            Route::get('denomination_wise_stock_ledger/displayData', 'DenominationWiseStockLedgerController@displayData')->name('denomination_wise_stock_ledger.displaydata');

        });

        Route::group(['prefix'=>'revenue', 'namespace'=>'Revenue', 'as'=>'revenue.'], function(){
      
            /*depot_wise_collection*/
            Route::resource('depot_wise_collection', 'DepotWiseCollectionController')->only('index'); 
            Route::post('depot_wise_collection/getpdfreport', 'DepotWiseCollectionController@getPdfReport')->name('depot_wise_collection.getpdfreport');
            Route::get('depot_wise_collection/getexcelreport', 'DepotWiseCollectionController@getExcelReport')->name('depot_wise_collection.getexcelreport');
            Route::get('depot_wise_collection/displayData', 'DepotWiseCollectionController@displayData')->name('depot_wise_collection.displaydata');

            /*route_wise_collection*/
            Route::resource('route_wise_collection', 'RouteWiseCollectionController')->only('index'); 
            Route::post('route_wise_collection/getpdfreport', 'RouteWiseCollectionController@getPdfReport')->name('route_wise_collection.getpdfreport');
            Route::get('route_wise_collection/getexcelreport', 'RouteWiseCollectionController@getExcelReport')->name('route_wise_collection.getexcelreport');
            Route::get('route_wise_collection/displayData', 'RouteWiseCollectionController@displayData')->name('route_wise_collection.displaydata');

        });
    });

       
        
        
        
//    Route::namespace('Admin')
//    ->prefix('admin')
//    ->group(function () {
//        Route::resource('users', 'UsersController');
//    });
    
    
});
