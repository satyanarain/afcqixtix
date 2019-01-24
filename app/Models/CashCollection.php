<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashCollection extends Model
{
    protected $table = 'cash_collection';

    public function collector()
    {
    	return $this->belongsTo(User::class, 'collected_by', 'id');
    }

    public function waybill()
    {
    	return $this->belongsTo(Waybill::class, 'abstract_no', 'abstract_no');
    }
}
