<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Waybill extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'waybills';
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
    public function bustypes()
    {
        return $this->belongsTo('App\Models\BusType');
    }
}
