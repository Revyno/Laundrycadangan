<?php

namespace App\Filament\Customer\Widgets;

use App\Models\Pesanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CustomerStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return [];
        }

        $totalOrders = Pesanan::where('customer_id', $customer->id)->count();
        $ordersInProcess = Pesanan::where('customer_id', $customer->id)
            ->where('status', Pesanan::STATUS_IN_PROCESS)->count();
        $pendingOrders = Pesanan::where('customer_id', $customer->id)
            ->where('status', Pesanan::STATUS_PENDING)->count();
        $readyOrders = Pesanan::where('customer_id', $customer->id)
            ->where('status', Pesanan::STATUS_READY)->count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('Total pesanan Anda')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Orders in Process', $ordersInProcess)
                ->description('Pesanan sedang diproses')
                ->descriptionIcon('heroicon-m-cog')
                ->color('info'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Pesanan menunggu konfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('gray'),

            Stat::make('Ready for Pickup', $readyOrders)
                ->description('Pesanan siap diambil')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
