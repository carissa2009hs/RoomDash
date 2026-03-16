@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')

    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-chart-line text-blue-600 text-lg"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4">

            <a href="{{ route('admin.pembayaran') }}"
            class="bg-white rounded-xl shadow-md p-4 cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-sack-dollar text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 font-sm">Pendapatan bulan ini</h3>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">{{ number_format($totalLunas * 15000000, 0, ',', '.') }}</div>
            <p class="text-xs text-gray-500"></p>
        </a>


        <a href="{{ route('admin.data-penyewa') }}"
        class="bg-white rounded-xl shadow-md p-4 cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-door-open text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Total kamar</h3>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-2">{{ $totalPenyewa }}</div>
                <p class="text-xs text-gray-500">{{ $totalPenyewa }}</p>
            </a>

            <div
                class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-calendar-days text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Jatuh Tempo</h3>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-2">{{ $totalTunggakan }}</div>
                <p class="text-xs text-gray-500">{{ $totalTunggakan }} penyewa belum bayar</p>
            </div>

             <a href="{{ route('admin.laporan') }}"
              class="bg-white rounded-xl shadow-md p-4 cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-20"> 
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Laporan Kerusakan</h3>
                    <span id="badge-laporan" class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full {{ $totalLaporan == 0 ? 'hidden' : ''}}">
                        {{ $totalLaporan }}
                    </span>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-4" id="count-laporan">{{ $totalLaporan }}</div>
                <p class="text-xs text-gray-500"><span id="text-laporan">{{ $totalLaporan }}</span> Laporan kerusakan terbaru</p>
            </a>
            </div>
        

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-4 max-w-7xl mx-auto">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-stone-200 shadow-md p-6">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-stone-100">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Pembayaran</h3>
                            <p class="text-sm text-gray-400 mt-0.5">Februari 2026 - kamar terdaftar</p>
                        </div>

                        <div class="flex gap-1 bg-stone-100 rounded-xl p-1">
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white shadow-sm text-gray-800">Semua</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white shadow-sm text-gray-800">Menunggu</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white shadow-sm text-gray-800">Telat</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white shadow-sm text-gray-800">Lunas</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto mt-4">
                        <table class="w-full">
                            <thead class="bg-blue-50 border-b border-gray-200">
                                <tr>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        No
                                        Kamar</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Nama Penghuni</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Tagihan</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Jatuh Tempo</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Status</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Bukti</th>
                                    <th
                                        class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse ($pembayaranTerbaru as $bayar)
                                <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                                    <td class="py-4 px-4 text-gray-700">
                                        <div class="flex items-center gap-2 font-bold text-sm">
                                            {{ $bayar->user->penyewa->nomor_kamar ?? '-'}}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->user->name }}</td>
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-base text-gray-800">{{ number_format($bayar->jumlah, 0, ', ', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->bulan }}</td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs
                                            {{ $bayar->status == 'Lunas' ? 'bg-teal-100 text-teal-700' : ($bayar->status == 'Menunggu Konfirmasi' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                      {{ $bayar->status }}
                                    </span>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-gray-400">{{ $bayar->tanggal_bayar ? \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') : '-' }} </td>
                                    <td class="px-4 py-4">
                                        @if ($bayar->status == 'Menunggu Konfirmasi')
                                            <form action="{{ route('admin.konfirmasi', $bayar->id )}}" method="POST" class="inline">
                                        @csrf
                                        <button type="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-teal-600 hover:bg-teal-200 transition-colors">Konfirmasi</button>
                                     </form>
                                     @elseif ($bayar->status == 'Lunas')
                                     @if ($bayar->bukti_bayar)
                                         <a href="{{ asset('/storage' . $bayar->bukti_bayar) }}" target="_blank"
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                            Lihat Bukti
                                        </a>
                                     @endif
                                     @else
                                        <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-400 text-sm py-8">Belum ada data pembayaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a href="{{ route('admin.pembayaran') }}"
                            class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat
                            Selengkapnya -></a>
                    </div>
                </div>
            </div>
            
            
            <!--Laporan Kerusakan-->
            <div class="lg:col-span-1">
                <div class=" bg-white rounded-2xl shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">Laporan Kerusakan</h3>
                    </div>
                    <div class="p-6 space-y-4">

                        @forelse ($laporanTerbaru as $laporan )
                        <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-400 hover:shadow-sm transition-all duration-200 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $laporan->user->penyewa->nomor_kamar ?? '-' }} - {{ $laporan->user->name }}</h4>
                                            <p class="text-gray-600 mt-1 text-sm">{{ $laporan->judul }}</p>
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white ml-2 flex-shrink-0">Baru</span>
                            </div>
                        </div>
                         @empty
                         <p class="text-center text-gray-400 text-sm py-4">Belum ada laporan</p>
                         @endforelse

                        <a href="{{ route('admin.laporan') }}"
                            class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat
                            Selengkapnya -></a>
                    </div>
                </div>
            </div>

    <script>
        setInterval(function () {
            fetch('{{ route("admin.notif.count") }}')
            .then(function (r) { return r.json(); }) 
            .then (function (data) {
                document.getElementById('count-laporan').textContent = data.laporan;
                document.getElementById('text-laporan').textContent = data.laporan;

                var badge = document.getElementById('badge-laporan');
                if (data.laporan > 0) {
                    badge.textContent = data.laporan;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
        }, 5000);
    </script>

 @endsection
