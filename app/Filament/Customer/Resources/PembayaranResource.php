<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\PembayaranResource\Pages;
use App\Filament\Customer\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pesanan_id')
                    ->label('Pesanan')
                    ->relationship(
                        name: 'pesanan',
                        titleAttribute: 'kode_pesanan',
                        modifyQueryUsing: fn (Builder $query) => $query->where('customer_id', Auth::id())
                    )
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabled(fn ($context) => $context === 'edit')
                    ->dehydrated()
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $pesanan = \App\Models\Pesanan::find($state);
                            if ($pesanan) {
                                $set('jumlah_dibayar', $pesanan->total_harga);
                            }
                        }
                    }),

                Forms\Components\DatePicker::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Jumlah dibayar otomatis dihitung berdasarkan total pesanan'),

                Forms\Components\Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer',
                        'ewallet' => 'E-Wallet',
                        'qris' => 'QRIS',
                        'debit' => 'Debit',
                        'credit' => 'Credit',
                    ])
                    ->default('transfer')
                    ->required(),

                Forms\Components\Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refund' => 'Refund',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required()
                    ->disabled(fn ($context) => $context === 'create'),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->image()
                    ->directory('bukti-pembayaran')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->helperText('Upload bukti pembayaran (maks 5MB)')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('nomor_referensi')
                    ->label('Nomor Referensi')
                    ->maxLength(255)
                    ->helperText('Nomor referensi transaksi (opsional)'),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) =>
                $query->whereHas('pesanan', fn ($q) => $q->where('customer_id', Auth::id()))
            )
            ->columns([
                Tables\Columns\TextColumn::make('pesanan.kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_pembayaran')
                    ->label('Tanggal Bayar')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_dibayar')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                        'refund' => 'danger',
                        'failed' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->square()
                    ->disk('public')
                    ->visibility('public'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refund' => 'Refund',
                        'failed' => 'Failed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('print_invoice')
                        ->label('Cetak Invoice')
                        ->icon('heroicon-o-printer')
                        ->color('success')
                        ->url(fn (Pembayaran $record): string => Pages\PrintInvoice::getUrl(['record' => $record]))
                        ->openUrlInNewTab(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
            'print-invoice' => Pages\PrintInvoice::route('/{record}/print-invoice'),
        ];
    }
}