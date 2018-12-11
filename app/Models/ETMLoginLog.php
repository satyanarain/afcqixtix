<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ETMLoginLog extends Model
{
    protected $table = 'etm_login_log';

    public $timestamps = false;

    public function conductor()
    {
    	return $this->hasOne(Crew::class, 'id', 'conductor_id');
    }
}
