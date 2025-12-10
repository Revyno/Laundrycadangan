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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');
            $table->foreignId('jenis_sepatu_id')->nullable()->constrained('jenis_sepatus')->onDelete('set null');
            $table->integer('jumlah_pasang');
            $table->enum('kondisi_sepatu', [
                'ringan',
                'sedang',
                'berat'
            ])->default('ringan');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('biaya_tambahan', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->text('catatan_khusus')->nullable();
            $table->string('foto_sebelum')->nullable();
            $table->string('foto_sesudah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__pesanans');
    }
};