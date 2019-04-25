<?php

namespace App\Models;

use App\Models\Crew;
use App\Models\Depot;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Model;

class AuditInventory extends Model
{
    protected $table = 'audit_inventory';

    public function depot()
    {
    	return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }

    public function conductor()
    {
    	return $this->belongsTo(Crew::class, 'crew_id', 'id');
    }

    public function denomination()
    {
    	return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'audited_by', 'id');
    }
}
