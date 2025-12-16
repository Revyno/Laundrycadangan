<?php

namespace App\Filament\Customer\Resources\ProfileResource\Pages;

use App\Filament\Customer\Resources\ProfileResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    // Override untuk handle password change
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $customer = $this->record;

        // Handle password change jika diisi
        if (!empty($data['new_password'])) {
            $data['password'] = Hash::make($data['new_password']);
        }

        // Hapus field password dari data array
        unset($data['current_password']);
        unset($data['new_password']);
        unset($data['new_password_confirmation']);

        return $data;
    }

    // Set title sesuai nama customer
    public function getTitle(): string
    {
        return 'Edit Profil - ' . $this->record->name;
    }

    // Redirect setelah update
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    // Success notification
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Profil berhasil diperbarui';
    }

    // Hapus action delete
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->hidden(), // Sembunyikan delete action
        ];
    }

    // Policy untuk authorize hanya edit diri sendiri
    public function mount(int|string $record): void
    {
        // Pastikan customer hanya bisa edit profile sendiri
        if ($record != auth('customer')->id()) {
            abort(403, 'Anda hanya bisa mengedit profil sendiri.');
        }

        parent::mount($record);
    }
}
