<?php

namespace App\Filament\Customer\Resources\ProfileResource\Pages;

use App\Filament\Customer\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
