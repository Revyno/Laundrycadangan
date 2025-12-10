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
        'harga_layanan',
        'deskripsi',
        'durasi',
        'durasi_hari',
        'image',
        'fitur',
        'is_active'
    ];

    protected $casts = [
        'fitur' => 'array',
        'harga_layanan' => 'decimal:2',
        'is_active' => 'boolean',
        'durasi_hari' => 'integer'
    ];

    // Kategori constants
    const KATEGORI_BASIC = 'basic';
    const KATEGORI_PREMIUM = 'premium';
    const KATEGORI_DEEP = 'deep';
    const KATEGORI_UNYELLOWING = 'unyellowing';
    const KATEGORI_REPAINT = 'repaint';
    const KATEGORI_REPAIR = 'repair';

    // Relationships
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    // Get formatted price
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_layanan, 0, ',', '.');
    }
}
