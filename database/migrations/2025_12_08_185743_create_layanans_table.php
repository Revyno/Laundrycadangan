<?php
// database/migrations/2024_01_01_000002_create_layanans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_layanan');
            $table->enum('kategori_layanan', [
                'basic',
                'premium',
                'deep',
                'unyellowing',
                'repaint',
                'repair'
            ])->default('basic');

            // $table->decimal('harga_layanan', 10, 2); // DIHAPUS
            $table->text('deskripsi')->nullable();
         
            $table->integer('durasi_hari')->default(1);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
