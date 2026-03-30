<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        $fasilitas = [
            // ELEKTRONIK
            'Laptop',
            'Komputer',
            'Printer',
            'Scanner Absen',
            'Speaker',
            'Microphone',
            'AC (Air Conditioner)',
            'Kipas Angin',
            'Lampu LED',
            'CCTV',

            // FURNITURE
            'Meja Guru',
            'Meja Siswa',
            'Kursi Guru',
            'Kursi Siswa',
            'Lemari',
            'Rak Buku',
            'Whiteboard',
            'Loker Siswa',
            'Penghapus Whiteboard',
            'Spidol Boardmarker',
            'Penggaris Panjang',
            'Jam Dinding',

            // ALAT OLAHRAGA
            'Bola Basket',
            'Bola Voli',
            'Net Voli',
            'Ring Basket',
            
            // ALAT PRAKTIK (TSM)
            'Toolbox',
            'Tang',
            'Obeng Set',
            'Kunci Inggris',
            'Kunci Pas Set',
            'Mesin Las',
            'Gerinda',
            'Bor Listrik',
            'Ragum',
            'Palu',

            // PERALATAN KEBERSIHAN
            'Sapu',
            'Pel',
            'Tempat Sampah',

        ];

        foreach ($fasilitas as $nama) {
            Fasilitas::create([
                'nama_fasilitas' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
