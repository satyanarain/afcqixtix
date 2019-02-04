<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
  	protected $table = 'denominations';
  	protected $guarded = [];
    
    public function denominationMaster()
    {
    	return $this->belongsTo(DenominationMaster::class, 'denomination_master_id', 'id');
    }
}
