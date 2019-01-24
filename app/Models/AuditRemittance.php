<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditRemittance extends Model
{
    protected $table = 'audit_remittance';

    public function collector()
    {
    	return $this->belongsTo(User::class, 'collected_by', 'id');
    }

    public function waybill()
    {
    	return $this->belongsTo(Waybill::class, 'abstract_no', 'abstract_no');
    }
}
