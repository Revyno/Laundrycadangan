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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pesanan_id')
                    ->label('Pesanan')
                    ->relationship('pesanan', 'kode_pesanan')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabled(fn ($context) => $context === 'edit')
                    ->dehydrated(),

                Forms\Components\DatePicker::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(0),

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
                    ])
                    ->default('pending')
                    ->required()
                    ->disabled(fn ($context) => $context === 'create'),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
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
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
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
