<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use App\Models\Laporan_laundrie;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembayaran extends EditRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Jika status pembayaran diubah menjadi 'paid', update laporan
        if ($this->record->status_pembayaran === 'paid') {
            Laporan_laundrie::updateLaporanForPeriod($this->record->tanggal_pembayaran);
        }
    }
}
