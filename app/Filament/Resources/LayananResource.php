<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                                'basic' => 'Basic Clean',
                                'premium' => 'Premium Clean',
                                'deep' => 'Deep Clean',
                                'unyellowing' => 'Unyellowing',
                                'repaint' => 'Repaint',
                                'repair' => 'Repair',
                            ])
                            ->default('basic')
                            ->required(),

                        Forms\Components\TextInput::make('harga_layanan')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('durasi')
                            ->label('Estimasi Waktu')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('durasi_hari')
                            ->label('Durasi (Hari)')
                            ->numeric()
                            ->default(1),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Layanan')
                            ->image()
                            ->directory('layanan-images')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Repeater::make('fitur')
                            ->schema([
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Nama fitur'),
                            ])
                            ->defaultItems(3)
                            ->columnSpanFull(),
                    ]),

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
                    ->colors([
                        'gray' => 'basic',
                        'blue' => 'premium',
                        'indigo' => 'deep',
                        'yellow' => 'unyellowing',
                        'purple' => 'repaint',
                        'red' => 'repair',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_layanan')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('durasi')
                    ->label('Estimasi'),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
        'index' => Pages\ListLayanans::route('/'),
        'create' => Pages\CreateLayanan::route('/create'),
        // 'view' => Pages\ViewLayanan::route('/{record}'),
        'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
