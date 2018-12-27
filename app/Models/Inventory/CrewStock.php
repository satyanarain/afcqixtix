<?php

namespace App\Models\Inventory;

use App\Models\Crew;
use App\Models\User;
use App\Models\Depot;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Model;

class CrewStock extends Model
{
    protected $table = 'inv_crew_stock';

    protected $fillable = ['issued_by', 'items_id', 'depot_id', 'crew_id', 'challan_no', 'denom_id', 'series', 'start_sequence', 'end_sequence', 'remark', 'quantity'];

    public function item()
    {
    	return $this->belongsTo(Item::class, 'items_id', 'id');
    }

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

    public function issuedBy()
    {
    	return $this->belongsTo(User::class, 'issued_by', 'id');
    }
}
