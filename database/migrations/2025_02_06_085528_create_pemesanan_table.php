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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('jadwal_travel_id')->nullable(); 
            $table->integer('jumlah_tiket');
            $table->enum('status', ['menunggu_pembayaran', 'sudah_dibayar', 'Dibatalkan'])->default('menunggu_pembayaran'); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jadwal_travel_id')->references('id')->on('jadwal_travel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
