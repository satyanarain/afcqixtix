<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RouteLog extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route_logs';
    protected $guarded = [];
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
