<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            'name' => '01',
            'display_name' => 'FATISDA',
            'description' => 'FATISDA',
            'teamable_id' => 1,
            'teamable_type' => 'App\Models\Unit'
        ]);
        DB::table('teams')->insert([
            'name' => '011',
            'display_name' => 'Prodi Informatika',
            'description' => 'Prodi Informatika',
            'teamable_id' => 2,
            'teamable_type' => 'App\Models\Unit'
        ]);
    }
}
