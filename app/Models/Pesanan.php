<?php
// app/Models/Pesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kode_pesanan',
        'tanggal_pesanan',
        'tanggal_selesai',
        'total_harga',
        'status',
        'metode_pengantaran',
        'alamat_pengantaran',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'date',
        'tanggal_selesai' => 'date',
        'total_harga' => 'decimal:2'
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_COMPLETED = 'completed';
    const STATUS_READY = 'ready';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Metode pengantaran constants
    const METODE_DROP_OFF = 'drop_off';
    const METODE_PICKUP = 'pickup';
    const METODE_DELIVERY = 'delivery';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pesanan) {
            if (empty($pesanan->kode_pesanan)) {
                $date = now()->format('Ymd');
                $lastOrder = self::whereDate('created_at', today())->latest()->first();
                $number = $lastOrder ? (int) substr($lastOrder->kode_pesanan, -3) + 1 : 1;
                $pesanan->kode_pesanan = 'LND-' . $date . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function detailPesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }

    // Hitung total pasang sepatu
    public function getTotalPasangAttribute(): int
    {
        return $this->detailPesanans()->sum('jumlah_pasang');
    }

    // Get formatted total harga
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }
}