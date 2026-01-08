<?php

namespace App\Filament\Resources\LaporanLaundrieResource\Pages;

use App\Filament\Resources\LaporanLaundrieResource;
use App\Models\Laporan_laundrie;
use Filament\Resources\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function downloadPdf()
    {
        $pdf = Pdf::loadView('filament.resources.laporan-laundrie-resource.pages.print-laporan-pdf', [
            'record' => $this->record,
        ]);

        $pdf->setPaper('a4', 'landscape');
        
        $filename = 'Laporan_Laundry_' . $this->record->periode_awal->format('Y-m-d') . '_' . $this->record->periode_akhir->format('Y-m-d') . '.pdf';
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }
}
