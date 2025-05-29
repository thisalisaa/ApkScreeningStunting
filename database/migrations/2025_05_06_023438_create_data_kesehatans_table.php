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
        Schema::create('data_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balita')->constrained('balitas')->onDelete('cascade');
            $table->enum('riwayat_penyakit', ['Ya', 'Tidak']);
            $table->text('keterangan_riwayat_penyakit')->nullable();
            $table->enum('alergi', ['Ya', 'Tidak']);
            $table->text('keterangan_alergi')->nullable();
            $table->enum('bebas_asap_rokok', ['Ya', 'Tidak']);
            $table->enum('sumber_air_bersih', ['Tersedia', 'Tidak Tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kesehatans');
    }
};
