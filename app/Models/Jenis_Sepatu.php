<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis_Sepatu extends Model
{
    //
    use HasFactory;

    protected $table = 'jenis_sepatus';

    protected $fillable = [
        
        'nama_jenis',
        'merek',
        'bahan',
        'keterangan',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function detailPesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

    // Scope aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
