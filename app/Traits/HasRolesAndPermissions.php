<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolesAndPermissions
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function allPermissions(): Collection
    {
        $userPermissions = $this->permissions()->get();

        $rolesPermissions = $this->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id');

        return $userPermissions->merge($rolesPermissions);
    }

    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function hasPermissionTo(... $permissions)
    {
        foreach ($permissions as $permission){
            if($this->allPermissions()->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }

}
