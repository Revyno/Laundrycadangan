<?php

namespace App\Notifications;

use App\Models\Pembayaran;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentCreated
{
    use Queueable;

    public Pembayaran $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pembayaran $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Send the notification.
     */
    public function send()
    {
        $methodLabels = [
            'cash' => 'Tunai',
            'transfer' => 'Transfer',
            'ewallet' => 'E-Wallet',
            'qris' => 'QRIS',
            'debit' => 'Kartu Debit',
            'credit' => 'Kartu Kredit',
        ];

        $methodLabel = $methodLabels[$this->payment->metode_pembayaran] ?? ucfirst($this->payment->metode_pembayaran);

        FilamentNotification::make()
            ->title('Pembayaran Baru Diterima')
            ->body("Pembayaran sebesar Rp " . number_format($this->payment->jumlah_dibayar, 0, ',', '.') . " untuk pesanan {$this->payment->pesanan->kode_pesanan} telah diterima via {$methodLabel}")
            ->icon('heroicon-o-currency-dollar')
            ->color('success')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Pembayaran')
                    ->url(route('filament.admin.resources.pembayarans.edit', $this->payment))
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