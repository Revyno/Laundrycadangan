<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // Total revenue from all paid payments
        $totalRevenue = Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PAID)
            ->sum('jumlah_dibayar');

        // Revenue this month
        $revenueThisMonth = Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PAID)
            ->whereBetween('tanggal_pembayaran', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])
            ->sum('jumlah_dibayar');

        // Revenue last month
        $revenueLastMonth = Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PAID)
            ->whereBetween('tanggal_pembayaran', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth()
            ])
            ->sum('jumlah_dibayar');

        // Calculate growth percentage
        $growth = $revenueLastMonth > 0
            ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100
            : 0;

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pendapatan dari semua pembayaran')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Pendapatan bulan ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Pertumbuhan Pendapatan', number_format($growth, 1) . '%')
                ->description('Dibandingkan bulan lalu')
                ->descriptionIcon($growth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($growth >= 0 ? 'success' : 'danger'),
        ];
    }
}