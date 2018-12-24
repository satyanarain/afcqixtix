<?php

namespace App\Models\Inventory;

use App\Models\User;
use App\Models\Depot;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Model;

class DepotStock extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inv_depot_stock';
    protected $guarded = [];
    
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
    	return $this->belongsTo(Item::class, 'items_id', 'id');
    }

    public function denomination()
    {
    	return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }
}
