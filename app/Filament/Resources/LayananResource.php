<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(Auth::id()),

                        Forms\Components\TextInput::make('nama_layanan')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('kategori_layanan')
                            ->label('Kategori')
                            ->options([
                                'basic' => 'Basic Clean (Rp 50.000)',
                                'premium' => 'Premium Clean (Rp 100.000)',
                                'deep' => 'Deep Clean (Rp 150.000)',
                                'unyellowing' => 'Unyellowing (Rp 75.000)',
                                'repaint' => 'Repaint (Rp 200.000)',
                                'repair' => 'Repair (Rp 250.000)',
                            ])
                            ->default('basic')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                // Set durasi_hari otomatis berdasarkan kategori
                                $durasiHari = Layanan::DURASI_HARI_KATEGORI[$state] ?? 1;
                                $set('durasi_hari', $durasiHari);
                            }),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('durasi_hari')
                            ->label('Durasi (Hari)')
                            ->numeric()
                            ->default(1),
                    ])->columns(2),

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Layanan')
                    ->image()
                    ->directory('layanan-images')
                    ->imageEditor()
                    ->columnSpanFull(),

                Forms\Components\Card::make()
                    ->schema([
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
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-service.png')),

                Tables\Columns\TextColumn::make('nama_layanan')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('kategori_layanan')
                    ->label('Kategori')
                    ->formatStateUsing(fn ($record) => $record->getHargaLabelAttribute())
                    ->colors([
                        'gray' => 'basic',
                        'blue' => 'premium',
                        'indigo' => 'deep',
                        'yellow' => 'unyellowing',
                        'purple' => 'repaint',
                        'red' => 'repair',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_layanan')
                    ->label('Harga')
                    ->formatStateUsing(fn ($record) => $record->formatted_price)
                    ->sortable(),

                Tables\Columns\TextColumn::make('durasi_hari')
                    ->label('Durasi (Hari)')
                    ->suffix(' hari')
                    ->sortable(),

                Tables\Columns\TextColumn::make('detail_pesanans_count')
                    ->counts('detailPesanans')
                    ->label('Jumlah Pesanan')
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),

                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Dibuat Oleh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_layanan')
                    ->label('Filter Kategori')
                    ->options([
                        'basic' => 'Basic Clean',
                        'premium' => 'Premium Clean',
                        'deep' => 'Deep Clean',
                        'unyellowing' => 'Unyellowing',
                        'repaint' => 'Repaint',
                        'repair' => 'Repair',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}