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
       Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_dibayar', 10, 2);
            $table->decimal('kembalian', 10, 2)->default(0);
            $table->enum('metode_pembayaran', [
                'cash',
                'transfer',
                'ewallet',
                'qris',
                'debit',
                'credit'
            ])->default('cash');
            $table->enum('status_pembayaran', [
                'pending',
                'partial',
                'paid',
                'refund',
                'failed',
            ])->default('pending');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('nomor_referensi')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};