<?php
// app/Models/Layanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_layanan',
        'kategori_layanan',
        'deskripsi',
        'durasi_hari',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'durasi_hari' => 'integer'
    ];

    // Kategori constants dengan harga default
    const KATEGORI_BASIC = 'basic';
    const KATEGORI_PREMIUM = 'premium';
    const KATEGORI_DEEP = 'deep';
    const KATEGORI_UNYELLOWING = 'unyellowing';
    const KATEGORI_REPAINT = 'repaint';
    const KATEGORI_REPAIR = 'repair';

    // Harga default per kategori
    const HARGA_KATEGORI = [
        'basic' => 50000,
        'premium' => 100000,
        'deep' => 150000,
        'unyellowing' => 75000,
        'repaint' => 200000,
        'repair' => 250000,
    ];

    // Durasi default per kategori (dalam hari)
    const DURASI_HARI_KATEGORI = [
        'basic' => 1,
        'premium' => 2,
        'deep' => 3,
        'unyellowing' => 2,
        'repaint' => 4,
        'repair' => 5,
    ];

    // Relationships
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailPesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

    // Scope aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get harga berdasarkan kategori
    public function getHargaLayananAttribute(): float
    {
        return self::HARGA_KATEGORI[$this->kategori_layanan] ?? 0;
    }

    // Get formatted price
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_layanan, 0, ',', '.');
    }

    // Set durasi_hari otomatis berdasarkan kategori
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->durasi_hari)) {
                $layanan->durasi_hari = self::DURASI_HARI_KATEGORI[$layanan->kategori_layanan] ?? 1;
            }
        });

        static::updating(function ($layanan) {
            if ($layanan->isDirty('kategori_layanan')) {
                $layanan->durasi_hari = self::DURASI_HARI_KATEGORI[$layanan->kategori_layanan] ?? 1;
            }
        });

        static::created(function ($layanan) {
            // Send notification to all admins when service is created
            $notification = new \App\Notifications\ServiceCreated($layanan);
            $notification->send();
        });
    }

    // Helper methods
    public function getHargaLabelAttribute(): string
    {
        $kategoriLabels = [
            'basic' => 'Basic Clean',
            'premium' => 'Premium Clean',
            'deep' => 'Deep Clean',
            'unyellowing' => 'Unyellowing',
            'repaint' => 'Repaint',
            'repair' => 'Repair',
        ];

        return $kategoriLabels[$this->kategori_layanan] ?? 'Unknown';
    }
}