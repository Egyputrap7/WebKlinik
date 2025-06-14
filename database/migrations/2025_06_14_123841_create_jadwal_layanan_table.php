<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jadwal_layanan', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // tanggal layanan, tidak boleh duplikat
            $table->string('status');       // Contoh: Buka, Tutup
            $table->string('hours');        // Contoh: 08:00 - 16:00 atau '-'
            $table->string('reservation');  // Contoh: Tersedia, Full Booked
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_layanan');
    }
};
