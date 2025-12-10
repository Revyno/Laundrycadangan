<?php
// database/migrations/2024_01_01_000004_create_pesanans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('kode_pesanan')->unique();
            $table->date('tanggal_pesanan');
            $table->date('tanggal_selesai')->nullable();
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', [
                'pending',
                'in_process',
                'completed',
                'ready',
                'delivered',
                'cancelled'
            ])->default('pending');
            $table->enum('metode_pengantaran', ['drop_off', 'pickup', 'delivery'])->default('drop_off');
            $table->text('alamat_pengantaran')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};