<?php

namespace App\Filament\Customer\Resources\PembayaranResource\Pages;

use App\Filament\Customer\Resources\PembayaranResource;
use App\Models\Pembayaran;
use Filament\Resources\Pages\Page;

class PrintInvoice extends Page
{
    protected static string $resource = PembayaranResource::class;

    protected static string $view = 'filament.customer.resources.pembayaran-resource.pages.print-invoice';

    public Pembayaran $record;

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
