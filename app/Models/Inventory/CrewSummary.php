<?php

namespace App\Models\Inventory;

use App\Models\Crew;
use App\Models\Depot;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Model;

class CrewSummary extends Model
{
    protected $table = 'inv_crew_total_stock';

    protected $guarded = [];

    /*public function depot()
    {
    	return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }*/

    public function conductor()
    {
    	return $this->belongsTo(Crew::class, 'crew_id', 'id');
    }

    public function denomination()
    {
    	return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }
}
