<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TripDetail extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trip_details';
    protected $guarded = ['trip_id','trip_no', 'start_time', 'path_route_id', 'deviated_route', 'deviated_path'];
      public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
      public function stop()
    {
        return $this->belongsTo('App\Models\Stop');
    }

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
    
}
