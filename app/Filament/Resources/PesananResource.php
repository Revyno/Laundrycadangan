<?php
// app/Filament/Customer/Resources/PesananResource.php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pesanan Saya';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Pesanan Saya';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('customer_id')
                    ->default(Auth::id()),

                Forms\Components\DatePicker::make('tanggal_pesanan')
                    ->required()
                    ->default(now())
                    ->label('Tanggal Pesanan'),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai'),

                Forms\Components\TextInput::make('total_harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Total Harga'),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_process' => 'Diproses',
                        'completed' => 'Selesai',
                        'ready' => 'Siap Diambil',
                        'delivered' => 'Terkirim',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->default('pending')
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('metode_pengantaran')
                    ->label('Metode Pengantaran')
                    ->options([
                        'drop_off' => 'Drop Off',
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                    ])
                    ->default('drop_off')
                    ->required(),

                Forms\Components\Textarea::make('alamat_pengantaran')
                    ->label('Alamat Pengantaran')
                    ->maxLength(65535)
                    ->requiredIf('metode_pengantaran', 'delivery')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('catatan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->where('customer_id', Auth::id()))
            ->columns([
                Tables\Columns\TextColumn::make('kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_pesanan')
                    ->label('Tanggal Pesan')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_process' => 'info',
                        'completed' => 'success',
                        'ready' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', $state)))
                    ->sortable(),

                Tables\Columns\TextColumn::make('metode_pengantaran')
                    ->label('Pengantaran')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', $state))),

                Tables\Columns\TextColumn::make('detail_pesanans_count')
                    ->counts('detailPesanans')
                    ->label('Jumlah Item'),

                Tables\Columns\TextColumn::make('pembayaran.status_pembayaran')
                    ->label('Status Bayar')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                        'refund' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_process' => 'Diproses',
                        'completed' => 'Selesai',
                        'ready' => 'Siap Diambil',
                        'delivered' => 'Terkirim',
                        'cancelled' => 'Dibatalkan',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('bayar')
                        ->label('Bayar')
                        ->icon('heroicon-o-credit-card')
                        ->color('success')
                        ->url(fn (Pesanan $record) => route('filament.customer.pages.pembayaran', ['pesanan' => $record->id]))
                        ->visible(fn (Pesanan $record) =>
                            (!$record->pembayaran || $record->pembayaran->status_pembayaran !== 'paid') &&
                            $record->status !== 'cancelled'
                        ),

                    Tables\Actions\Action::make('cancel')
                        ->label('Batalkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Pesanan $record) => $record->update(['status' => 'cancelled']))
                        ->requiresConfirmation()
                        ->visible(fn (Pesanan $record) => $record->status === 'pending'),

                    Tables\Actions\Action::make('invoice')
                        ->icon('heroicon-o-printer')
                        ->url(fn (Pesanan $record) => route('customer.pesanan.invoice', $record))
                        ->openUrlInNewTab(),
                ]),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                \Filament\Tables\Actions\Action::make('create')
                    ->label('Buat Pesanan Baru')
                    ->url(route('filament.customer.resources.pesanans.create'))
                    ->icon('heroicon-o-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            // 'view' => Pages\ViewPesanan::route('/{record}'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
