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

    public function routeNotMaster()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
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

    public function depotHead()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cashCollection()
    {
        return $this->hasOne(CashCollection::class, 'abstract_no', 'abstract_no');
    }

    public function auditRemittance()
    {
        return $this->hasOne(AuditRemittance::class, 'waybill_number', 'abstract_no');
    }

    public function auditInventory()
    {
        return $this->hasMany(AuditInventory::class, 'waybill_number', 'abstract_no');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'abstract_id', 'abstract_no');
    }

    public function trips()
    {
        return $this->hasMany(TripStart::class, 'abstract_no', 'abstract_no');
    }

    public function shifts()
    {
        return $this->hasMany(ShiftStart::class, 'abstract_no', 'abstract_no');
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class, 'abstract_no', 'abstract_no');
    }
}
