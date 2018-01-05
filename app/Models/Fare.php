<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    protected $fillable = ['user_id', 'service_id', 'number_of_units', 'stage', 'adult_ticket_amount', 'child_ticket_amount', 'luggage_ticket_amount'];
}
