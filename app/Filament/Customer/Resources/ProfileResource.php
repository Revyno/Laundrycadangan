<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\ProfileResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationLabel = 'Profile';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $slug = 'profile';

    // Hanya tampilkan di navigation jika ada user login
    public static function shouldRegisterNavigation(): bool
    {
        return auth('customer')->check();
    }


    public static function getNavigationUrl(): string
    {
        return self::getUrl('edit', ['record' => auth('customer')->id()]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Alamat')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->maxLength(1000),
                    ]),

                Forms\Components\Section::make('Keanggotaan')
                    ->schema([
                        Forms\Components\TextInput::make('membership_level')
                            ->label('Level Keanggotaan')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('total_points')
                            ->label('Total Poin')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])->columns(2),

                Forms\Components\Section::make('Ubah Password')
                    ->schema([
                        Forms\Components\TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->rule('current_password:customer'),

                        Forms\Components\TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->minLength(8)
                            ->rules(['confirmed']),

                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->dehydrated(false),
                    ])->columns(2),
            ]);
    }

    // Hapus method table() karena tidak butuh tabel/list
    // public static function table(Table $table): Table
    // {
    //     // Tidak perlu karena hanya edit profile sendiri
    // }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
