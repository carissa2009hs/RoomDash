<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Pembayaran;

class PembayaranDikonfirmasi extends Notification
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
            'judul' => 'Pembayaran Dikonfirmasi',
            'pesan' => 'Pembayaran bulan' . $this->pembayaran->bulan . ' sebesar Rp ' . number_format($this->pembayaran->jumlah, 0, ', ',  '.'). ' telah dikonfirmasi! ',
            'icon' => 'success',
            'link' => '/user/pembayaran',
        ];
    }
}

    