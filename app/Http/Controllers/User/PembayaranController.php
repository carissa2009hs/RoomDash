<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $pembayarans = Pembayaran::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('user.pembayaran', compact('user', 'pembayarans'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayarans = Pembayaran::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $pembayarans->update([
            'bukti_bayar' =>$path,
            'status' => 'Menunggu Konfirmasi',
            'tanggal_bayar' => now(),
        ]);

        return back()->with('success', 'Bukti bayar berhasil diupload!');
    }
}
