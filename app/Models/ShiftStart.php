<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftStart extends Model
{
    protected $table = 'shift_start';

    protected $fillable = ['conductor_id', 'vehicle_id', 'route_id', 'shift_id', 'driver_id', 'duty_id', 'odo_reading', 'start_timestamp', 'abstract_no'];
}
