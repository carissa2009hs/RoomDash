@extends('layouts.user')
@section('title', 'Dashboard user')
@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-chart-line text-blue-600 text-lg"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    </div>
    </div>

    <div class="bg-gradient-to-br from-blue-600 to-blue-400 rounded-3xl p-10 mb-6 relative overflow-hidden">
        <div class="absolute -top-1/3 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <p class="text-lg text-white/85 mb-2">Selamat datang kembali,</p>
            <h1 class="text-5xl font-extrabold text-white mb-8 flex items-center gap-3">
                {{ $user ->name }}
            </h1>

            <div class="flex gap-4">
                <div class="flex-1 bg-white/12 backdrop-blur-md border border-white/15 rounded-2xl p-6">
                    <p class="text-sm text-white/75 mb-2">Kamar Anda</p>
                    <p class="text-3xl font-bold text-white">{{ $penyewa->nomor_kamar ?? '-' }}</p>
                </div>

                <div class="flex-1 bg-white/12 backdrop-blur-md border border-white/15 rounded-2xl p-6">
                    <p class="text-sm text-white/75 mb-2">Status Bayar</p>
                    <p class="text-3xl font-bold text-white">{{ $penyewa->status_bayar ?? '-' }}</p>
                </div>

                <div class="flex-1 bg-white/12 backdrop-blur-md border border-white/15 rounded-2xl p-6">
                    <p class="text-sm text-white/75 mb-2">Jatuh Tempo</p>
                    <p class="text-3xl font-bold text-white">
                        @if ($sisaHari > 0)
                              {{ $sisaHari }} hari lagi
                        @elseif ($sisaHari == 0)
                              Hari ini!
                        @else
                        Telat!
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    

    @if ($sisaHari <= 5 && $penyewa->status_bayar != 'Lunas')
    <div class="bg-yellow-100 bg-opacity-80 border border-yellow-500 rounded-2xl p-6 mb-6 relative overflow-hidden">
        <div class="flex gap-4">
            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
                <i class="fa-solid fa-triangle-exclamation text-2xl text-yellow-200"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-bold text-gray-900">
                    Pembayaran Bulan Depan Segera Jatuh Tempo!</p>
                <p class="text-xs text-gray-600 mt-1">Tagihan Maret 2026 sebesar Rp 1.200.000 akan jatuh tempo pada 5 Maret
                    2026. Segera transfer & upload bukti bayar</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-blue-600 transition-all">
            <div class="flex items-start gap-3">
                <a href="{{ route('user.pembayaran') }}" class="w-12 h-12 bg-sky-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-wallet text-2xl text-sky-600"></i>
                </a>
                <div class="mt-1">
                    <a href="{{ route('user.pembayaran') }}" class="text-lg text-gray-900 font-bold">Bayar Sewa</a>
                    <p class="text-sm text-gray-500">Upload bukti transfer pembayaran</p>

                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-blue-600 transition-all">
            <div class="flex items-start gap-3">
                <a href="{{ route('user.laporan') }}" class="w-12 h-12 bg-sky-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-wrench text-2xl text-sky-600"></i>
                </a>
                <div class="mt-1">
                    <a href="{{ route('user.laporan') }}" class="text-lg text-gray-900 font-bold ">Laporan Kerusakan</a>
                    <p class="text-sm text-gray-500">Laporkan masalah fasilitas kamar</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4 mb-6">

        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-sack-dollar text-2xl"></i>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">
                Rp {{ number_format($penyewa->tagihan / 1000000, 1) }}Jt </div>
            <p class="text-xs text-gray-500">Tagihan bulan ini</p>
        </div>


        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-2xl"></i>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">{{ $penyewa->status_bayar }}</div>
            <p class="text-xs text-gray-500">Status bayar</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-2xl"></i>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">
                {{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->translatedFormat('d M') }}
            </div>
            <p class="text-xs text-gray-500">Jatuh tempo</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-wrench text-2xl"></i>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-4">{{ $totalLaporanAktif }} Proses</div>
            <p class="text-xs text-gray-500">Laporan aktif</p>
        </div>
    </div>
    </div>

    <!--Laporan Pembayaran-->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base">Pembayaran Terakhir</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Riwayat pembayaran sewa kamar</p>
                </div>
            </div>

            @forelse ($pembayaranTerakhir as $bayar )
            <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                    <p class="font-bold text-gray-900">{{ $bayar->bulan }}</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        {{ $bayar->status === 'Lunas' ? 'bg-green-100 text-green-800' : ''}}
                        {{ $bayar->status === 'Menunggu Konfirmasi' ? 'bg-yelllow-100 text-yellow-800' : ''}}
                        {{ $bayar->status === 'Belum Lunas' ? 'bg-red-100 text-red-800' : ''}}
                        {{ $bayar->status}}
                    </span>
                </div>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                        Rp {{number_format($bayar->jumlah, 0, ',', '.')}}
                    </p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-6">Belum ada riwayat pembayaran</p>
            @endforelse

            <a href="{{ route('user.riwayat') }}"
            class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat
            Selengkapnya -></a>
        </div>
        
         <!--Laporan Kerusakan-->
   
        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base">Laporan Kerusakan</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Status laporan yang sedang berjalan</p>
                </div>
            </div>

            @forelse ($laporanTerakhir as $laporan )
            <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                    <p class="text-xs text-gray-900 font-semibold">
                        {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y') }}
                    </p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $laporan->status === 'Selesai' ? 'bg-green-100 text-green-800' : ''}}
                        {{ $laporan->status === 'Diproses' ? 'bg-yelllow-100 text-yellow-800' : ''}}
                        {{ $laporan->status === 'Menunggu' ? 'bg-red-100 text-red-800' : ''}}">
                        {{ $laporan->status}}
                    </span>
                </div>
                    <p class="text-sm text-gray-900 font-bold mt-1 leading-relaxed">
                        {{ $laporan->judul }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                        {{ $laporan->prioritas }}
                    </p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-6">Belum ada laporan</p>
            @endforelse

            <a href="{{ route('user.riwayat') }}"
            class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat
            Selengkapnya -></a>
        </div>
    </div>

  @endsection
