<?php

namespace App\Models\Inventory;

use App\Models\Crew;
use App\Models\User;
use App\Models\Depot;
use App\Models\Denomination;
use App\Models\Inventory\Item;
use Illuminate\Database\Eloquent\Model;

class DepotStockLedger extends Model
{
    protected $table = 'inv_depotstock_ledger';

    protected $fillable = ['depot_head_id', 'crew_id', 'depot_id', 'transaction_date', 'item_id', 'denom_id', 'series', 'start_sequence', 'end_sequence', 'item_quantity', 'challan_no', 'balance_quantity', 'transaction_type'];

    public function depot()
    {
    	return $this->belongsTo(Depot::class, 'depot_id', 'id');
    }

    public function depotHead()
    {
    	return $this->belongsTo(User::class, 'center_head_id', 'id');
    }

    public function item()
    {
    	return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function denomination()
    {
    	return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }
}
