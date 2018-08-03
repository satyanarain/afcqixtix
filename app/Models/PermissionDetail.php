<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionDetail extends Model
{
  protected $table = 'permission_details';
  protected $guarded = ['name', 'user_name', 'email', 'address', 'country', 'city', 'password', 'mobile', 'date_of_birth', 'image_path', 'set_password_token', 'remember_token', 'status'];
    
}
