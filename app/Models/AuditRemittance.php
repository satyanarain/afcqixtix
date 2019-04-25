<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditRemittance extends Model
{
    protected $table = 'audit_remittance';

    public function auditor()
    {
    	return $this->belongsTo(User::class, 'audited_by', 'id');
    }

    public function waybill()
    {
    	return $this->belongsTo(Waybill::class, 'abstract_no', 'abstract_no');
    }
}
