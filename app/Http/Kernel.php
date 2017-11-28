<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
         //   \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\LogLastUserActivity::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        'client.create' => [ \App\Http\Middleware\Client\CanClientCreate::class ],
        'client.update' => [ \App\Http\Middleware\Client\CanClientUpdate::class ],
        'company.create' => [ \App\Http\Middleware\Company\CanCompanyCreate::class ],
        'company.update' => [ \App\Http\Middleware\Company\CanCompanyUpdate::class ],
        
        
        'trademark.create' => [ \App\Http\Middleware\Trademark\CanTrademarkCreate::class ],
        'trademark.update' => [ \App\Http\Middleware\Trademark\CanTrademarkUpdate::class ],
        
        'globalsearch.create' => [ \App\Http\Middleware\Globalsearch\CanGlobalsearchCreate::class ],
        'globalsearch.update' => [ \App\Http\Middleware\Globalsearch\CanGlobalsearchUpdate::class ],
        
        
        'companydocument.create' => [ \App\Http\Middleware\Companydocument\CanCompanydocumentCreate::class ],
        'companydocument.update' => [ \App\Http\Middleware\Companydocument\CanCompanydocumentUpdate::class ],
        'geographicalindication.create' => [ \App\Http\Middleware\Geographicalindication\CanGeographicalindicationCreate::class ],
        'geographicalindication.update' => [ \App\Http\Middleware\Geographicalindication\CanGeographicalindicationUpdate::class ],
        
        'client.create' => [ \App\Http\Middleware\Client\CanClientCreate::class ],
        'client.update' => [ \App\Http\Middleware\Client\CanClientUpdate::class ],
        'clientdocument.create' => [ \App\Http\Middleware\Clientdocument\CanClientdocumentCreate::class ],
        'clientdocument.update' => [ \App\Http\Middleware\Clientdocument\CanClientdocumentUpdate::class ],

        'domainname.create' => [ \App\Http\Middleware\Domainname\CanDomainnameCreate::class ],
        'domainname.update' => [ \App\Http\Middleware\Domainname\CanDomainnameUpdate::class ],    
        
        'copyright.create' => [ \App\Http\Middleware\Copyright\CanCopyrightCreate::class ],
        'copyright.update' => [ \App\Http\Middleware\Copyright\CanCopyrightUpdate::class ],
        'customrecordal.create' => [ \App\Http\Middleware\Customrecordal\CanCustomrecordalCreate::class ],
        'customrecordal.update' => [ \App\Http\Middleware\Customrecordal\CanCustomrecordalUpdate::class ],
        
        
        'user.create' => [ \App\Http\Middleware\User\CanUserCreate::class ],
        'user.update' => [ \App\Http\Middleware\User\CanUserUpdate::class ],
        'user.addtravel' => [ \App\Http\Middleware\User\CanAddTravelProfile::class ],
        'user.editbankdetail' => [ \App\Http\Middleware\User\CanEditBankDetail::class ],
        'user.changeprofileimage' => [ \App\Http\Middleware\User\CanChangeProfileImage::class ],
        'associate.create' => [ \App\Http\Middleware\Associate\CanCreateAssociate::class ],
        'associate.update' => [ \App\Http\Middleware\Associate\CanUpdateAssociate::class ],
        'event.create' => [ \App\Http\Middleware\Calendar\CanCreateEvent::class ],
        'event.edit' => [ \App\Http\Middleware\Calendar\CanEditEvent::class ],
        'task.create' => [ \App\Http\Middleware\Task\CanTaskCreate::class ],
        'task.update.status' => [ \App\Http\Middleware\Task\CanTaskUpdateStatus::class ],
        'task.assigned' => [ \App\Http\Middleware\Task\IsTaskAssigned::class ],
        'lead.create' => [ \App\Http\Middleware\Lead\CanLeadCreate::class ],
        'lead.assigned' => [ \App\Http\Middleware\Lead\IsLeadAssigned::class ],
        'lead.update.status' => [ \App\Http\Middleware\Lead\CanLeadUpdateStatus::class ],
        'user.is.admin' => [ \App\Http\Middleware\RedirectIfNotAdmin::class ],
        'user.is.accountant' => [ \App\Http\Middleware\RedirectIfNotAccountant::class ],
        'costcenter.create' => [ \App\Http\Middleware\CostCenter\CanCostCenterCreate::class ],
        'eventbudgeting.create' => [ \App\Http\Middleware\Eventbudgeting\CanCreateEventbudgeting::class ],
        'eventbudgeting.update' => [ \App\Http\Middleware\Eventbudgeting\CanUpdateEventbudgeting::class ],

        
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
         'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
    'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
    'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
    ];
}
   