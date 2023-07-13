<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'topik_rapat';
    public function rapat()
    {
        return $this->hasMany(Rapat::class, 'id_topik');
    }
}
