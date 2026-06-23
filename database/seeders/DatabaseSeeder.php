<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SIAKAD',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);
    }
}