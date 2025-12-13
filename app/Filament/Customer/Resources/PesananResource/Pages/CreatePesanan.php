<?php

namespace App\Filament\Customer\Resources\PesananResource\Pages;

use App\Filament\Customer\Resources\PesananResource;
use App\Models\Layanan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePesanan extends CreateRecord
{
    protected static string $resource = PesananResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate total_harga from detail_pesanans
        $total = 0;
        if (isset($data['detail_pesanans']) && is_array($data['detail_pesanans'])) {
            foreach ($data['detail_pesanans'] as &$detail) {
                // Ensure subtotal is calculated if not set
                if (!isset($detail['subtotal']) || $detail['subtotal'] == 0) {
                    $layananId = $detail['layanan_id'] ?? null;
                    if ($layananId) {
                        $layanan = \App\Models\Layanan::find($layananId);
                        if ($layanan) {
                            $hargaSatuan = $layanan->harga_layanan;
                            $jumlah = $detail['jumlah_pasang'] ?? 1;
                            $biayaTambahan = $detail['biaya_tambahan'] ?? 0;
                            $detail['harga_satuan'] = $hargaSatuan;
                            $detail['subtotal'] = ($hargaSatuan * $jumlah) + $biayaTambahan;
                        }
                    }
                }
                $total += $detail['subtotal'] ?? 0;
            }
            unset($detail); // Break reference
        }
        $data['total_harga'] = $total;
        $data['status'] = 'pending';

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Extract detail_pesanans from data
        $detailPesanans = $data['detail_pesanans'] ?? [];
        unset($data['detail_pesanans']);

        // Create the pesanan
        $pesanan = static::getModel()::create($data);

        // Create detail_pesanans
        foreach ($detailPesanans as $detail) {
            $pesanan->detailPesanans()->create($detail);
        }

        // Recalculate total to ensure accuracy
        $total = $pesanan->detailPesanans()->sum('subtotal');
        $pesanan->update(['total_harga' => $total]);

        return $pesanan;
    }
}
