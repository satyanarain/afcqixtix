<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Roaster extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roasters';
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
    public function onDuty() {
        return $this->hasMany(RoasterOnDuty::class,'roaster_id');
    }
//    public function offDuty() {
//        return $this->hasMany(RoasterOffDuty::class,'roaster_id');
//    }
    public function depot()
    {
        return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
