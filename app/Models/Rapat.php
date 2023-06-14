<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Rapat extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = ['id'];
    protected $table = 'rapat';
    protected $dates = ['waktu_mulai', 'waktu_selesai', 'created_at', 'updated_at'];
    // protected $casts = [ 'waktu_mulai' => 'datetime',
    //                      'waktu_selesai' => 'datetime',
    //                      'created_at' => 'datetime',
    //                      'updated_at' => 'datetime'
    //                     ];

    public function kategoriRapat()
    {
        return $this->belongsTo(KategoriRapat::class, 'id_kategori_rapat');
    }
    public function topikRapat()
    {
        return $this->belongsTo(Topik::class, 'id_topik');
    }
    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'id_rapat');
    }
    public function notulensi()
    {
        return $this->hasMany(Notulensi::class, 'id_rapat');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_rapat');
    }
    public function penanggungJawab()
    {
        return $this->belongsTo(JabatanPegawai::class, 'id_penanggung_jawab');
    }
    public function notulis()
    {
        return $this->belongsTo(JabatanPegawai::class, 'id_notulis');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_rapat'
            ]
        ];
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
}
