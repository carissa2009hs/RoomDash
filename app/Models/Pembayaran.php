<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'bulan',
        'jumlah',
        'status',
        'bukti_bayar',
        'tanggal_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
