<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Crew extends Model
{
  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crew';
    protected $guarded = ['confirm_password'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
}
