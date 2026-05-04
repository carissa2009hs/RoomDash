<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index() {
        return view('admin.data-penyewa');
    }

    public function getData() {
        return response()->json(DataPenyewa::latest()->get());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:225',
            'email' => 'required|email|max:225',
            'telepon' => 'required|string|max:20',
            'kamar' => 'required|string|max:20',
            'checkin' => 'required|date',
        ]);

        $penyewa = DataPenyewa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penyewa berhasil ditambahkan',
            'data' => $penyewa
        ]);
    }

    public function destroy($id)
    {
        try {
            DataPenyewa::findOrFail($id)->delete();
            return response()->json([ 'success' => true ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    
}