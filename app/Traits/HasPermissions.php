<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Arr;

trait HasPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }

    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function giveRole($role)
    {
        $r =  Role::where('name', $role)->first();
        $this->roles()->sync($r);
        return $this;
    }

    public function revokeRole()
    {
        $this->roles()->detach();
        return $this;
    }

    public function hasPermission($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function getPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    public function givePermission(...$permission)
    {
        $permissions = $this->getPermissions(Arr::flatten($permission));
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function removePermission(...$permission)
    {
        $permissions = $this->getPermissions(Arr::flatten($permission));
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function revokePermission()
    {
        $this->permissions()->detach();
        return $this;
    }

    public function modifyPermission(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermission($permissions);
    }
}
