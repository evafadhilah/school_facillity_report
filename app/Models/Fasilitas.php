<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    // Jika nama tabel bukan 'fasilitas', uncomment baris ini
    // protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'kategori_id',
        'lokasi_id',
        'kode_fasilitas',
        'kondisi',
    ];

    // 🔗 Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // 🔗 Relasi ke Laporan
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function lokasi()
{
    return $this->belongsTo(Lokasi::class);
}
}
