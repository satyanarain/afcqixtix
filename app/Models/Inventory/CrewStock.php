<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class CrewStock extends Model
{
    protected $table = 'inv_crew_stock';

    protected $fillable = ['items_id', 'depot_id', 'crew_id', 'denom_id', 'series', 'start_sequence', 'end_sequence', 'remark', 'quantity'];
}
