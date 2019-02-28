<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RoasterOffDuty extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roaster_off_duty';
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
    public function crew()
    {
        return $this->belongsTo(Crew::class, 'crew_id', 'id');
    }
    
}
