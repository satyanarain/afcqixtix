<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $guarded = [];

    public function fromStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'stage_from');
    }

    public function toStop()
    {
    	return $this->hasOne(Stop::class, 'id', 'stage_to');
    }
}
