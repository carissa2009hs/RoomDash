<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_kamar',
        'status_bayar',
        'jatuh_tempo',
        'tagihan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
