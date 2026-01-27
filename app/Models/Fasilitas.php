<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_fasilitas',
        'kategori_id',
        'lokasi',
        'kode_fasilitas',
        'kondisi',
    ];

    // 🔗 Relasi
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}
