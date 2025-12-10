<?php

namespace App\Filament\Resources\LaporanLaundrieResource\Pages;

use App\Filament\Resources\LaporanLaundrieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanLaundries extends ListRecords
{
    protected static string $resource = LaporanLaundrieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
