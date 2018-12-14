<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
    						'local_id', 
    						'inspector_id', 
    						'route_id', 
    						'direction', 
    						'penalty_amount', 
    						'name_of_passenger', 
    						'stop_id', 
    						'inspection_timestamp', 
    						'conductor_id', 
    						'remark_id'
    					];
}
