<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
