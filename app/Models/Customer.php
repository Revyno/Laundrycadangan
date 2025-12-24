<?php
// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'total_points',
        'membership_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'total_points' => 'integer',
    ];

    // Membership constants
    const MEMBERSHIP_REGULAR = 'regular';
    const MEMBERSHIP_SILVER = 'silver';
    const MEMBERSHIP_GOLD = 'gold';
    const MEMBERSHIP_PLATINUM = 'platinum';

    // Cek membership level
    public function isRegular(): bool
    {
        return $this->membership_level === self::MEMBERSHIP_REGULAR;
    }

    public function isSilver(): bool
    {
        return $this->membership_level === self::MEMBERSHIP_SILVER;
    }

    public function isGold(): bool
    {
        return $this->membership_level === self::MEMBERSHIP_GOLD;
    }

    public function isPlatinum(): bool
    {
        return $this->membership_level === self::MEMBERSHIP_PLATINUM;
    }

    // Relationships
    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class);
    }


    public function canAccessFilament(): bool
    {
        return true; // Customer bisa akses panel customer
    }
}
