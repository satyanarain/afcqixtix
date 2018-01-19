<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Target extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'targets';
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
