<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanPegawai extends Model
{
    // public function penanggungJawab()
    // {
    //     return $this->hasMany(Rapat::class, 'id_penanggung_jawab');
    // }
    // public function notulis()
    // {
    //     return $this->hasMany(Rapat::class, 'id_notulis');
    // }
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jabatan_pegawai';
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
    // public function unit()
    // {
    //     return $this->belongsTo(Unit::class, 'id_unit');
    // }
    public function team()
    {
        return $this->belongsTo(Team::class, 'id_team');
    }
}
