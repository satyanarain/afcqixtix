<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['local_id', 'abstract_no', 'cat_id', 'amount', 'date_timestamp'];
}
