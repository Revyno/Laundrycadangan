<?php
// app/Filament/Customer/Resources/PembayaranResource.php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Pesanan;
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

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pesanan_id')
                    ->relationship(
                        name: 'pesanan',
                        titleAttribute: 'kode_pesanan',
                        modifyQueryUsing: fn (Builder $query) => $query->where('customer_id', Auth::id())
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pilih Pesanan'),

                Forms\Components\DatePicker::make('tanggal_pembayaran')
                    ->required()
                    ->default(now())
                    ->label('Tanggal Pembayaran'),

                Forms\Components\TextInput::make('jumlah_dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Jumlah Dibayar'),

                Forms\Components\Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer Bank',
                        'ewallet' => 'E-Wallet',
                        'qris' => 'QRIS',
                    ])
                    ->default('transfer')
                    ->required()
                    ->live(),

                Forms\Components\Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refund' => 'Refund',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('bukti-pembayaran')
                    ->requiredIf('metode_pembayaran', 'transfer')
                    ->visible(fn ($get) => in_array($get('metode_pembayaran'), ['transfer', 'ewallet'])),

                Forms\Components\TextInput::make('nomor_referensi')
                    ->label('Nomor Referensi')
                    ->maxLength(255)
                    ->visible(fn ($get) => in_array($get('metode_pembayaran'), ['transfer', 'ewallet', 'qris'])),

                Forms\Components\Textarea::make('catatan')
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
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->circular(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refund' => 'Refund',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
