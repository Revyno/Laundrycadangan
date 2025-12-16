<?php

namespace App\Filament\Widgets;

use App\Models\Layanan;
use App\Models\Pembayaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class LayananPopulerStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        // Ambil data layanan terpopuler dengan total pemasukan
        $layananPopuler = DB::table('detail_pesanans')
            ->join('layanans', 'detail_pesanans.layanan_id', '=', 'layanans.id')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id')
            ->where('pembayarans.status_pembayaran', 'paid')
            ->select(
                'layanans.id',
                'layanans.nama_layanan',
                'layanans.kategori_layanan',
                DB::raw('COUNT(DISTINCT detail_pesanans.pesanan_id) as total_pesanan'),
                DB::raw('SUM(detail_pesanans.jumlah_pasang) as total_pasang'),
                DB::raw('SUM(detail_pesanans.subtotal) as total_pendapatan')
            )
            ->groupBy('layanans.id', 'layanans.nama_layanan', 'layanans.kategori_layanan')
            ->orderByDesc('total_pesanan')
            ->limit(3)
            ->get();

        $stats = [];

        foreach ($layananPopuler as $index => $layanan) {
            $stats[] = Stat::make($layanan->nama_layanan, 'Rp ' . number_format($layanan->total_pendapatan, 0, ',', '.'))
                ->description($layanan->total_pesanan . ' pesanan • ' . $layanan->total_pasang . ' pasang')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($this->getColorForIndex($index))
                ->chart($this->getChartData($layanan->id));
        }

        // Jika tidak ada data, tampilkan statistik kosong
        if (empty($stats)) {
            $stats[] = Stat::make('Belum Ada Data', 'Rp 0')
                ->description('Belum ada layanan yang dipesan')
                ->descriptionIcon('heroicon-m-information-circle')
                ->color('gray');
        }

        return $stats;
    }

    protected function getColorForIndex(int $index): string
    {
        $colors = ['success', 'primary', 'warning'];
        return $colors[$index] ?? 'gray';
    }

    protected function getChartData($layananId): array
    {
        // Ambil data 7 hari terakhir untuk chart
        $data = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id')
            ->where('detail_pesanans.layanan_id', $layananId)
            ->where('pembayarans.status_pembayaran', 'paid')
            ->where('pembayarans.tanggal_pembayaran', '>=', now()->subDays(7))
            ->select(
                DB::raw('DATE(pembayarans.tanggal_pembayaran) as tanggal'),
                DB::raw('COALESCE(SUM(detail_pesanans.subtotal), 0) as pendapatan')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->keyBy('tanggal');

        // Buat array dengan 7 hari terakhir, isi 0 jika tidak ada data
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartData[] = (float) ($data->get($date)->pendapatan ?? 0);
        }

        return $chartData;
    }
}
