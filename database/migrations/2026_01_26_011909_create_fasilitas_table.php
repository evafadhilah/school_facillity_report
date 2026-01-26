<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
            $table->string('lokasi');
            $table->string('kode_fasilitas')->unique();
            $table->enum('kondisi',['baik', 'rusak_ringan', 'rusak_berat']);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
