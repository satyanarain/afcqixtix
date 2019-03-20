<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $guarded = [];

    //accessor
    public function getSoldAtAttribute($value)
    {
        return date('H:i:s', strtotime($value));
    }

    public function fromStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'stage_from');
    }

    public function toStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'stage_to');
    }

    public function concession()
    {
        return $this->belongsTo(Concession::class, 'concession_id', 'id');
    }

    public function wayBill()
    {
        return $this->belongsTo(Waybill::class, 'abstract_id', 'abstract_no');
    }
}
