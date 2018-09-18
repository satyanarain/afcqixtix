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
            \App\Repositories\Setting\SettingRepositoryContract::class,
            \App\Repositories\Setting\SettingRepository::class
        );
      
            $this->app->bind(
            \App\Repositories\Depot\DepotRepositoryContract::class,
            \App\Repositories\Depot\DepotRepository::class
        );
       $this->app->bind(
            \App\Repositories\Stop\StopRepositoryContract::class,
            \App\Repositories\Stop\StopRepository::class
        );
            $this->app->bind(
            \App\Repositories\BusType\BusTypeRepositoryContract::class,
            \App\Repositories\BusType\BusTypeRepository::class
        );
        $this->app->bind(
            \App\Repositories\Service\ServiceRepositoryContract::class,
            \App\Repositories\Service\ServiceRepository::class
        );
        $this->app->bind(
            \App\Repositories\Fare\FareRepositoryContract::class,
            \App\Repositories\Fare\FareRepository::class
        );
        $this->app->bind(
            \App\Repositories\Vehicle\VehicleRepositoryContract::class,
            \App\Repositories\Vehicle\VehicleRepository::class
        );
        $this->app->bind(
            \App\Repositories\Shift\ShiftRepositoryContract::class,
            \App\Repositories\Shift\ShiftRepository::class
        );
        
        
        $this->app->bind(
            \App\Repositories\Route\RouteRepositoryContract::class,
            \App\Repositories\Route\RouteRepository::class
        );
        $this->app->bind(
            \App\Repositories\Trip\TripRepositoryContract::class,
            \App\Repositories\Trip\TripRepository::class
        );
        $this->app->bind(
            \App\Repositories\Duty\DutyRepositoryContract::class,
            \App\Repositories\Duty\DutyRepository::class
        );
        $this->app->bind(
            \App\Repositories\Target\TargetRepositoryContract::class,
            \App\Repositories\Target\TargetRepository::class
        );
        $this->app->bind(
            \App\Repositories\Fare\FareRepositoryContract::class,
            \App\Repositories\Fare\FareRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\ConcessionFareSlab\ConcessionFareSlabRepositoryContract::class,
            \App\Repositories\ConcessionFareSlab\ConcessionFareSlabRepository::class
        );
        $this->app->bind(
            \App\Repositories\Concession\ConcessionRepositoryContract::class,
            \App\Repositories\Concession\ConcessionRepository::class
        );
        $this->app->bind(
            \App\Repositories\TripCancellationReason\TripCancellationReasonRepositoryContract::class,
            \App\Repositories\TripCancellationReason\TripCancellationReasonRepository::class
        );
        $this->app->bind(
            \App\Repositories\InspectorRemark\InspectorRemarkRepositoryContract::class,
            \App\Repositories\InspectorRemark\InspectorRemarkRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\PayoutReason\PayoutReasonRepositoryContract::class,
            \App\Repositories\PayoutReason\PayoutReasonRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Denomination\DenominationRepositoryContract::class,
            \App\Repositories\Denomination\DenominationRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\PassType\PassTypeRepositoryContract::class,
            \App\Repositories\PassType\PassTypeRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\Crew\CrewRepositoryContract::class,
            \App\Repositories\Crew\CrewRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\ETMDetail\ETMDetailRepositoryContract::class,
            \App\Repositories\ETMDetail\ETMDetailRepository::class
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
            \App\Repositories\Version\VersionRepositoryContract::class,
            \App\Repositories\Version\VersionRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\RouteMaster\RouteMasterRepositoryContract::class,
            \App\Repositories\RouteMaster\RouteMasterRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\CenterStock\CenterStockRepositoryContract::class,
            \App\Repositories\CenterStock\CenterStockRepository::class
        );
    }
}
    