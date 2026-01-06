<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanLaundrieResource\Pages;
use App\Filament\Resources\LaporanLaundrieResource\RelationManagers;
use App\Models\Laporan_laundrie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Pesanan;
use App\Models\Layanan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanLaundrieResource extends Resource
{
    protected static ?string $model = Laporan_laundrie::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $modelLabel = 'Laporan';

    protected static ?string $pluralModelLabel = 'Laporan Laundry';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(Auth::id())
                            ->dehydrated(),

                        Forms\Components\DatePicker::make('periode_awal')
                            ->label('Periode Awal')
                            ->required()
                            ->default(now()->startOfMonth()),

                        Forms\Components\DatePicker::make('periode_akhir')
                            ->label('Periode Akhir')
                            ->required()
                            ->default(now()->endOfMonth()),

                        Forms\Components\Placeholder::make('total_pendapatan_display')
                            ->label('Total Pendapatan (Otomatis)')
                            ->content(function ($get, $record) {
                                // If editing existing record, show current value
                                if ($record && $record->total_pendapatan) {
                                    return 'Rp ' . number_format($record->total_pendapatan, 0, ',', '.');
                                }

                                // For new records, calculate based on selected dates
                                $periodeAwal = $get('periode_awal');
                                $periodeAkhir = $get('periode_akhir');

                                if ($periodeAwal && $periodeAkhir) {
                                    $totalPendapatan = \Illuminate\Support\Facades\DB::table('pembayarans')
                                        ->join('pesanans', 'pembayarans.pesanan_id', '=', 'pesanans.id')
                                        ->where('pembayarans.status_pembayaran', 'paid')
                                        ->whereBetween('pembayarans.tanggal_pembayaran', [$periodeAwal, $periodeAkhir])
                                        ->sum('pembayarans.jumlah_dibayar');

                                    return 'Rp ' . number_format($totalPendapatan, 0, ',', '.');
                                }

                                return 'Rp 0 (Pilih periode untuk kalkulasi otomatis)';
                            }),

                        Forms\Components\Hidden::make('total_pendapatan')
                            ->default(0),

                        Forms\Components\TextInput::make('total_pengeluaran')
                            ->label('Total Pengeluaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        Forms\Components\Placeholder::make('total_profit_display')
                            ->label('Total Profit (Otomatis)')
                            ->content(function ($get, $record) {
                                if ($record && isset($record->total_profit)) {
                                    return 'Rp ' . number_format($record->total_profit, 0, ',', '.');
                                }

                                $pendapatan = $get('total_pendapatan') ?? 0;
                                $pengeluaran = $get('total_pengeluaran') ?? 0;
                                $profit = $pendapatan - $pengeluaran;

                                return 'Rp ' . number_format($profit, 0, ',', '.');
                            }),

                        Forms\Components\Hidden::make('total_profit')
                            ->default(0),

                        Forms\Components\Placeholder::make('total_pesanan_display')
                            ->label('Total Pesanan (Otomatis)')
                            ->content(function ($get, $record) {
                                if ($record && isset($record->total_pesanan)) {
                                    return $record->total_pesanan . ' pesanan';
                                }

                                $periodeAwal = $get('periode_awal');
                                $periodeAkhir = $get('periode_akhir');

                                if ($periodeAwal && $periodeAkhir) {
                                    $totalPesanan = \App\Models\Pesanan::whereBetween('created_at', [$periodeAwal, $periodeAkhir])->count();
                                    return $totalPesanan . ' pesanan';
                                }

                                return '0 pesanan';
                            }),

                        Forms\Components\Hidden::make('total_pesanan')
                            ->default(0),

                        Forms\Components\Placeholder::make('total_sepatu_display')
                            ->label('Total Sepatu (Otomatis)')
                            ->content(function ($get, $record) {
                                if ($record && isset($record->total_sepatu)) {
                                    return $record->total_sepatu . ' pasang';
                                }

                                $periodeAwal = $get('periode_awal');
                                $periodeAkhir = $get('periode_akhir');

                                if ($periodeAwal && $periodeAkhir) {
                                    $totalSepatu = \Illuminate\Support\Facades\DB::table('detail_pesanans')
                                        ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
                                        ->whereBetween('pesanans.created_at', [$periodeAwal, $periodeAkhir])
                                        ->sum('detail_pesanans.jumlah_pasang');

                                    return $totalSepatu . ' pasang';
                                }

                                return '0 pasang';
                            }),

                        Forms\Components\Hidden::make('total_sepatu')
                            ->default(0),

                        Forms\Components\Placeholder::make('pesanan_selesai_display')
                            ->label('Pesanan Selesai (Otomatis)')
                            ->content(function ($get, $record) {
                                if ($record && isset($record->pesanan_selesai)) {
                                    return $record->pesanan_selesai . ' pesanan';
                                }

                                $periodeAwal = $get('periode_awal');
                                $periodeAkhir = $get('periode_akhir');

                                if ($periodeAwal && $periodeAkhir) {
                                    $selesai = \App\Models\Pesanan::whereBetween('created_at', [$periodeAwal, $periodeAkhir])
                                        ->whereIn('status', ['completed', 'delivered'])
                                        ->count();

                                    return $selesai . ' pesanan';
                                }

                                return '0 pesanan';
                            }),

                        Forms\Components\Hidden::make('pesanan_selesai')
                            ->default(0),

                        Forms\Components\Placeholder::make('pesanan_batal_display')
                            ->label('Pesanan Batal (Otomatis)')
                            ->content(function ($get, $record) {
                                if ($record && isset($record->pesanan_batal)) {
                                    return $record->pesanan_batal . ' pesanan';
                                }

                                $periodeAwal = $get('periode_awal');
                                $periodeAkhir = $get('periode_akhir');

                                if ($periodeAwal && $periodeAkhir) {
                                    $batal = \App\Models\Pesanan::whereBetween('created_at', [$periodeAwal, $periodeAkhir])
                                        ->where('status', 'cancelled')
                                        ->count();

                                    return $batal . ' pesanan';
                                }

                                return '0 pesanan';
                            }),

                        Forms\Components\Hidden::make('pesanan_batal')
                            ->default(0),
                    ])->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('periode_awal')
                    ->label('Periode Awal')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('periode_akhir')
                    ->label('Periode Akhir')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_pendapatan')
                    ->label('Pendapatan')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_pengeluaran')
                    ->label('Pengeluaran')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_profit')
                    ->label('Profit')
                    ->money('IDR')
                    ->color(fn ($record) => $record->total_profit >= 0 ? 'success' : 'danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_pesanan')
                    ->label('Total Pesanan')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pesanan_selesai')
                    ->label('Selesai')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('periode')
                    ->form([
                        Forms\Components\DatePicker::make('periode_awal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('periode_akhir')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['periode_awal'], fn ($q, $date) => $q->whereDate('periode_awal', '>=', $date))
                            ->when($data['periode_akhir'], fn ($q, $date) => $q->whereDate('periode_akhir', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                    Tables\Actions\Action::make('generate')
                        ->label('Generate Laporan')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                        ->action(function (Laporan_laundrie $record) {
                            self::generateLaporanData($record);
                        }),

                    // Tables\Actions\Action::make('print')
                    //     ->label('Cetak')
                    //     ->icon('heroicon-o-printer')
                    //     ->color('gray')
                    //     ->url(fn (Laporan_laundrie $record) => route('admin.laporan.print', $record))
                    //     ->openUrlInNewTab(),
                    Tables\Actions\Action::make('print')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn (Laporan_laundrie $record) => static::getUrl('print', ['record' => $record->id]))
                    ->openUrlInNewTab(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function generateLaporanData(Laporan_laundrie $laporan)
    {
        // Hitung data dari database
        $pesanan = Pesanan::whereBetween('created_at', [$laporan->periode_awal, $laporan->periode_akhir])->get();

        // Total pendapatan dari pembayaran yang sudah dikonfirmasi (status = 'paid')
        $totalPendapatan = DB::table('pembayarans')
            ->join('pesanans', 'pembayarans.pesanan_id', '=', 'pesanans.id')
            ->where('pembayarans.status_pembayaran', 'paid')
            ->whereBetween('pembayarans.tanggal_pembayaran', [$laporan->periode_awal, $laporan->periode_akhir])
            ->sum('pembayarans.jumlah_dibayar');

        // Total pesanan
        $totalPesanan = $pesanan->count();

        // Total sepatu
        $totalSepatu = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->whereBetween('pesanans.created_at', [$laporan->periode_awal, $laporan->periode_akhir])
            ->sum('detail_pesanans.jumlah_pasang');

        // Pesanan selesai
        $pesananSelesai = $pesanan->whereIn('status', ['completed', 'delivered'])->count();

        // Pesanan batal
        $pesananBatal = $pesanan->where('status', 'cancelled')->count();

        // Layanan terpopuler (dari pesanan dengan pembayaran yang sudah dikonfirmasi)
        $layananTerpopuler = DB::table('detail_pesanans')
            ->join('layanans', 'detail_pesanans.layanan_id', '=', 'layanans.id')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id')
            ->where('pembayarans.status_pembayaran', 'paid')
            ->whereBetween('pembayarans.tanggal_pembayaran', [$laporan->periode_awal, $laporan->periode_akhir])
            ->select(
                'layanans.nama_layanan',
                DB::raw('SUM(detail_pesanans.jumlah_pasang) as total_pasang'),
                DB::raw('SUM(detail_pesanans.subtotal) as total_pendapatan')
            )
            ->groupBy('layanans.id', 'layanans.nama_layanan')
            ->orderByDesc('total_pasang')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'layanan' => $item->nama_layanan,
                    'jumlah' => $item->total_pasang,
                    'pendapatan' => $item->total_pendapatan,
                ];
            })
            ->toArray();

        // Update laporan
        $laporan->update([
            'total_pendapatan' => $totalPendapatan,
            'total_pengeluaran' => $laporan->total_pengeluaran, // Biarkan sesuai input admin
            'total_profit' => $totalPendapatan - $laporan->total_pengeluaran,
            'total_pesanan' => $totalPesanan,
            'total_sepatu' => $totalSepatu,
            'pesanan_selesai' => $pesananSelesai,
            'pesanan_batal' => $pesananBatal,
            'layanan_terpopuler' => $layananTerpopuler,
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
            // 'index' => Pages\ListLaporanLaundries::route('/'),
            // 'create' => Pages\CreateLaporanLaundrie::route('/create'),
            // 'edit' => Pages\EditLaporanLaundrie::route('/{record}/edit'),
            'index' => Pages\ListLaporanLaundries::route('/'),
            'create' => Pages\CreateLaporanLaundrie::route('/create'),
            'edit' => Pages\EditLaporanLaundrie::route('/{record}/edit'),
            'print' => Pages\PrintLaporan::route('/{record}/print'),
        ];
    }

}