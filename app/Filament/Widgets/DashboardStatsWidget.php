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
        $totalPayments = Pembayaran::count();
        $paidPayments = Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PAID)->count();
        $unpaidPayments = $totalPayments - $paidPayments;

        // Calculate order success rate
        $completedOrders = Pesanan::whereIn('status', ['completed', 'delivered'])->count();
        $orderSuccessRate = $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0;

        // Calculate payment success rate
        $paymentSuccessRate = $totalPayments > 0 ? ($paidPayments / $totalPayments) * 100 : 0;

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('Total pesanan yang telah dibuat')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Total Customers', $totalCustomers)
                ->description('Total pelanggan terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Order Success Rate', number_format($orderSuccessRate, 1) . '%')
                ->description($completedOrders . ' dari ' . $totalOrders . ' pesanan selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color($orderSuccessRate >= 80 ? 'success' : ($orderSuccessRate >= 60 ? 'warning' : 'danger')),

            Stat::make('Payment Success Rate', number_format($paymentSuccessRate, 1) . '%')
                ->description($paidPayments . ' dari ' . $totalPayments . ' pembayaran lunas')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color($paymentSuccessRate >= 80 ? 'success' : ($paymentSuccessRate >= 60 ? 'warning' : 'danger')),

            Stat::make('Unpaid Payments', $unpaidPayments)
                ->description('Pembayaran yang belum lunas')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Paid Payments', $paidPayments)
                ->description('Pembayaran yang sudah lunas')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Pending Payments', Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PENDING)->count())
                ->description('Pembayaran yang sedang diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Partial Payments', Pembayaran::where('status_pembayaran', Pembayaran::STATUS_PARTIAL)->count())
                ->description('Pembayaran yang dibayar sebagian')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('Failed Payments', Pembayaran::where('status_pembayaran', Pembayaran::STATUS_FAILED)->count())
                ->description('Pembayaran yang gagal')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}