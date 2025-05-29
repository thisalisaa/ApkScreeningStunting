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
        Schema::create('rekapitulasis', function (Blueprint $table) {
           $table->id();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('total_balita')->default(0);
            $table->integer('jumlah_stunting')->default(0);
            $table->integer('jumlah_normal')->default(0);
            $table->integer('jumlah_beresiko')->default(0);
            $table->decimal('persentase_stunting', 5, 2)->default(0);
            $table->decimal('persentase_normal', 5, 2)->default(0);
            $table->decimal('persentase_beresiko', 5, 2)->default(0);
            $table->timestamp('tanggal_hitung');
            $table->timestamps();
            
            $table->unique(['bulan', 'tahun']);
            $table->index(['tahun', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasis');
    }
};
