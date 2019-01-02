<?php

namespace App\Models;

use App\Models\Crew;
use App\Models\RouteMaster;
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

    public function inspector()
    {
        return $this->belongsTo(Crew::class, 'inspector_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(RouteMaster::class, 'route_id', 'id');
    }

    public function stop()
    {
        return $this->belongsTo(Stop::class, 'stop_id', 'id');
    }

    public function conductor()
    {
        return $this->belongsTo(Crew::class, 'conductor_id', 'id');
    }

    public function remark()
    {
        return $this->belongsTo(InspectorRemark::class, 'remark_id', 'id');
    }
}
