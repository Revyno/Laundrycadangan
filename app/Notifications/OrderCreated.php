<?php

namespace App\Notifications;

use App\Models\Pesanan;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated
{
    use Queueable;

    public Pesanan $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pesanan $order)
    {
        $this->order = $order;
    }

    /**
     * Send the notification.
     */
    public function send()
    {
        FilamentNotification::make()
            ->title('Pesanan Baru Dibuat')
            ->body("Pesanan {$this->order->kode_pesanan} telah dibuat oleh {$this->order->customer->name}")
            ->icon('heroicon-o-shopping-bag')
            ->color('success')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.admin.resources.pesanans.edit', $this->order))
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