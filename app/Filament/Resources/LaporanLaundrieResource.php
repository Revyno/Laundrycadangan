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

                        Forms\Components\TextInput::make('total_pendapatan')
                            ->label('Total Pendapatan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        Forms\Components\TextInput::make('total_pengeluaran')
                            ->label('Total Pengeluaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        Forms\Components\TextInput::make('total_profit')
                            ->label('Total Profit')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->disabled(),

                        Forms\Components\TextInput::make('total_pesanan')
                            ->label('Total Pesanan')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('total_sepatu')
                            ->label('Total Sepatu (pasang)')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pesanan_selesai')
                            ->label('Pesanan Selesai')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pesanan_batal')
                            ->label('Pesanan Batal')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('layanan_terpopuler')
                            ->schema([
                                Forms\Components\TextInput::make('layanan')
                                    ->label('Nama Layanan')
                                    ->required(),

                                Forms\Components\TextInput::make('jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\TextInput::make('pendapatan')
                                    ->label('Pendapatan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ]),
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
