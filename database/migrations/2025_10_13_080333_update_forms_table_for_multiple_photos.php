<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            // Ubah semua kolom foto dari string ke json
            $table->json('foto_serahterima')->nullable()->change();
            $table->json('foto_patroli')->nullable()->change();
            $table->json('foto_lembur')->nullable()->change();
            $table->json('foto_tamu')->nullable()->change();
            $table->json('foto_panduan')->nullable()->change();
            $table->json('foto_force')->nullable()->change();
            $table->json('foto_penertiban')->nullable()->change();
            $table->json('foto_simulasi')->nullable()->change();
            $table->json('foto_penyegaran')->nullable()->change();
            $table->json('foto_telepon')->nullable()->change();
            $table->json('foto_rutin')->nullable()->change();
            $table->json('foto_pengecekan')->nullable()->change();
            $table->json('foto_cctv')->nullable()->change();
            
            // Ubah nama dari string ke json
            $table->json('nama')->change();
        });
    }

    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            // Kembalikan ke string
            $table->string('foto_serahterima')->nullable()->change();
            $table->string('foto_patroli')->nullable()->change();
            $table->string('foto_lembur')->nullable()->change();
            $table->string('foto_tamu')->nullable()->change();
            $table->string('foto_panduan')->nullable()->change();
            $table->string('foto_force')->nullable()->change();
            $table->string('foto_penertiban')->nullable()->change();
            $table->string('foto_simulasi')->nullable()->change();
            $table->string('foto_penyegaran')->nullable()->change();
            $table->string('foto_telepon')->nullable()->change();
            $table->string('foto_rutin')->nullable()->change();
            $table->string('foto_pengecekan')->nullable()->change();
            $table->string('foto_cctv')->nullable()->change();
            
            $table->string('nama')->change();
        });
    }
};