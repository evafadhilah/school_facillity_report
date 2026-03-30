<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $lokasi = [];
        $struktur_kelas = [
            10 => [
                'TSM' => 1,
                'TKR' => 2,
                'RPL' => 2,
            ],
            11 => [
                'TSM' => 2,
                'TKR' => 2,
                'RPL' => 3,
            ],
            12 => [
                'TSM' => 2,
                'TKR' => 1,
                'RPL' => 3,
            ],
        ];

        foreach ($struktur_kelas as $angkatan => $jurusan_list) {
            foreach ($jurusan_list as $jurusan => $jumlah_kelas) {
                for ($i = 1; $i <= $jumlah_kelas; $i++) {
                    $lokasi[] = [
                        'nama_lokasi' => "Kelas {$angkatan} {$jurusan} {$i}",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }


        $lab = [

            'Lab 1',
            'Lab 2',
            'Lab 3',
            'Lab Simdig',
        ];

        foreach ($lab as $nama_lab) {
            $lokasi[] = [
                'nama_lokasi' => $nama_lab,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        
        $bengkel = [
            'Bengkel TSM',
            'Bengkel TKR',
        ];

        foreach ($bengkel as $nama_bengkel) {
            $lokasi[] = [
                'nama_lokasi' => $nama_bengkel,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Lokasi::insert($lokasi);
    }
}
