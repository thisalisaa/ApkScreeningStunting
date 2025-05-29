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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_telepon');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->enum('pendidikan_ayah', ['Tidak Sekolah','SD', 'SMP', 'SMA', 'Perguruan Tinggi']);
            $table->enum('pendidikan_ibu', ['Tidak Sekolah','SD', 'SMP', 'SMA', 'Perguruan Tinggi']);
            $table->integer('tinggi_badan_ayah')->nullable();
            $table->integer('tinggi_badan_ibu')->nullable();
            $table->string('pendapatan_keluarga', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tuas');
    }
};
