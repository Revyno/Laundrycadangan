<?php

namespace App\Filament\Customer\Resources\PesananResource\Pages;

use App\Filament\Customer\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPesanan extends ViewRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
