<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Import relasi
use App\Models\Laporan;
use App\Models\RiwayatLaporan;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ================= RELASI =================

    // laporan yg dibuat user
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    // laporan yg ditangani teknisi
    public function tugasTeknisi()
    {
        return $this->hasMany(Laporan::class, 'teknisi_id');
    }

    // riwayat teknisi
    public function riwayatTeknisi()
    {
        return $this->hasMany(RiwayatLaporan::class, 'teknisi_id');
    }
}
