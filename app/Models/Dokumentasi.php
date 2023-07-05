<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $table = 'dokumentasi';
    public function rapat()
    {
        return $this->belongsTo(Rapat::class, 'id_rapat');
    }
}
