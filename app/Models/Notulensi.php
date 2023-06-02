<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'notulensi';
    public function rapat()
    {
        return $this->belongsTo(Rapat::class, 'id_rapat');
    }
}
