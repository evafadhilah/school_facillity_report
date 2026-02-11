<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
    ];

    // Relasi ke Laporan
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}
