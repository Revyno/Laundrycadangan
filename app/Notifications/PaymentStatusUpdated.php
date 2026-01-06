<?php

namespace App\Notifications;

use App\Models\Pembayaran;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentStatusUpdated
{
    use Queueable;

    public Pembayaran $payment;
    public string $oldStatus;
    public string $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pembayaran $payment, string $oldStatus, string $newStatus)
    {
        $this->payment = $payment;
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
            'partial' => 'Sebagian',
            'paid' => 'Lunas',
            'refund' => 'Refund',
            'failed' => 'Gagal',
        ];

        $oldStatusLabel = $statusLabels[$this->oldStatus] ?? ucfirst($this->oldStatus);
        $newStatusLabel = $statusLabels[$this->newStatus] ?? ucfirst($this->newStatus);

        FilamentNotification::make()
            ->title('Status Pembayaran Diperbarui')
            ->body("Status pembayaran untuk pesanan {$this->payment->pesanan->kode_pesanan} berubah dari {$oldStatusLabel} menjadi {$newStatusLabel}")
            ->icon('heroicon-o-banknotes')
            ->color('warning')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Pembayaran')
                    ->url(route('filament.customer.resources.pembayarans.index'))
                    ->markAsRead(),
            ])
            ->sendToDatabase($this->getRecipients());
    }

    /**
     * Get notification recipients.
     */
    protected function getRecipients()
    {
        return collect([$this->payment->pesanan->customer]);
    }
}