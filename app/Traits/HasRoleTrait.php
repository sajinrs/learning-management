<?php
namespace App\Traits;


use App\Models\Roles;
use App\Models\RoleUser;

trait HasRoleTrait
{
    public function hasRole( ... $roles ) {

        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function roles() {

        return $this->belongsToMany(Roles::class,'role_user','users_id', 'roles_id');

    }
}
