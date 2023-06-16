<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public function jabatanPegawai()
    // {
    //     return $this->hasMany(JabatanPegawai::class, 'id_unit');
    // }

    // public function jabatanPegawai()
    // {
    //     return $this->hasMany(JabatanPegawai::class, 'id_team');
    // }
    // public function rapat()
    // {
    //     return $this->hasMany(Rapat::class, 'id_unit');
    // }

    public function team(): MorphOne
    {
        return $this->morphOne(Team::class, 'teamable');
    }

}
