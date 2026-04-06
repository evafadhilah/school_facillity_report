<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pelapor',
        'kelas_id',
        'kategori_id',
        'fasilitas_id',
        'lokasi_id',
        'teknisi_id',
        'deskripsi',
        'cover',        // ← ganti dari 'foto'
        'foto_sesudah',
        'catatan',
        'tingkat_urgency',
        'status',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    // Relasi ke foto laporan (banyak)
    public function fotoLaporan()
    {
        return $this->hasMany(FotoLaporan::class);
    }
}
