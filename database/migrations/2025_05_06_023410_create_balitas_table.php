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
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_orang_tua')->constrained('orang_tuas')->onDelete('cascade');
            $table->foreignId('id_posyandu')->constrained('posyandus')->onDelete('cascade');
            $table->string('nama_balita');
            $table->string('nik_balita');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->decimal('berat_badan_lahir', 5);
            $table->decimal('panjang_badan_lahir', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
