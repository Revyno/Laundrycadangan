<?php

namespace Tests\Unit;

use App\Models\Pembayaran;
use Tests\TestCase;

class PembayaranTest extends TestCase
{
    /**
     * Test fillable attributes.
     */
    public function test_pembayaran_has_fillable_attributes(): void
    {
        $model = new Pembayaran();
        $fillable = [
            'pesanan_id',
            'tanggal_pembayaran',
            'jumlah_dibayar',
            'kembalian',
            'metode_pembayaran',
            'status_pembayaran',
            'bukti_pembayaran',
            'nomor_referensi',
            'user_id',
            'catatan'
        ];
        
        $this->assertEquals($fillable, $model->getFillable());
    }

    public function test_pembayaran_casts(): void
    {
        $model = new Pembayaran();
        $casts = $model->getCasts();
        
        $this->assertEquals('date', $casts['tanggal_pembayaran']);
        $this->assertEquals('decimal:2', $casts['jumlah_dibayar']);
        $this->assertEquals('decimal:2', $casts['kembalian']);
    }

    public function test_pembayaran_constants(): void
    {
        $this->assertEquals('cash', Pembayaran::METODE_CASH);
        $this->assertEquals('paid', Pembayaran::STATUS_PAID);
    }
}
