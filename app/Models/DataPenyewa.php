<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenyewa extends Model
{
    protected $table = 'data_penyewas';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'kamar',
        'checkin',
    ];
}
