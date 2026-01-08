<?php

namespace Tests\Unit;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PesananTest extends TestCase
{
    /**
     * Test fillable attributes.
     */
    public function test_pesanan_has_fillable_attributes(): void
    {
        $model = new Pesanan();
        $fillable = [
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
        
        $this->assertEquals($fillable, $model->getFillable());
    }

    public function test_pesanan_casts(): void
    {
        $model = new Pesanan();
        $casts = $model->getCasts();
        
        // Note: 'date' cast makes it Carbon instance which matches date string in DB usually.
        $this->assertEquals('date', $casts['tanggal_pesanan']);
        $this->assertEquals('date', $casts['tanggal_selesai']);
        $this->assertEquals('decimal:2', $casts['total_harga']);
    }

    public function test_pesanan_constants(): void
    {
        $this->assertEquals('pending', Pesanan::STATUS_PENDING);
        $this->assertEquals('completed', Pesanan::STATUS_COMPLETED);
    }
}
