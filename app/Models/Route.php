<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Route extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'routes';
    protected $guarded = [];
      
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function stop()
    {
        return $this->belongsTo('App\Models\Stop');
    }
    
}
