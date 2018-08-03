<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ServiceLog extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_logs';
    protected $guarded = [];
    
    
    
//        public function bustypes()
//    {
//       
//        return $this->belongsTo('App\Models\BusType', 'bus_type_id');
//    }
//    public function bustypes(){
//         return $this->belongsTo('BusYype');
//    }
    public function bustypes()
    {
        return $this->belongsTo('App\Models\BusType');
    }
    
    
//     public function busTypes()
//    {
//        return $this->hasOne('App\Models\BusType')->orderBy('id','desc');
//    }
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
