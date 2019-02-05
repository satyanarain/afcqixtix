<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RouteDetail extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route_details';
    protected $guarded = ['is_this_by'];
      
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function stop()
    {
        return $this->belongsTo('App\Models\Stop');
    }
    
}
