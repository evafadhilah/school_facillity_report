<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('laporans', function (Blueprint $table) {
            $table->id();

            // pelapor
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // data laporan
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete(); // tambah
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasis')->cascadeOnDelete(); // tambah

            // teknisi (opsional)
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->nullOnDelete();

            // isi laporan
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('tingkat_urgency', ['rendah', 'sedang', 'tinggi']);

            // status laporan
            $table->enum('status', ['pending', 'ditugaskan', 'diproses', 'selesai'])->default('pending');

            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
