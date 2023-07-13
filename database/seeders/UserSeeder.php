<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'wiharto@staff.uns.ac.id',
            'username' => 'wiharto123',
            'name' => 'Prof. Wiharto',
            'password' => Hash::make('wiharto_123')
        ]);
        DB::table('users')->insert([
            'email' => 'tetra@staff.uns.ac.id',
            'username' => 'tetra123',
            'name' => 'Tetra Handayani',
            'password' => Hash::make('tetra_123')
        ]);
        DB::table('users')->insert([
            'email' => 'user1@staff.uns.ac.id',
            'username' => 'user1',
            'name' => 'User 1',
            'password' => Hash::make('user_123')
        ]);
        DB::table('users')->insert([
            'email' => 'user2@staff.uns.ac.id',
            'username' => 'user2',
            'name' => 'User 2',
            'password' => Hash::make('user_123')
        ]);
        DB::table('users')->insert([
            'email' => 'user3@staff.uns.ac.id',
            'username' => 'user3',
            'name' => 'User 3',
            'password' => Hash::make('user_123')
        ]);
        DB::table('users')->insert([
            'email' => 'user4@staff.uns.ac.id',
            'username' => 'user4',
            'name' => 'User 4',
            'password' => Hash::make('user_123')
        ]);
        DB::table('users')->insert([
            'email' => 'user5@staff.uns.ac.id',
            'username' => 'user5',
            'name' => 'User 5',
            'password' => Hash::make('user_123')
        ]);
    }
}
