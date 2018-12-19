<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Waybill extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'waybills';
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function bustypes()
    {
        return $this->belongsTo('App\Models\BusType');
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }

    public function etm()
    {
        return $this->belongsTo(ETMDetail::class, 'etm_no', 'id');
    }

    public function route()
    {
        return $this->belongsTo(RouteMaster::class, 'route_id', 'id');
    }

    public function duty()
    {
        return $this->belongsTo(Duty::class, 'duty_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function conductor()
    {
        return $this->belongsTo(Crew::class, 'conductor_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function etmLoginDetails()
    {
        return $this->hasOne(ETMLoginLog::class, 'abstract_no', 'abstract_no');
    }
}
