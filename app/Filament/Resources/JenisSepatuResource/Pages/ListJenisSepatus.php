<?php

namespace App\Filament\Resources\JenisSepatuResource\Pages;

use App\Filament\Resources\JenisSepatuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisSepatus extends ListRecords
{
    protected static string $resource = JenisSepatuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
