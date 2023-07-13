<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_user');
    }

    // public function teams()
    // {
    //     return $this->belongsToMany(Team::class, 'role_user')
    //                 ->using(RoleUser::class)
    //                 // ->withPivot('app_id', 'user_type', 'team_id')
    //                 ->withPivot('app_id', 'user_type')
    //                 ->withTimestamps();
    // }

//    public function roles(): BelongsToMany
//    {
//        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
//            ->withPivot(['team_id', 'user_type'])
//            ->using(RoleUser::class);
//    }
//    public function permissions(): BelongsToMany
//    {
//        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id')
//            ->withPivot(['team_id', 'user_type'])
//            ->using(PermissionUser::class);
//    }

//    public function teams(): MorphToMany
//    {
//        return $this->morphToMany(Team::class, 'role_user');
//    }
}
