<?php

namespace App\Filament\Resources\LaporanLaundrieResource\Pages;

use App\Filament\Resources\LaporanLaundrieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLaporanLaundrie extends CreateRecord
{
    protected static string $resource = LaporanLaundrieResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure user_id is set
        if (!isset($data['user_id']) || empty($data['user_id'])) {
            $data['user_id'] = Auth::id();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // Generate laporan data automatically after creation
        LaporanLaundrieResource::generateLaporanData($this->record);
    }
}