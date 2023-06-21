<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table = 'role_user';
    protected $guarded = ['id'];
    public function teams(): BelongsToMany
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
