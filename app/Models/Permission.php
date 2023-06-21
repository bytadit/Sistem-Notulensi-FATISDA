<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    protected $table = 'permissions';
    public $guarded = ['id'];

//    public function users(): BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'permission_user', 'permission_id', 'user_id')
//            ->withPivot(['team_id', 'user_type'])
//            ->using(PermissionUser::class);
//    }
//    public function roles(): BelongsToMany
//    {
//        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
//    }

}
