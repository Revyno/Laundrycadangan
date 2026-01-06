<?php

namespace App\Notifications;

use App\Models\Layanan;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceCreated
{
    use Queueable;

    public Layanan $service;

    /**
     * Create a new notification instance.
     */
    public function __construct(Layanan $service)
    {
        $this->service = $service;
    }

    /**
     * Send the notification.
     */
    public function send()
    {
        $categoryLabels = [
            'basic' => 'Basic Clean',
            'premium' => 'Premium Clean',
            'deep' => 'Deep Clean',
            'unyellowing' => 'Unyellowing',
            'repaint' => 'Repaint',
            'repair' => 'Repair',
        ];

        $categoryLabel = $categoryLabels[$this->service->kategori_layanan] ?? ucfirst($this->service->kategori_layanan);

        FilamentNotification::make()
            ->title('Layanan Baru Ditambahkan')
            ->body("Layanan '{$this->service->nama_layanan}' ({$categoryLabel}) telah ditambahkan ke sistem")
            ->icon('heroicon-o-sparkles')
            ->color('primary')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Layanan')
                    ->url(route('filament.admin.resources.layanans.edit', $this->service))
                    ->markAsRead(),
            ])
            ->sendToDatabase($this->getRecipients());
    }

    /**
     * Get notification recipients.
     */
    protected function getRecipients()
    {
        return \App\Models\User::whereIn('role', ['admin', 'super_admin'])->get();
    }
}