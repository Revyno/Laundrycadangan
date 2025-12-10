<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Detail_Pesanan extends Model
{
    //
    use HasFactory;

    protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'layanan_id',
        'jenis_sepatu_id',
        'jumlah_pasang',
        'kondisi_sepatu',
        'harga_satuan',
        'biaya_tambahan',
        'subtotal',
        'catatan_khusus',
        'foto_sebelum',
        'foto_sesudah'
    ];

    protected $casts = [
        'jumlah_pasang' => 'integer',
        'harga_satuan' => 'decimal:2',
        'biaya_tambahan' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    // Konstanta Kondisi Sepatu
    const KONDISI_RINGAN = 'ringan';
    const KONDISI_SEDANG = 'sedang';
    const KONDISI_BERAT = 'berat';

    // Relationships
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function jenisSepatu(): BelongsTo
    {
        return $this->belongsTo(Jenis_Sepatu::class);
    }
}