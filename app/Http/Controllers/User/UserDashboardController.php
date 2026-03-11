<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $penyewa  = $user->penyewa;
        $sisaHari = Carbon::now()->diffInDays($penyewa->jatuh_tempo, false);

        return view('user.dashboard', compact('user', 'penyewa', 'sisaHari'));
    }
}