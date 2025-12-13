<?php

namespace App\Filament\Customer\Resources\PesananResource\Pages;

use App\Filament\Customer\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPesanan extends EditRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Calculate total_harga from detail_pesanans
        $total = 0;
        if (isset($data['detail_pesanans']) && is_array($data['detail_pesanans'])) {
            foreach ($data['detail_pesanans'] as $detail) {
                $total += $detail['subtotal'] ?? 0;
            }
        }
        $data['total_harga'] = $total;

        return $data;
    }

    protected function afterSave(): void
    {
        // Recalculate total to ensure accuracy
        $total = $this->record->detailPesanans()->sum('subtotal');
        if ($total > 0) {
            $this->record->update(['total_harga' => $total]);
        }
    }
}
