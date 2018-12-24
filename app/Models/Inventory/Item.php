<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inv_items_master';
    protected $guarded = [];
    
}