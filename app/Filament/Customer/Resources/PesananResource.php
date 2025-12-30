<?php
// app/Filament/Customer/Resources/PesananResource.php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\PesananResource\Pages;
use App\Filament\Customer\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use App\Models\Layanan;
use App\Models\Jenis_Sepatu;
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
                    ->label('Tanggal Pesanan')
                    ->disabled()
                    ->dehydrated(),

                Forms\Components\Select::make('metode_pengantaran')
                    ->label('Metode Pengantaran')
                    ->options([
                        'drop_off' => 'Drop Off',
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                    ])
                    ->default('drop_off')
                    ->required()
                    ->reactive(),

                Forms\Components\Textarea::make('alamat_pengantaran')
                    ->label('Alamat Pengantaran')
                    ->maxLength(65535)
                    ->requiredIf('metode_pengantaran', 'delivery')
                    ->visible(fn (Forms\Get $get) => $get('metode_pengantaran') === 'delivery')
                    ->columnSpanFull(),

                Forms\Components\Repeater::make('detail_pesanans')
                    ->label('Pilih Layanan')
                    ->relationship('detailPesanans')
                    ->reactive()
                    ->schema([
                        Forms\Components\Select::make('layanan_id')
                            ->label('Layanan')
                            ->options(Layanan::active()->get()->mapWithKeys(function ($layanan) {
                                return [$layanan->id => $layanan->nama_layanan . ' - ' . $layanan->formatted_price];
                            }))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state) {
                                    $layanan = Layanan::find($state);
                                    if ($layanan) {
                                        $set('harga_satuan', $layanan->harga_layanan);
                                        // Calculate subtotal
                                        $jumlah = $get('jumlah_pasang') ?? 1;
                                        $hargaSatuan = $layanan->harga_layanan;
                                        $biayaTambahan = $get('biaya_tambahan') ?? 0;
                                        $set('subtotal', ($hargaSatuan * $jumlah) + $biayaTambahan);
                                    }
                                }
                            })
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('jenis_sepatu_id')
                            ->label('Jenis Sepatu')
                            ->options(Jenis_Sepatu::where('is_active', true)->get()->mapWithKeys(function ($jenis) {
                                return [$jenis->id => $jenis->nama_jenis . ' - ' . $jenis->merek];
                            }))
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('jumlah_pasang')
                            ->label('Jumlah Pasang')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $layananId = $get('layanan_id');
                                if ($layananId && $state) {
                                    $layanan = Layanan::find($layananId);
                                    if ($layanan) {
                                        $hargaSatuan = $layanan->harga_layanan;
                                        $biayaTambahan = $get('biaya_tambahan') ?? 0;
                                        $set('subtotal', ($hargaSatuan * $state) + $biayaTambahan);
                                    }
                                }
                            }),

                        Forms\Components\Select::make('kondisi_sepatu')
                            ->label('Kondisi Sepatu')
                            ->options([
                                'ringan' => 'Ringan',
                                'sedang' => 'Sedang',
                                'berat' => 'Berat',
                            ])
                            ->default('ringan')
                            ->required(),

                        Forms\Components\TextInput::make('harga_satuan')
                            ->label('Harga Satuan')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->default(0),

                        Forms\Components\TextInput::make('biaya_tambahan')
                            ->label('Biaya Tambahan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $layananId = $get('layanan_id');
                                $jumlah = $get('jumlah_pasang') ?? 1;
                                if ($layananId) {
                                    $layanan = Layanan::find($layananId);
                                    if ($layanan) {
                                        $hargaSatuan = $layanan->harga_layanan;
                                        $biayaTambahan = $state ?? 0;
                                        $set('subtotal', ($hargaSatuan * $jumlah) + $biayaTambahan);
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->default(0),

                        Forms\Components\Textarea::make('catatan_khusus')
                            ->label('Catatan Khusus')
                            ->maxLength(65535)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto_sebelum')
                            ->label('Foto Sepatu (Sebelum)')
                            ->image()
                            ->disk('public')
                            ->directory('sepatu-sebelum')
                            ->imageEditor()
                            ->maxSize(5120) // 5MB
                            ->helperText('Upload foto kondisi sepatu sebelum dicuci (maks 5MB)')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->defaultItems(1)
                    ->minItems(1)
                    ->collapsible()
                    ->itemLabel(function (array $state): ?string {
                        if (empty($state['layanan_id'])) {
                            return 'Layanan Baru';
                        }

                        $layanan = Layanan::find($state['layanan_id']);
                        if (!$layanan) {
                            return 'Layanan Tidak Ditemukan';
                        }

                        return $layanan->nama_layanan . ' (' . ($state['jumlah_pasang'] ?? 1) . ' pasang)';
                    })
                    ->addActionLabel('Tambah Layanan')
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('total_harga_display')
                    ->label('Total Harga')
                    ->content(function (Forms\Get $get) {
                        $details = $get('detail_pesanans') ?? [];
                        $total = 0;
                        foreach ($details as $detail) {
                            $total += $detail['subtotal'] ?? 0;
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),

                Forms\Components\Hidden::make('total_harga')
                    ->default(0)
                    ->dehydrated()
                    ->afterStateHydrated(function (Forms\Components\Hidden $component, $state, Forms\Get $get) {
                        // Calculate total from detail_pesanans
                        $details = $get('detail_pesanans') ?? [];
                        $total = 0;
                        foreach ($details as $detail) {
                            $total += $detail['subtotal'] ?? 0;
                        }
                        $component->state($total);
                    }),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan Pesanan')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\Hidden::make('status')
                    ->default('pending')
                    ->dehydrated(),
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

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Estimasi Selesai')
                    ->date()
                    ->placeholder('Belum ditentukan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('formatted_total')
                    ->label('Total')
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
                        ->url(fn (Pesanan $record) => route('filament.customer.resources.pembayarans.create') . '?pesanan_id=' . $record->id)
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
                        ->label('Invoice')
                        ->icon('heroicon-o-printer')
                        ->url(fn (Pesanan $record) => '#')
                        ->openUrlInNewTab()
                        ->visible(false), // Disabled until route is created
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
            RelationManagers\DetailPesanansRelationManager::class,
        ];
    }

    protected static bool $shouldRegisterNavigation = true;

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate total_harga from detail_pesanans
        $details = $data['detail_pesanans'] ?? [];
        $total = 0;
        foreach ($details as $detail) {
            $total += $detail['subtotal'] ?? 0;
        }
        $data['total_harga'] = $total;

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Calculate total_harga from detail_pesanans
        $details = $data['detail_pesanans'] ?? [];
        $total = 0;
        foreach ($details as $detail) {
            $total += $detail['subtotal'] ?? 0;
        }
        $data['total_harga'] = $total;

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'view' => Pages\ViewPesanan::route('/{record}'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
