<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
 protected $table = "permissions";
    protected $guarded = [];
     public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
    public function hasperm()
    {
        return $this->belongsToMany(PermissionRole::class, 'permission_role', 'role_id');
    }
}
