<?php

namespace Tests\Unit;

use App\Models\Detail_Pesanan;
use Tests\TestCase;

class DetailPesananTest extends TestCase
{
    /**
     * Test fillable attributes.
     */
    public function test_detail_pesanan_has_fillable_attributes(): void
    {
        $model = new Detail_Pesanan();
        $fillable = [
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
        
        $this->assertEquals($fillable, $model->getFillable());
    }

    public function test_detail_pesanan_casts(): void
    {
        $model = new Detail_Pesanan();
        $casts = $model->getCasts();
        
        $this->assertEquals('integer', $casts['jumlah_pasang']);
        $this->assertEquals('decimal:2', $casts['harga_satuan']);
        $this->assertEquals('decimal:2', $casts['subtotal']);
    }
}
