<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Laporan_laundrie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Pembayaran';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 3;

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
                    ->disabled(fn ($context) => $context === 'create')
                    ->reactive(),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->disk('public')
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

                Forms\Components\Hidden::make('user_id')
                    ->label('Admin')
                    ->default(Auth::id())
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pesanan.kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('pesanan.customer.name')
                    ->label('Customer')
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
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                        'refund' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->square()
                    ->defaultImageUrl(url('/images/default-service.png'))
                    ->disk('public')
                    ->visibility('public')
                    ->size(50)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Dikonfirmasi Oleh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refund' => 'Refund',
                    ]),

                Tables\Filters\SelectFilter::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer',
                        'ewallet' => 'E-Wallet',
                        'qris' => 'QRIS',
                        'debit' => 'Debit',
                        'credit' => 'Credit',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),

                    Tables\Actions\Action::make('confirm')
                        ->label('Konfirmasi Pembayaran')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Konfirmasi Pembayaran')
                        ->modalDescription('Apakah Anda yakin ingin mengkonfirmasi pembayaran ini? Pembayaran akan otomatis masuk ke laporan rekap.')
                        ->action(function (Pembayaran $record) {
                            $record->update([
                                'status_pembayaran' => 'paid',
                                'user_id' => Auth::id(),
                            ]);

                            // Auto-update laporan rekap
                            Laporan_laundrie::updateLaporanForPeriod($record->tanggal_pembayaran);

                            \Filament\Notifications\Notification::make()
                                ->title('Pembayaran Dikonfirmasi')
                                ->success()
                                ->body('Pembayaran berhasil dikonfirmasi dan telah masuk ke laporan rekap.')
                                ->send();
                        })
                        ->visible(fn (Pembayaran $record) => $record->status_pembayaran !== 'paid'),

                    Tables\Actions\Action::make('reject')
                        ->label('Tolak Pembayaran')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Tolak Pembayaran')
                        ->modalDescription('Apakah Anda yakin ingin menolak pembayaran ini?')
                        ->form([
                            Forms\Components\Textarea::make('alasan')
                                ->label('Alasan Penolakan')
                                ->required()
                                ->maxLength(65535),
                        ])
                        ->action(function (Pembayaran $record, array $data) {
                            $record->update([
                                'status_pembayaran' => 'pending',
                                'catatan' => ($record->catatan ? $record->catatan . "\n\n" : '') . 'Ditolak: ' . $data['alasan'],
                            ]);

                            \Filament\Notifications\Notification::make()
                                ->title('Pembayaran Ditolak')
                                ->warning()
                                ->body('Pembayaran telah ditolak.')
                                ->send();
                        })
                        ->visible(fn (Pembayaran $record) => $record->status_pembayaran === 'pending'),

                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
