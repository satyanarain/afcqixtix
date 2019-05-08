<?php

namespace App\Models\Inventory;

use App\Models\Depot;
use App\Models\Denomination;
use App\Models\Inventory\Item;
use Illuminate\Database\Eloquent\Model;

class DepotSummary extends Model
{
    protected $table = 'inv_centerstock_depotstock';

    protected $guarded = [];

    public function depot()
    {
    	return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }

    public function denomination()
    {
    	return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id', 'id');
    }
}
