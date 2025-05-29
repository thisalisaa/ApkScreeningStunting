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
        Schema::create('data_aturans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aturan')->unique();
            $table->json('range_usia');
            $table->json('nilai_faktor'); 
            $table->string('keputusan');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_aturans');
    }
};
