<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

        return view('admin.dashboard', compact(
            'totalPenyewa',
            'totalLunas',
            'totalTunggakan',
            'totalLaporan'
        ));
    }

    public function dataPenyewa()
    {
        $penyewas = Penyewa::with('user')->get();
        return view('admin.data-penyewa', compact('penyewas'));
    }

    public function pembayaran()
    {
        $pembayarans = Pembayaran::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pembayaran', compact('pembayarans'));
    }

    public function laporan()
    {
        $laporans = LaporanKerusakan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan', compact('laporans'));
    }

    // Admin konfirmasi pembayaran
    public function konfirmasiPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'Lunas']);
        $pembayaran->update(['status' => 'Lunas']);
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

    $pembayaran->user->notify(new PembayaranDitolak($pembayaran));

    return back()->with('success', 'Pembayaran ditolak!');
}

    // Admin update status laporan
    public function updateStatusLaporan(Request $request, $id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        $laporan->update(['status' => $request->status]);
        $laporan->user->notify(new StatusLaporanDiupdate($laporan));

        return back()->with('success', 'Status laporan berhasil diupdate!');
    }
}