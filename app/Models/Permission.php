<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\Permission as PermissionModel;
use Cviebrock\EloquentSluggable\Sluggable;


class Permission extends PermissionModel
{
    use HasFactory, Sluggable;
    protected $table = 'permissions';
    public $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'name' => [
                'source' => 'display_name'
            ]
        ];
    }

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
