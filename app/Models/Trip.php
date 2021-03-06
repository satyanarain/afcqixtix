<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Trip extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trips';
    protected $guarded = [ 'trip_no', 'start_time', 'path_route_id', 'deviated_route', 'deviated_path'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function stop()
    {
        return $this->belongsTo('App\Models\Stop');
    }

    public function tripDetail()
    {
        return $this->hasOne(TripDetail::class, 'trip_id', 'id');   
    }   
}
