<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laratrust\Models\Team as LaratrustTeam;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Team extends LaratrustTeam
{
    protected $guarded = ['id'];

    use HasFactory;

    public function teamable(): MorphTo
    {
        return $this->morphTo();
    }
    public function rapat()
    {
        return $this->hasMany(Rapat::class, 'id_team');
    }
    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawai::class, 'id_team');
    }

}
