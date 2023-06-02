<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JabatanPegawai extends Pivot
{
    public function penanggungJawab()
    {
        return $this->hasMany(Rapat::class, 'id_penanggung_jawab');
    }
    public function notulis()
    {
        return $this->hasMany(Rapat::class, 'id_notulis');
    }
}
