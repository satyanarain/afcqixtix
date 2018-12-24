<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class CenterStock extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inv_center_stock';
    protected $guarded = [];
    
    public function services()
    {  
        return $this->hasMany('App\Models\Service', 'center_stock_id');
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
