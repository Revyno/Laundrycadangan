<?php

namespace App\Notifications;

use App\Models\Pesanan;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusUpdated
{
    use Queueable;

    public Pesanan $order;
    public string $oldStatus;
    public string $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pesanan $order, string $oldStatus, string $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Send the notification.
     */
    public function send()
    {
        $statusLabels = [
            'pending' => 'Pending',
            'in_process' => 'Sedang Diproses',
            'completed' => 'Selesai',
            'ready' => 'Siap Diambil',
            'delivered' => 'Sudah Dikirim',
            'cancelled' => 'Dibatalkan',
        ];

        $oldStatusLabel = $statusLabels[$this->oldStatus] ?? ucfirst(str_replace('_', ' ', $this->oldStatus));
        $newStatusLabel = $statusLabels[$this->newStatus] ?? ucfirst(str_replace('_', ' ', $this->newStatus));

        FilamentNotification::make()
            ->title('Status Pesanan Diperbarui')
            ->body("Status pesanan {$this->order->kode_pesanan} berubah dari {$oldStatusLabel} menjadi {$newStatusLabel}")
            ->icon('heroicon-o-arrow-path')
            ->color('info')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.customer.resources.pesanans.view', $this->order))
                    ->markAsRead(),
            ])
            ->sendToDatabase($this->getRecipients());
    }

    /**
     * Get notification recipients.
     */
    protected function getRecipients()
    {
        return collect([$this->order->customer]);
    }
}