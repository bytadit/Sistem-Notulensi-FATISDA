<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class Presensi extends Pivot
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'presensi';
    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class, 'id_pegawai');
    // }
    // public function rapat()
    // {
    //     return $this->belongsTo(Rapat::class, 'id_rapat');
    // }
}
