<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripStart extends Model
{
    protected $table = 'trip_start';

    protected $fillable = ['service_id', 'route_id', 'direction', 'start_stop_id', 'end_stop_id', 'start_timestamp'];
}
