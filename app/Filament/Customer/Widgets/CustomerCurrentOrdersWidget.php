<?php

namespace App\Filament\Customer\Widgets;

use App\Models\Pesanan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CustomerCurrentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pesanan::query()
                    ->where('customer_id', Auth::guard('customer')->id())
                    ->whereNotIn('status', [Pesanan::STATUS_COMPLETED, Pesanan::STATUS_CANCELLED])
                    ->with(['detailPesanans.layanan'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('kode_pesanan')
                    ->label('Order Code')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_pesanan')
                    ->label('Order Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Pesanan::STATUS_PENDING => 'gray',
                        Pesanan::STATUS_IN_PROCESS => 'info',
                        Pesanan::STATUS_READY => 'success',
                        Pesanan::STATUS_DELIVERED => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Pesanan::STATUS_PENDING => 'Pending',
                        Pesanan::STATUS_IN_PROCESS => 'In Process',
                        Pesanan::STATUS_READY => 'Ready',
                        Pesanan::STATUS_DELIVERED => 'Delivered',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('detailPesanans.layanan.nama_layanan')
                    ->label('Services')
                    ->listWithLineBreaks()
                    ->limitList(3)
                    ->expandableLimitedList(),

                Tables\Columns\TextColumn::make('total_pasang')
                    ->label('Total Layanan')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Price')
                    ->getStateUsing(function (Pesanan $record) {
                        $total = 0;
                        foreach ($record->detailPesanans as $detail) {
                            $total += $detail->subtotal ?? 0;
                        }
                        return $total;
                    })
                    ->money('IDR')
                    ->alignRight(),
            ])
            ->defaultSort('tanggal_pesanan', 'desc')
            ->emptyStateHeading('No current orders')
            ->emptyStateDescription('You don\'t have any active orders at the moment.')
            ->emptyStateIcon('heroicon-o-shopping-bag');
    }
}