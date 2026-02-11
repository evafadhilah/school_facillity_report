<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [];

        // Struktur: Angkatan => [Jurusan => jumlah kelas]
        $struktur = [
            'X' => [      // ← UBAH JADI 'X'
                'TSM' => 1,
                'TKR' => 2,
                'RPL' => 2,
            ],
            'XI' => [     // ← UBAH JADI 'XI'
                'RPL' => 3,
                'TKR' => 2,
                'TSM' => 2,
            ],
            'XII' => [    // ← UBAH JADI 'XII'
                'TKR' => 1,
                'TSM' => 2,
                'RPL' => 3,
            ],
        ];

        foreach ($struktur as $tingkat => $jurusan_list) {
            foreach ($jurusan_list as $jurusan => $jumlah_kelas) {
                for ($i = 1; $i <= $jumlah_kelas; $i++) {
                    $kelas[] = [
                        'nama_kelas' => "{$tingkat} {$jurusan} {$i}",  // ← HAPUS "X" di depan
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        Kelas::insert($kelas);
    }
}
