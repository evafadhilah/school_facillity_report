<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // cek berdasarkan email
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Siswa
        User::firstOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'name' => 'Siswa',
                'role' => 'siswa',
                'password' => Hash::make('siswa123'),
            ]
        );

        // Guru
        User::firstOrCreate(
            ['email' => 'guru@gmail.com'],
            [
                'name' => 'Guru',
                'role' => 'guru',
                'password' => Hash::make('guru123'),
            ]
        );

        // Teknisi
        User::firstOrCreate(
            ['email' => 'teknisi@gmail.com'],
            [
                'name' => 'Teknisi',
                'role' => 'teknisi',
                'password' => Hash::make('teknisi123'),
            ]
        );
    }
}
