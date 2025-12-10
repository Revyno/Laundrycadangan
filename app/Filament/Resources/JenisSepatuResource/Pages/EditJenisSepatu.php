<?php

namespace App\Filament\Resources\JenisSepatuResource\Pages;

use App\Filament\Resources\JenisSepatuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisSepatu extends EditRecord
{
    protected static string $resource = JenisSepatuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
