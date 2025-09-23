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
        Schema::create('laporan_keamanan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu');
            $table->string('area', 100);
            $table->string('nama', 100);
            $table->text('ketentuan_seragam')->nullable();
            $table->string('foto_serahterima')->nullable();
            $table->text('pengamanan')->nullable();
            $table->string('foto_patroli')->nullable();
            $table->text('kronologi_kriminal')->nullable();
            $table->text('fungsi_khusus')->nullable();
            $table->string('foto_lembur')->nullable();
            $table->text('kronologi_gangguan')->nullable();
            $table->text('memantau')->nullable();
            $table->string('foto_tamu')->nullable();
            $table->text('pelayanan')->nullable();
            $table->string('foto_panduan')->nullable();
            $table->text('fungsi_force')->nullable();
            $table->string('foto_force')->nullable();
            $table->text('penertiban')->nullable();
            $table->string('foto_penertiban')->nullable();
            $table->text('simulasi')->nullable();
            $table->string('foto_simulasi')->nullable();
            $table->text('penyegaran')->nullable();
            $table->string('foto_penyegaran')->nullable();
            $table->text('telepon')->nullable();
            $table->string('foto_telepon')->nullable();
            $table->text('rutin')->nullable();
            $table->text('titik')->nullable();
            $table->string('foto_rutin')->nullable();
            $table->text('pengecekan')->nullable();
            $table->string('foto_pengecekan')->nullable();
            $table->text('cctv')->nullable();
            $table->string('foto_cctv')->nullable();
            $table->text('kronologi_cctv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keamanan');
    }
};
