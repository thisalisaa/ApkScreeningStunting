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
        Schema::create('standar_bb_tbs', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->integer('panjang_badan');
            $table->float('L')->nullable(); 
            $table->float('median')->nullable();
            $table->float('S')->nullable();
            $table->float('SD3neg')->nullable();
            $table->float('SD2neg')->nullable();
            $table->float('SD1neg')->nullable();
            $table->float('SD0')->nullable();
            $table->float('SD1')->nullable();
            $table->float('SD2')->nullable();
            $table->float('SD3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_bb_tbs');
    }
};
