<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
        
        $this->app->bind(
            \App\Repositories\Associate\AssociateRepositoryContract::class,
            \App\Repositories\Associate\AssociateRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Permission\PermissionRepositoryContract::class,
            \App\Repositories\Permission\PermissionRepository::class
        );
       
        $this->app->bind(
            \App\Repositories\Role\RoleRepositoryContract::class,
            \App\Repositories\Role\RoleRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\User\UserRepositoryContract::class,
            \App\Repositories\User\UserRepository::class
        );
        
          $this->app->bind(
            \App\Repositories\Department\DepartmentRepositoryContract::class,
            \App\Repositories\Department\DepartmentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Setting\SettingRepositoryContract::class,
            \App\Repositories\Setting\SettingRepository::class
        );
        $this->app->bind(
            \App\Repositories\Task\TaskRepositoryContract::class,
            \App\Repositories\Task\TaskRepository::class
        );
//        $this->app->bind(
//            \App\Repositories\Client\ClientRepositoryContract::class,
//            \App\Repositories\Client\ClientRepository::class
//        );
        
        
            $this->app->bind(
            \App\Repositories\Client\ClientRepositoryContract::class,
            \App\Repositories\Client\ClientRepository::class
        );
        /***************************************************************/
//        $this->app->bind(
//            \App\Repositories\Trademark\TrademarkRepositoryContract::class,
//            \App\Repositories\Trademark\TrademarkRepository::class
//        );
//        
//        
           $this->app->bind(
            \App\Repositories\Domainname\DomainnameRepositoryContract::class,
            \App\Repositories\Domainname\DomainnameRepository::class
        );
        
           $this->app->bind(
            \App\Repositories\Globalsearch\GlobalsearchRepositoryContract::class,
            \App\Repositories\Globalsearch\GlobalsearchRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Clientdocument\ClientdocumentRepositoryContract::class,
            \App\Repositories\Clientdocument\ClientdocumentRepository::class
        );
        
         $this->app->bind(
            \App\Repositories\Geographicalindication\GeographicalindicationRepositoryContract::class,
            \App\Repositories\Geographicalindication\GeographicalindicationRepository::class
        );
         
        
                  $this->app->bind(
            \App\Repositories\Domainname\DomainnameRepositoryContract::class,
            \App\Repositories\Domainname\DomainnameRepository::class
        );
            
        $this->app->bind(
            \App\Repositories\Copyright\CopyrightRepositoryContract::class,
            \App\Repositories\Copyright\CopyrightRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Customrecordal\CustomrecordalRepositoryContract::class,
            \App\Repositories\Customrecordal\CustomrecordalRepository::class
        );
        
        
        $this->app->bind(
            \App\Repositories\Company\CompanyRepositoryContract::class,
            \App\Repositories\Company\CompanyRepository::class
        );
        $this->app->bind(
            \App\Repositories\Trademark\TrademarkRepositoryContract::class,
            \App\Repositories\Trademark\TrademarkRepository::class
        );
        
        
          $this->app->bind(
            \App\Repositories\Companydocument\CompanydocumentRepositoryContract::class,
            \App\Repositories\Companydocument\CompanydocumentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Vendor\VendorRepositoryContract::class,
            \App\Repositories\Vendor\VendorRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Import\ImportTrademarkRepositoryContract::class,
            \App\Repositories\Import\ImportTrademarkRepository::class
        );
        $this->app->bind(
            \App\Repositories\Import\ImportClientRepositoryContract::class,
            \App\Repositories\Import\ImportClientRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Lead\LeadRepositoryContract::class,
            \App\Repositories\Lead\LeadRepository::class
        );
        $this->app->bind(
            \App\Repositories\Invoice\InvoiceRepositoryContract::class,
            \App\Repositories\Invoice\InvoiceRepository::class
        );
    }
}
