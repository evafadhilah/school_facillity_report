<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'teknisi_id',
        'deskripsi',
        'foto',
        'tingkat_urgency',
        'status',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    // 🔗 Relasi
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatLaporan::class);
    }
}
