<?php

namespace Tests\Unit;

use App\Models\Jenis_Sepatu;
use Tests\TestCase;

class JenisSepatuTest extends TestCase
{
    /**
     * Test fillable attributes.
     */
    public function test_jenis_sepatu_has_fillable_attributes(): void
    {
        $model = new Jenis_Sepatu();
        $fillable = [
            'nama_jenis',
            'merek',
            'bahan',
            'keterangan',
            'is_active'
        ];
        
        $this->assertEquals($fillable, $model->getFillable());
    }

    public function test_jenis_sepatu_casts(): void
    {
        $model = new Jenis_Sepatu();
        $casts = $model->getCasts();
        
        $this->assertEquals('boolean', $casts['is_active']);
    }
}
