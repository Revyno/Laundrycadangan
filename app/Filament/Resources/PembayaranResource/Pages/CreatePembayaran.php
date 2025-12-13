<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use App\Models\Laporan_laundrie;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function afterCreate(): void
    {
        // Jika status pembayaran langsung 'paid', update laporan
        if ($this->record->status_pembayaran === 'paid') {
            Laporan_laundrie::updateLaporanForPeriod($this->record->tanggal_pembayaran);
        }
    }
}
