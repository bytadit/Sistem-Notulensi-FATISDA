<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            'id_user' => 1,
            'nip' => '123455342334',
            'alamat' => 'Jl. Kemerdekaan No. 56, Surakarta',
            'no_wa' => '08966767676',
            'path_photo' => '/storage/photos/1'
        ]);
        DB::table('pegawai')->insert([
            'id_user' => 2,
            'nip' => '123455342334',
            'alamat' => 'Jl. Kemerdekaan No. 57, Surakarta',
            'no_wa' => '089667312313',
            'path_photo' => '/storage/photos/2'
        ]);
    }
}
