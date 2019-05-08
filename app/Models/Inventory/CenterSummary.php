<?php

namespace App\Models\Inventory;

use App\Models\Denomination;
use App\Models\Inventory\Item;
use Illuminate\Database\Eloquent\Model;

class CenterSummary extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inv_itemsquantity_stock';
    protected $guarded = [];
    public $timestamps = false;
  
    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id', 'id');
    }

    public function denomination()
    {
        return $this->belongsTo(Denomination::class, 'denom_id', 'id');
    }
}
