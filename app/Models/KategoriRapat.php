<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRapat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kategori_rapat';
}
