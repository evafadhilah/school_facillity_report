<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'role' => 'siswa',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'role' => 'guru',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Teknisi',
            'email' => 'teknisi@gmail.com',
            'role' => 'teknisi',
            'password' => Hash::make('password'),
        ]);
    }
}
