<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionUser extends Pivot
{
    protected $table = 'permission_user';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function team(): BelongsToMany
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
