<?php

namespace App\Filament\Customer\Resources\ProfileResource\Pages;

use App\Filament\Customer\Resources\ProfileResource;
use Filament\Resources\Pages\Page;

class ListProfiles extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.resources.profile-resource.pages.list-profiles';

    public function mount(): void
    {
        // Redirect langsung ke edit profile
        redirect()->to(ProfileResource::getUrl('edit', ['record' => auth('customer')->id()]))->send();
    }
}
