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
