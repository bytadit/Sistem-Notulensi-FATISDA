<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            'nama' => 'FATISDA',
            'kode' => '01',
            'is_aktif' => true
        ]);
        DB::table('units')->insert([
            'nama' => 'Prodi Informatika',
            'kode' => '011',
            'is_aktif' => true
        ]);
    }
}
