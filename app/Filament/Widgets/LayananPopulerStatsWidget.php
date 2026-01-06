<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LayananPopulerStatsWidget extends Widget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Statistik Layanan Populer';

    protected static ?string $description = 'Daftar layanan berdasarkan jumlah pesanan dan total pemasukan';

    protected static string $view = 'filament.widgets.layanan-populer-table-widget';

    protected function getViewData(): array
    {
        return [
            'layananPopuler' => $this->getLayananPopuler(),
        ];
    }

    protected function getLayananPopuler()
    {
        return \App\Models\Layanan::query()
            ->select([
                'layanans.id',
                'layanans.nama_layanan',
                'layanans.kategori_layanan',
            ])
            ->selectRaw('
                COALESCE((
                    SELECT COUNT(DISTINCT dp.pesanan_id)
                    FROM detail_pesanans dp
                    JOIN pesanans p ON dp.pesanan_id = p.id
                    JOIN pembayarans pb ON p.id = pb.pesanan_id
                    WHERE dp.layanan_id = layanans.id
                    AND pb.status_pembayaran = "paid"
                ), 0) as total_pesanan
            ')
            ->selectRaw('
                COALESCE((
                    SELECT SUM(dp.jumlah_pasang)
                    FROM detail_pesanans dp
                    JOIN pesanans p ON dp.pesanan_id = p.id
                    JOIN pembayarans pb ON p.id = pb.pesanan_id
                    WHERE dp.layanan_id = layanans.id
                    AND pb.status_pembayaran = "paid"
                ), 0) as total_pasang
            ')
            ->selectRaw('
                COALESCE((
                    SELECT SUM(dp.subtotal)
                    FROM detail_pesanans dp
                    JOIN pesanans p ON dp.pesanan_id = p.id
                    JOIN pembayarans pb ON p.id = pb.pesanan_id
                    WHERE dp.layanan_id = layanans.id
                    AND pb.status_pembayaran = "paid"
                ), 0) as total_pendapatan
            ')
            ->orderBy('total_pasang', 'desc')
            ->limit(10)
            ->get()
            ->filter(function ($layanan) {
                return $layanan->total_pesanan > 0;
            });
    }
}