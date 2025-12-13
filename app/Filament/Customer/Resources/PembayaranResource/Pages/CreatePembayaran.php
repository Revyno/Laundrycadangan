<?php

namespace App\Filament\Customer\Resources\PembayaranResource\Pages;

use App\Filament\Customer\Resources\PembayaranResource;
use App\Models\Pesanan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    public ?Pesanan $pesanan = null;

    public function mount(): void
    {
        parent::mount();

        // Get pesanan_id from query parameter
        $pesananId = request()->query('pesanan_id');
        
        if ($pesananId) {
            $this->pesanan = Pesanan::find($pesananId);
            
            // Pre-fill form with pesanan data
            if ($this->pesanan) {
                $this->form->fill([
                    'pesanan_id' => $this->pesanan->id,
                    'jumlah_dibayar' => $this->pesanan->total_harga,
                    'tanggal_pembayaran' => now(),
                ]);
            }
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure pesanan_id is set if not provided
        if (!isset($data['pesanan_id']) && $this->pesanan) {
            $data['pesanan_id'] = $this->pesanan->id;
        }

        // Set default status
        if (!isset($data['status_pembayaran'])) {
            $data['status_pembayaran'] = 'pending';
        }

        return $data;
    }

    public function getTitle(): string | Htmlable
    {
        if ($this->pesanan) {
            return 'Pembayaran - ' . $this->pesanan->kode_pesanan;
        }

        return parent::getTitle();
    }
}
