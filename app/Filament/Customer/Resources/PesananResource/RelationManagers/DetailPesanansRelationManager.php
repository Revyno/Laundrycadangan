<?php

namespace App\Filament\Customer\Resources\PesananResource\RelationManagers;

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
                // Form is read-only for customers
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
                // No create action for customers
            ])
            ->actions([
                Tables\Actions\Action::make('view_photos')
                    ->label('Lihat Foto')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->modalHeading(fn ($record) => 'Foto Sepatu - ' . ($record->layanan->nama_layanan ?? 'N/A'))
                    ->modalContent(fn ($record) => view('filament.customer.resources.pesanan-resource.relation-managers.detail-pesanan-photos', [
                        'record' => $record,
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->visible(fn ($record) => !empty($record->foto_sebelum) || !empty($record->foto_sesudah)),
                // No edit/delete actions for customers
            ])
            ->bulkActions([
                // No bulk actions for customers
            ])
            ->defaultSort('created_at', 'desc');
    }
}
