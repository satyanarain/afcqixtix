<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ShiftLog extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shift_logs';
    protected $guarded = [];
      public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
      public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
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
