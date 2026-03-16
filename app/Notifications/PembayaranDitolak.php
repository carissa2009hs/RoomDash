<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Pembayaran;

class PembayaranDitolak extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public Pembayaran $pembayaran) {}

    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'judul' => 'Pembayaran Ditolak',
            'pesan' => 'Bukti bayar bulan' . $this->pembayaran->bulan . 'ditolak, silakan upload ulang!' ,
            'icon' => 'error',
            'link' => '/user/pembayaran',
        ];
    }
}

    