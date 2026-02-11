<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'kelas_id',        // ← TAMBAH INI
        'teknisi_id',
        'deskripsi',
        'foto',
        'tingkat_urgency',
        'status',
        'tanggal_selesai',
    ];

    // Relasi ke User (Pelapor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke Teknisi
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
