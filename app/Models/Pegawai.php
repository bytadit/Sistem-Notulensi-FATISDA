<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pegawai';
    // public function jabatan()
    // {
    //     return $this->belongsToMany(Jabatan::class, 'id_jabatan')
    //                 ->withPivot('id_user', 'nip', 'alamat', 'no_wa', 'path_photo');

    // }
    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawai::class, 'id_pegawai');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    // public function presensi()
    // {
    //     return $this->hasMany(Presensi::class, 'id_pegawai');
    // }

    public function rapat(): BelongsToMany
    {
        return $this->belongsToMany(Rapat::class, 'presensi', 'id_pegawai', 'id_rapat')
                    ->withPivot(['jabatan_peserta', 'status_konfirmasi', 'detail_konfirmasi', 'status_kehadiran', 'detail_kehadiran'])
                    ->using(Presensi::class)
                    ->withTimestamps();
    }
}
