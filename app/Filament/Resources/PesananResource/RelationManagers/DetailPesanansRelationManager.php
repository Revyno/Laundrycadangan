<?php

namespace App\Filament\Resources\PesananResource\RelationManagers;

use App\Models\Layanan;
use App\Models\Jenis_Sepatu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailPesanansRelationManager extends RelationManager
{
    protected static string $relationship = 'detailPesanans';

    protected static ?string $title = 'Detail Pesanan & Foto Sepatu';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('layanan_id')
                    ->label('Layanan')
                    ->options(Layanan::active()->get()->mapWithKeys(function ($layanan) {
                        return [$layanan->id => $layanan->nama_layanan . ' - ' . $layanan->formatted_price];
                    }))
                    ->required()
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
                    ->required()
                    ->minValue(1)
                    ->default(1),

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
                    ->required(),

                Forms\Components\TextInput::make('biaya_tambahan')
                    ->label('Biaya Tambahan')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

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
                    ->maxSize(5120)
                    ->helperText('Foto kondisi sepatu sebelum dicuci')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('foto_sesudah')
                    ->label('Foto Sepatu (Sesudah)')
                    ->image()
                    ->directory('sepatu-sesudah')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->helperText('Upload foto kondisi sepatu setelah dicuci (diisi oleh admin)')
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record !== null), // Hanya muncul saat edit
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('layanan.nama_layanan')
            ->columns([
                Tables\Columns\ImageColumn::make('foto_sebelum')
                    ->label('Foto Sebelum')
                    ->circular()
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(url('/images/default-shoe.png'))
                    ->size(80)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenisSepatu.nama_jenis')
                    ->label('Jenis Sepatu')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('jumlah_pasang')
                    ->label('Jumlah')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('kondisi_sepatu')
                    ->label('Kondisi')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->colors([
                        'success' => 'ringan',
                        'warning' => 'sedang',
                        'danger' => 'berat',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('foto_sesudah')
                    ->label('Foto Sesudah')
                    ->disk('public')
                    ->visibility('public')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-shoe.png'))
                    ->size(80)
                    ->toggleable()
                    ->visible(fn ($record) => !empty($record->foto_sesudah)),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kondisi_sepatu')
                    ->label('Kondisi Sepatu')
                    ->options([
                        'ringan' => 'Ringan',
                        'sedang' => 'Sedang',
                        'berat' => 'Berat',
                    ]),
            ])
            ->headerActions([
                // Tidak perlu create action karena detail dibuat dari customer
            ])
            ->actions([
                Tables\Actions\Action::make('view_photos')
                    ->label('Lihat Foto')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->modalHeading(fn ($record) => 'Foto Sepatu - ' . ($record->layanan->nama_layanan ?? 'N/A'))
                    ->modalContent(fn ($record) => view('filament.resources.pesanan-resource.relation-managers.detail-pesanan-photos', [
                        'record' => $record,
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->visible(fn ($record) => !empty($record->foto_sebelum) || !empty($record->foto_sesudah)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
