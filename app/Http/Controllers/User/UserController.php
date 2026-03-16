<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\LaporanKerusakan;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        $user     = Auth::user();
        $penyewa  = $user->penyewa;
        $sisaHari = (int) Carbon::now()->diffInDays($penyewa->jatuh_tempo, false);

        $pembayaranTerakhir = Pembayaran::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)->get();
        
        $laporanTerakhir = LaporanKerusakan::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)->get();
        
       $totalLaporanAktif = LaporanKerusakan::where('user_id', $user->id)
                                ->where('status', 'Diproses')
                                ->count();

        return view('user.dashboard', compact('user', 'penyewa', 'sisaHari', 'pembayaranTerakhir', 'laporanTerakhir', 'totalLaporanAktif'));
    }

    public function pembayaran()
    {
        $user        = Auth::user();
        $penyewa     = $user->penyewa;
        $pembayaranAktif = Pembayaran::firstOrCreate(
            [
                'user_id' => $user->id,
                'bulan'   => now()->translatedFormat('F Y'),
            ],
            [
                'jumlah' => $penyewa->tagihan,
                'status' => 'Belum Lunas',
            ]
        );
    
        $pembayarans = Pembayaran::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        return view('user.pembayaran', compact(
            'user', 'penyewa', 'pembayarans', 'pembayaranAktif'
        ));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayaran = Pembayaran::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $pembayaran->update([
            'bukti_bayar'   => $path,
            'status'        => 'Menunggu Konfirmasi',
            'tanggal_bayar' => now(),
        ]);

        return back()->with('success', 'Bukti bayar berhasil diupload!');
    }

    public function laporan()
    {
        $user     = Auth::user();
        $laporans = LaporanKerusakan::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('user.laporan', compact('user', 'laporans'));
    }

    public function storeLaporan(Request $request)
    {   
        
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan_foto', 'public');
        }

        $laporan = LaporanKerusakan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'prioritas' => $request->prioritas ?? 'Ringan',
            'foto'      => $fotoPath,
            'status'    => 'Menunggu',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function riwayat()
    {
        $user        = Auth::user();
        $pembayarans = Pembayaran::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')->get();
        $laporans    = LaporanKerusakan::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')->get();

        return view('user.riwayat', compact('user', 'pembayarans', 'laporans'));
    }

    public function bacaNotif($id)
    {
        $notif = auth()->user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return redirect($notif->data['link']);
    }

    public function bacaSemuaNotif()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}