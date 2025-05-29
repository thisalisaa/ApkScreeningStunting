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
        Schema::create('data_himpunan_fuzzies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_faktor')->constrained('faktors')->onDelete('cascade');
            $table->string('nama_himpunan'); 
            $table->string('satuan')->nullable();
            $table->float('batas_bawah')->nullable();
            $table->float('batas_tengah1')->nullable();
            $table->float('batas_tengah2')->nullable();
            $table->float('batas_atas')->nullable();
            $table->string('tipe_fungsi')->nullable();
            $table->enum('tipe_input', ['numerik', 'diskrit']);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_himpunan_fuzzies');
    }
};
