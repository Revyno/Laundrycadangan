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
        Schema::create('laporan_laundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->decimal('total_pendapatan', 10, 2)->default(0);
            $table->decimal('total_pengeluaran', 10, 2)->default(0);
            $table->decimal('total_profit', 10, 2)->default(0);
            $table->integer('total_pesanan')->default(0);
            $table->integer('total_sepatu')->default(0);
            $table->integer('pesanan_selesai')->default(0);
            $table->integer('pesanan_batal')->default(0);
            $table->json('layanan_terpopuler')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_laundries');
    }
};