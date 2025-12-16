<?php

namespace App\Filament\Resources\LaporanLaundrieResource\Pages;

use App\Filament\Resources\LaporanLaundrieResource;
use App\Models\Laporan_laundrie;
use Filament\Resources\Pages\Page;

class PrintLaporan extends Page
{
    protected static string $resource = LaporanLaundrieResource::class;

    protected static string $view = 'filament.resources.laporan-laundrie-resource.pages.print-laporan';

    public Laporan_laundrie $record;

    public function mount($record): void
    {
        $this->record = $record;
    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
        ];
    }
}
