<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\LaporanKerusakan;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pembayarans = Pembayaran::where('user_id', $user->id)
        ->orderBy('created_at', 'desc',)->get();

        $laporanrans = laporanKerusakan::where('user_id', $user->id)
        ->orderBy('created_at', 'desc',)->get();

        return view('user.riwayat', compact('user', 'pembayarans', 'laporans'));

    }

}
