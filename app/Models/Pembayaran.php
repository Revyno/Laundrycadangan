<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'tanggal_pembayaran',
        'jumlah_dibayar',
        'kembalian',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
        'nomor_referensi',
        'admin_id',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'jumlah_dibayar' => 'decimal:2',
        'kembalian' => 'decimal:2'
    ];

    // Konstanta Metode Pembayaran
    const METODE_CASH = 'cash';
    const METODE_TRANSFER = 'transfer';
    const METODE_EWALLET = 'ewallet';
    const METODE_QRIS = 'qris';
    const METODE_DEBIT = 'debit';
    const METODE_CREDIT = 'credit';

    // Konstanta Status Pembayaran
    const STATUS_PENDING = 'pending';
    const STATUS_PARTIAL = 'partial';
    const STATUS_PAID = 'paid';
    const STATUS_REFUND = 'refund';

    // Relationships
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Hitung kekurangan pembayaran
    public function getKekuranganAttribute(): float
    {
        $totalHarga = $this->pesanan->total_harga;
        $totalDibayar = $this->where('pesanan_id', $this->pesanan_id)
            ->whereIn('status_pembayaran', [self::STATUS_PAID, self::STATUS_PARTIAL])
            ->sum('jumlah_dibayar');

        return max(0, $totalHarga - $totalDibayar);
    }
}