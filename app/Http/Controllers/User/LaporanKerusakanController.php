<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanKerusakan;

class LaporanKerusakanController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $laporans = LaporanKerusakan::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('user.laporan', compact('user', 'laporans'));
    }

    public function store(Request $request)
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

        LaporanKerusakan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto'      => $fotoPath,
            'status'    => 'Menunggu',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }
}