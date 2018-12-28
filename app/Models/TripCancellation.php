<?php

namespace App\Models;

use App\Models\Stop;
use App\Models\Waybill;
use App\Models\TripCancellationReason;
use Illuminate\Database\Eloquent\Model;

class TripCancellation extends Model
{
    protected $table = 'trip_calcellation';

    protected $guarded = [];

    public function wayBill()
    {
    	return $this->belongsTo(Waybill::class, 'abstract_no', 'abstract_no');
    }

    public function stop()
    {
    	return $this->belongsTo(Stop::class, 'stop_id', 'id');
    }

    public function reason()
    {
    	return $this->belongsTo(TripCancellationReason::class, 'reason_id', 'id');
    }
}
