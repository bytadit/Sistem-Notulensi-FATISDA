<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    protected $table = 'role_user';
    protected $guarded = ['id'];
    public $timestamps = false;
    public function teams(): BelongsToMany
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
