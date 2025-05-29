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
        Schema::create('data_antropometris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pengukuran_id')->constrained('data_pengukurans')->onDelete('cascade');
            $table->float('z_score_bb_u')->nullable(); 
            $table->float('z_score_tb_u')->nullable(); 
            $table->float('z_score_bb_tb')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_antropometris');
    }
};
