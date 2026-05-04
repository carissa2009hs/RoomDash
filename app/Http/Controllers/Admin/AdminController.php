<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Pembayaran;
use App\Models\LaporanKerusakan;
use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\PembayaranDikonfirmasi;
use App\Notifications\PembayaranDitolak;
use App\Notifications\StatusLaporanDiupdate;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPenyewa  = User::count();
        $totalLunas    = Pembayaran::where('status', 'Lunas')->count();
        $totalTunggakan = Pembayaran::where('status', 'Belum Lunas')->count();
        $totalLaporan  = LaporanKerusakan::where('status', 'Menunggu')->count();
        $totalMenunggu = Pembayaran::where('status', 'Menunggu Konfirmasi')->count();
        $bulanIni = now()->translatedFormat('F Y');
        $totalJatuhTempo = Penyewa::where('jatuh_tempo', '<=', now()->addDays(7))
                           ->where('status_bayar', '!=', 'Lunas')
                           ->count();
        $laporanTerbaru = LaporanKerusakan::with('user')->where('status', 'Menunggu')
                          ->orderBy('created_at', 'desc')
                          ->take(4)
                          ->get();
        $pembayaranTerbaru = Pembayaran::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalPenyewa',
            'totalLunas',
            'totalTunggakan',
            'totalLaporan',
            'totalMenunggu',
            'totalJatuhTempo',
            'laporanTerbaru',
            'pembayaranTerbaru',
        ));
    }

    public function dataPenyewa()
    {
        $penyewas = Penyewa::all();
        return view('admin.data-penyewa', compact('penyewas'));
    }

    public function pembayaran()
    {
        $pembayarans = Pembayaran::with('user')->orderBy('created_at', 'desc')->get();

        $totalTerkumpul = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        $totalMenunggu = Pembayaran::where('status', 'Menunggu Konfirmasi')->count();
        $totalTelat = Pembayaran::where('status', 'Belum Lunas')->count();
        $totalLunas = Pembayaran::where('status', 'Lunas')->count();

        return view('admin.pembayaran', compact(
            'pembayarans',
            'totalTerkumpul',
            'totalMenunggu',
            'totalTelat',
            'totalLunas',
        ));
    }

    public function laporan()
    {
        $laporans = LaporanKerusakan::with('user.penyewa')->orderBy('created_at', 'desc')->get();

        $laporanAktif = $laporans->whereIn('status', ['Menunggu', 'Diproses']);
        $laporanBaru  = $laporans->where('status', 'Menunggu');
        $laporanSelesai = $laporans->where('status', 'Selesai');

        return view('admin.laporan', compact(
            'laporans',
            'laporanAktif',
            'laporanBaru',
            'laporanSelesai',
        ));
    }

    public function konfirmasiPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'Lunas']);
        $pembayaran->update(['status' => 'Lunas']);
        if ($pembayaran->user->penyewa) {
            $pembayaran->user->penyewa->update(['status_bayar' => 'Lunas']);
        }
        $pembayaran->user->notify(new PembayaranDikonfirmasi($pembayaran));
        
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function tolakPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status' => 'Belum Lunas',
            'bukti_bayar' => null,
        ]);

        if ($pembayaran->user->penyewa) {
            $pembayaran->user->penyewa->update(['status_bayar' => 'Belum Lunas']);
        }

    $pembayaran->user->notify(new PembayaranDitolak($pembayaran));

    return back()->with('success', 'Pembayaran ditolak!');
}

    public function updateStatusLaporan(Request $request, $id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        $laporan->update(['status' => $request->status]);
        $laporan->user->notify(new StatusLaporanDiupdate($laporan));

        return back()->with('success', 'Status laporan berhasil diupdate!');
    }

    public function notifCount()
    {
        return response()->json([
            'laporan' => LaporanKerusakan::where('status', 'Menunggu')->count(),
            'pembayaran' => Pembayaran::where('status', 'Menunggu Konfirmasi')->count(),
        ]);
    }

    public function ingatkanPembayaran($id)
    {
        $pembayaran = Pembayaran::with('user.penyewa')->findOrFail($id);
        $user = $pembayaran->user;
        $noHp = $user->no_hp;

        if (!$noHp) {
            return back()->with('error', 'Nomor Hp penyewa belum diisi');
        }
        $pesan = "Halo *{$user->name}*, pembayaran sewa kamar {$user->penyewa->nomor_kamar} bulan {$pembayaran->bulan} sebesar Rp " . number_format($pembayaran->jumlah, 0, ',', '.') . "Segera lakukan pembayaran ya!";

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $noHp,
            'message' => $pesan
        ]);
        return back()->with('success', 'Pesan WA berhasil dikirim ke ' . $user->name);
    }
}