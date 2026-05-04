@extends('layouts.user')
@section('title', 'Riwayat')
@section('content')

<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-clock-rotate-left text-blue-600 text-lg"></i>
        </div>
        <h1 class="text-xl font-semibold text-gray-800">Riwayat</h1>
    </div>
</div>

<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100">
                <h3 class="font-bold text-lg mb-1 mt-2">
                    Riwayat Pembayaran
                </h3>
                <p class="text-sm text-gray-500 mt-1">Semua riwayat pembayaran sewa</p>
            </div>

            @forelse ($pembayarans as $bayar)
            <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-gray-900">{{ $bayar->bulan }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $bayar->status === 'Lunas' ? 'bg-green-100 text-green-800' : ($bayar->status === 'Menunggu Konfirmasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $bayar->status }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}</p>
                    @if ($bayar->tanggal_bayar)
                    <p class="text-xs text-gray-400 mt-1">
                        Dibayar: {{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->translatedFormat('d F Y') }}
                    </p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-6">Belum ada riwayat pembayaran</p>
            @endforelse
        </div>

        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100">
                <h3 class="font-bold text-lg mb-1 mt-2">
                    Riwayat Laporan
                </h3>
                <p class="text-xs text-gray-500 mt-0.5">Semua laporan kerusakan</p>
            </div>

            @forelse ($laporans as $laporan)
            <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <p class="text-gray-500 text-xs">
                            {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y') }}
                        </p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $laporan->status === 'Selesai' ? 'bg-green-100 text-green-800' : ($laporan->status === 'Diproses' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $laporan->status }}
                        </span>
                    </div>
                    <p class="text-base text-gray-900 my-1 font-semibold">{{ $laporan->judul }}</p>
                    <p class="text-gray-500 text-xs">Prioritas: {{ $laporan->prioritas }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-6">Belum ada laporan</p>
            @endforelse
        </div>

    </div>
</div>

@endsection