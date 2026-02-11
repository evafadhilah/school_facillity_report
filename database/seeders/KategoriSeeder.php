<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            'Elektronik',
            'Furniture',
            'Alat Tulis',
            'Alat Olahraga',
            'Alat Praktik',
            'Kendaraan',
            'Peralatan Kebersihan',
            'Audio Visual',
        ];

        foreach ($kategori as $nama) {
            Kategori::create([
                'nama_kategori' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
