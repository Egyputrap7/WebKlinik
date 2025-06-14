<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('konsultasi_messages', function (Blueprint $table) {
           $table->id();
           $table->foreignId('konsultasi_id')->constrained()->onDelete('cascade');
           $table->foreignId('user_id')->constrained()->onDelete('cascade');
           $table->text('isi');
           $table->enum('sender_type', ['user', 'admin']); // Tambahan ini
           $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi_messages');
    }
};
