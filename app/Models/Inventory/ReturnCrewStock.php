<?php

namespace App\Models\Inventory;

use App\Models\Crew;
use App\Models\User;
use App\Models\Depot;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Model;

class ReturnCrewStock extends Model
{
    protected $table = 'inv_returncrew_stock';

    protected $fillable = ['items_id', 'depot_id', 'crew_id', 'denom_id', 'series', 'start_sequence', 'end_sequence', 'remark', 'quantity', 'returned_to', 'challan_no'];

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

    public function returnedTo()
    {
    	return $this->belongsTo(User::class, 'returned_to', 'id');
    }
}
