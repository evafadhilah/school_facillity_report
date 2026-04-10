<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
<<<<<<< HEAD:database/migrations/2026_04_06_020111_add_catatan_foto_sesudah_to_laporans_table.php
            $table->text('catatan')->nullable()->after('status');
            $table->string('foto_sesudah')->nullable()->after('cover');
=======
            $table->string('foto_sesudah')->nullable()->after('foto_sebelum'); // letakkan setelah kolom tertentu
>>>>>>> 6e0aed19b26ac72de7ff5093593fc436dbdfb8f6:database/migrations/2026_04_08_093929_add_foto_sesudah_catatan_to_laporans_table.php
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
<<<<<<< HEAD:database/migrations/2026_04_06_020111_add_catatan_foto_sesudah_to_laporans_table.php
            $table->dropColumn(['catatan', 'foto_sesudah']);
=======
            $table->dropColumn('foto_sesudah');
>>>>>>> 6e0aed19b26ac72de7ff5093593fc436dbdfb8f6:database/migrations/2026_04_08_093929_add_foto_sesudah_catatan_to_laporans_table.php
        });
    }
};
