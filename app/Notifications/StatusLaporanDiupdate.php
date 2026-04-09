<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\LaporanKerusakan;

class StatusLaporanDiupdate extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public LaporanKerusakan $laporan) {}

    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toDatabase($notifiable)
    {
        return [
            'judul' => 'Status Laporan Diupdate',
            'pesan' => 'Laporan"' . $this->laporan->judul . '"sekarang berstatus' . $this->laporan->status,
            'icon' => 'info',
            'link' => '/user/laporan',
        ];
    }
}

    