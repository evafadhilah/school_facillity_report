<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = ['nama_lokasi'];

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }
}
