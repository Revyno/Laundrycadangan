<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pesanan';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Pesanan';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

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
                    ->label('Total Harga')
                    ->disabled(),

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
                    ->required(),

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
            ->columns([
                Tables\Columns\TextColumn::make('kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
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

                Tables\Columns\TextColumn::make('detailPesanans.layanan.nama_layanan')
                    ->label('Layanan')
                    ->badge()
                    ->separator(','),

                Tables\Columns\IconColumn::make('has_photos')
                    ->label('Ada Foto')
                    ->boolean()
                    ->getStateUsing(fn (Pesanan $record) => $record->detailPesanans()->whereNotNull('foto_sebelum')->exists())
                    ->trueIcon('heroicon-o-camera')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('detail_pesanans_count')
                    ->counts('detailPesanans')
                    ->label('Jumlah Item')
                    ->sortable(),

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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DetailPesanansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
