<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\LaporanKerusakan;
use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PembayaranDikonfirmasi;
use App\Notifications\PembayaranDitolak;
use App\Notifications\StatusLaporanDiupdate;

class UserController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();
    $penyewa = $user->penyewa;

    $totalLaporanAktif = LaporanKerusakan::where('user_id', $user->id)
                               ->where('status', 'Diproses')
                               ->count();
    
    $laporanTerakhir = LaporanKerusakan::where('user_id', $user->id)
                      ->orderBy('created_at', 'desc')
                      ->take(3)
                      ->get();
    
    $pembayaranTerbaru = Pembayaran::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

    $pembayaranTerakhir = Pembayaran::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

    $sisaHari = 0;
    if ($penyewa) {
        $sisaHari = (int) Carbon::now()->diffInDays(
            Carbon::parse($penyewa->jatuh_tempo), false
        );
    }

    return view('user.dashboard', compact(
        'user',
        'penyewa',
        'totalLaporanAktif',
        'laporanTerakhir',      
        'pembayaranTerakhir',  
        'sisaHari',
    ));
}

    public function pembayaran()
    {
        $pembayarans = Pembayaran::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.pembayaran', compact('pembayarans'));
    }

    public function laporan()
    {
        $laporans = LaporanKerusakan::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.laporan', compact('laporans'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_bayar', $filename, 'public');

            $pembayaran->update([
                'bukti_bayar' => $path,
                'status' => 'Menunggu Konfirmasi',
                'tanggal_bayar' => now(),
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prioritas' => 'required|in:Ringan,Sedang,Tinggi',
            'foto' => 'nullable|image|mimes:jpg,jpg,png|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'prioritas' => $request->prioritas,
            'status' => 'Menunggu',
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('laporan_foto', $filename, 'public');
            $data['foto'] = $path;
        }

        LaporanKerusakan::create($data);

        return back()->with('success', 'Laporan kerusakan berhasil dibuat!');
    }

    public function riwayat()
    {
        $pembayarans = Pembayaran::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $laporans = LaporanKerusakan::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.riwayat', compact('pembayarans', 'laporans'));
    }

    public function bacaNotif($id)
    {
        $notif = Auth::user()->notifications()->find($id);
        if ($notif) {
            $notif->markAsRead();
        }
        return back();
    }

    public function bacaSemuaNotif()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}