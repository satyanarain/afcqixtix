<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ETMLoginLog extends Model
{
    protected $table = 'etm_login_log';

    public $timestamps = false;

    public function conductor()
    {
    	return $this->belongsTo(Crew::class, 'conductor_id', 'id');
    }

    public function etm()
    {
    	return $this->belongsTo(ETMDetail::class, 'etm_id', 'id');
    }
}
