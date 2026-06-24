<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
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

        $mahasiswa = Mahasiswa::create([
            'npm' => '2024001',
            'nama' => 'M Naufal',
        ]);

        User::create([
            'name' => $mahasiswa->nama,
            'email' => 'mahasiswa@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
            'npm' => $mahasiswa->npm,
        ]);
    }
}