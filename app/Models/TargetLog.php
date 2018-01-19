<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TargetLog extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'target_logs';
    protected $guarded = [];
 
    public function bustypes()
    {
        return $this->belongsTo('App\Models\BusType');
    }
    public function route()
    {
        return $this->belongsTo('App\Models\Route');
    }
    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
    

    
}
