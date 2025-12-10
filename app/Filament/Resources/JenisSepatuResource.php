<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisSepatuResource\Pages;
use App\Filament\Resources\JenisSepatuResource\RelationManagers;
use App\Models\Jenis_Sepatu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisSepatuResource extends Resource
{
    protected static ?string $model = Jenis_Sepatu::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Jenis Sepatu';

    protected static ?string $modelLabel = 'Jenis Sepatu';

    protected static ?string $pluralModelLabel = 'Jenis Sepatu';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('nama_jenis')
                            ->label('Nama Jenis')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Sneakers, Leather Shoes, Boots'),

                        Forms\Components\TextInput::make('merek')
                            ->label('Merek')
                            ->maxLength(255)
                            ->placeholder('Contoh: Nike, Adidas, Clark'),

                        Forms\Components\TextInput::make('bahan')
                            ->label('Bahan')
                            ->maxLength(255)
                            ->placeholder('Contoh: Leather, Canvas, Mesh'),

                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->maxLength(65535)
                            ->placeholder('Deskripsi tambahan tentang jenis sepatu ini')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_jenis')
                    ->label('Nama Jenis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('merek')
                    ->label('Merek')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('bahan')
                    ->label('Bahan')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Status')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('detail_pesanans_count')
                    ->label('Digunakan')
                    ->counts('detailPesanans')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                    Tables\Actions\Action::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Jenis_Sepatu $record) => $record->update(['is_active' => true]))
                        ->visible(fn (Jenis_Sepatu $record) => !$record->is_active),

                    Tables\Actions\Action::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Jenis_Sepatu $record) => $record->update(['is_active' => false]))
                        ->visible(fn (Jenis_Sepatu $record) => $record->is_active)
                        ->requiresConfirmation(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('activateSelected')
                        ->label('Aktifkan yang dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    Tables\Actions\BulkAction::make('deactivateSelected')
                        ->label('Nonaktifkan yang dipilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->requiresConfirmation(),
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
            'index' => Pages\ListJenisSepatus::route('/'),
            'create' => Pages\CreateJenisSepatu::route('/create'),
            'edit' => Pages\EditJenisSepatu::route('/{record}/edit'),
        ];
    }
}
