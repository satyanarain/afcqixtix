<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ETMMidLogoffLog extends Model
{
    protected $table = 'etm_midlogoff_log';

    protected $fillable = ['abstract_no', 'start_timestamp', 'end_timestamp'];
}
