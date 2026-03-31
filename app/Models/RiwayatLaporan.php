<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatLaporan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_laporans';

    protected $fillable = [
        'laporan_id',
        'teknisi_id',
        'catatan',
        'status',
    ];

    // 🔗 Relasi
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
