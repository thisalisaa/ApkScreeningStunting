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
        Schema::create('hasil_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_antropometri_id')->constrained()->onDelete('cascade'); 
            $table->enum('status_bb_u', ['sangat kurang', 'kurang', 'normal', 'berat lebih']);
            $table->enum('status_tb_u', ['sangat pendek', 'pendek', 'normal', 'tinggi']);
            $table->enum('status_bb_tb', ['gizi buruk', 'gizi kurang', 'gizi baik', 'risiko gizi lebih', 'gizi lebih' , 'obesitas']);
            $table->enum('status_stunting', ['stunting', 'normal', 'beresiko']);
            $table->float('presentase_resiko_stunting'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_screenings');
    }
};
