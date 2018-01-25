<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Stop extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stops';
    protected $guarded = [];

    public function bustypes()
    {
        return $this->belongsTo('App\Models\BusType');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function route()
    {
        return $this->hasMany('App\Models\Route','stop_id');
    }
    // return $this->hasMany('Article', 'category_id'); return $this->hasMany('Article', 'category_id');
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
