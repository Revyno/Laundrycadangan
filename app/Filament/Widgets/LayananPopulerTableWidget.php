<?php

namespace App\Filament\Widgets;

use App\Models\Layanan;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class LayananPopulerTableWidget extends Widget
{
    protected static string $view = 'filament.widgets.layanan-populer-table-widget';
    
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '30s';

    public function getViewData(): array
    {
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
            ->get();

        return [
            'layananPopuler' => $layananPopuler,
        ];
    }

    protected function getView(): View
    {
        return view(static::$view, $this->getViewData());
    }
}

