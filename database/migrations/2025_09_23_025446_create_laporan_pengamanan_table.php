<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_pengamanan', function (Blueprint $table) {
            $table->id();
            $table->string('waktu');
            $table->string('area');
            $table->json('nama'); // Changed to JSON
            
            // All photo fields as JSON (untuk multiple files)
            $table->json('foto_serahterima')->nullable();
            $table->json('foto_patroli')->nullable();
            $table->json('foto_lembur')->nullable();
            $table->json('foto_tamu')->nullable();
            $table->json('foto_panduan')->nullable();
            $table->json('foto_force')->nullable();
            $table->json('foto_penertiban')->nullable();
            $table->json('foto_simulasi')->nullable();
            $table->json('foto_penyegaran')->nullable();
            $table->json('foto_telepon')->nullable();
            $table->json('foto_rutin')->nullable();
            $table->json('foto_pengecekan')->nullable();
            $table->json('foto_cctv')->nullable();
            
            // Other fields
            $table->string('ketentuan_seragam')->nullable();
            $table->string('pengamanan')->nullable();
            $table->text('kronologi_kriminal')->nullable();
            $table->string('fungsi_khusus')->nullable();
            $table->text('kronologi_gangguan')->nullable();
            $table->string('memantau')->nullable();
            $table->string('pelayanan')->nullable();
            $table->string('fungsi_force')->nullable();
            $table->string('penertiban')->nullable();
            $table->string('simulasi')->nullable();
            $table->string('penyegaran')->nullable();
            $table->string('telepon')->nullable();
            $table->integer('titik')->nullable();
            $table->string('rutin')->nullable();
            $table->string('pengecekan')->nullable();
            $table->string('cctv')->nullable();
            $table->text('kronologi_cctv')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forms');
    }
};