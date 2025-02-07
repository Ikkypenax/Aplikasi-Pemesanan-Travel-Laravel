<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukti_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan')->onDelete('cascade');
        });

        DB::statement("ALTER TABLE pemesanan MODIFY COLUMN status ENUM('menunggu_pembayaran', 'sudah_dibayar', 'Dibatalkan', 'menunggu_verifikasi') DEFAULT 'menunggu_pembayaran'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pembayaran');
        DB::statement("ALTER TABLE pemesanan MODIFY COLUMN status ENUM('menunggu_pembayaran', 'sudah_dibayar', 'Dibatalkan') DEFAULT 'menunggu_pembayaran'");
    }
};
