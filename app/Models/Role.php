<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    public $guarded = ['id'];
//    public function users(): BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')
//            ->withPivot(['team_id', 'user_type'])
//            ->using(RoleUser::class);
//    }
//    public function permissions(): BelongsToMany
//    {
//        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
//    }
}
