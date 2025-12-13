<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Laporan_laundrie extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'user_id',
        'periode_awal',
        'periode_akhir',
        'total_pendapatan',
        'total_pengeluaran',
        'total_profit',
        'total_pesanan',
        'total_sepatu',
        'pesanan_selesai',
        'pesanan_batal',
        'layanan_terpopuler'
    ];

    protected $casts = [
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
        'total_pendapatan' => 'decimal:2',
        'total_pengeluaran' => 'decimal:2',
        'total_profit' => 'decimal:2',
        'total_pesanan' => 'integer',
        'total_sepatu' => 'integer',
        'pesanan_selesai' => 'integer',
        'pesanan_batal' => 'integer',
        'layanan_terpopuler' => 'array'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper method untuk update laporan berdasarkan periode
    public static function updateLaporanForPeriod($tanggalPembayaran)
    {
        // Cari laporan yang mencakup tanggal pembayaran
        $laporan = self::where('periode_awal', '<=', $tanggalPembayaran)
            ->where('periode_akhir', '>=', $tanggalPembayaran)
            ->first();

        if ($laporan) {
            // Re-generate data laporan
            \App\Filament\Resources\LaporanLaundrieResource::generateLaporanData($laporan);
        }
    }
}
