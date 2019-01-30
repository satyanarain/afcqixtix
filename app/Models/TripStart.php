<?php

namespace App\Models;

use App\Models\Stop;
use Illuminate\Database\Eloquent\Model;

class TripStart extends Model
{
    protected $table = 'trip_start';

    protected $fillable = ['service_id', 'route_id', 'route_master_id', 'direction', 'start_stop_id', 'end_stop_id', 'start_timestamp', 'bus_type', 'abstract_no', 'trip_id'];

    public function fromStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'start_stop_id');
    }

    public function toStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'end_stop_id');
    }

    public function route()
    {
        return $this->hasOne(Route::class, 'id', 'route_id');
    }
}
