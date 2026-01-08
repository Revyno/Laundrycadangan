<?php

namespace Tests\Unit;

use App\Models\Laporan_laundrie;
use Tests\TestCase;

class LaporanLaundrieTest extends TestCase
{
    public function test_laporan_laundrie_fillable(): void
    {
        $model = new Laporan_laundrie();
        $fillable = [
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
        
        $this->assertEquals($fillable, $model->getFillable());
    }

    public function test_laporan_laundrie_casts(): void
    {
        $model = new Laporan_laundrie();
        $casts = $model->getCasts();
        
        $this->assertEquals('date', $casts['periode_awal']);
        $this->assertEquals('date', $casts['periode_akhir']);
        $this->assertEquals('decimal:2', $casts['total_pendapatan']);
        $this->assertEquals('integer', $casts['total_pesanan']);
        $this->assertEquals('array', $casts['layanan_terpopuler']);
    }
}
