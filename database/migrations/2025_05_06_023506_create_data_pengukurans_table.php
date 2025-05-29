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
        Schema::create('data_pengukurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balita')->constrained('balitas')->onDelete('cascade');
            $table->date('tanggal_pengukuran');
            $table->integer('usia_bulan');
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->tinyInteger('asi_ekslusif')->nullable(); 
            $table->tinyInteger('mpasi')->nullable(); 
            $table->enum('status_verifikasi', ['to review', 'rejected', 'verified'])->default('to review');
            $table->string('catatan')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();       
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengukurans');
    }
};
