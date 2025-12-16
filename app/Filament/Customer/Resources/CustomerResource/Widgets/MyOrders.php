<?php

namespace App\Filament\Customer\Resources\CustomerResource\Widgets;

use App\Models\Customer;
use App\Models\Pesanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MyOrders extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
        ];
    }
}