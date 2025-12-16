<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalOrders = Pesanan::count();
        $totalCustomers = Customer::count();
        $unpaidPayments = Pembayaran::where('status_pembayaran', '!=', Pembayaran::STATUS_PAID)->count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('Total pesanan yang telah dibuat')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Total Customers', $totalCustomers)
                ->description('Total pelanggan terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Unpaid Payments', $unpaidPayments)
                ->description('Pembayaran yang belum lunas')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }
}