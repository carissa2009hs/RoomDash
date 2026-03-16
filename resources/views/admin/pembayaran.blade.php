@extends('layouts.admin')
@section('title', 'Pembayaran')
@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-wallet text-blue-600 text-lg"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Pembayaran Sewa</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-sky-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-sack-dollar text-2xl text-sky-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-l text-gray-900 font-bold">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 font-semibold">Terkumpul Bulan ini</p>

                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div
                    class="w-12 h-12 bg-orange-400 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-hourglass-half text-2xl text-orange-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-l text-gray-900 font-bold ">{{ $totalMenunggu }}</p>
                    <p class="text-sm text-gray-500 font-semibold">Menunggu Konfirmasi</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-red-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-triangle-exclamation text-2xl text-red-400"></i>
                </div>
                <div class="mt-3">
                    <p class="text-l text-gray-900 font-bold ">{{ $totalTelat }}</p>
                    <p class="text-sm text-gray-500 font-semibold">Pembayaran Telat</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-green-400 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-circle-check text-2xl text-green-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-l text-gray-900 font-bold ">{{ $totalLunas }}</p>
                    <p class="text-sm text-gray-500 font-semibold">Lunas Bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="flex justify-end">
            <div
                class="flex items-center bg-white border border-gray-200 rounded-xl pl-4 pr-4 py-1 shadow-sm w-full max-w-md focus-within:ring-2 focus-within:ring-blue-300 focus-within:border-blue-400 transition">
                <i class="fa-solid fa-magnifying-glass text-sm text-gray-400 ml-2"></i>
                <input type="text" id="search-input" oninput="filterSearch()" placeholder="Cari nama atau kamar"
                    class="w-full px-2 py-2 text-sm focus:outline-none bg-transparent">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-md p-8">
        <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Riwayat Pembayaran</h3>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-blue-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">No
                            Kamar</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Nama Penghuni</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Tagihan</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Jatuh Tempo</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Status</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Bukti</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayarans as $bayar)
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors"
                                data-nama="{{ strtolower($bayar->user->name) }} {{ strtolower($bayar->user->penyewa->nomor_kamar ?? '') }}">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    {{ $bayar->user->penyewa->nomor_kamar ?? '-' }}
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->user->name }}</td>
                            <td class="py-4 px-4">
                                <span
                                    class="font-bold text-base text-gray-800">{{ number_format($bayar->jumlah, 0, ', ', '.') }}</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->bulan }}</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs
                                    {{ $bayar->status == 'Lunas' ? 'bg-teal-100 text-teal-700' : ($bayar->status == 'Menunggu Konfirmasi' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $bayar->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                @if ($bayar->bukti_bayar)
                                <a href="{{ asset('storage/' . $bayar->bukti_bayar) }}" target="_blank"
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-teal-600 hover:bg-teal-200 transition-colors">
                                    Lihat Bukti
                                </a>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                             <td class="px-4 py-4">
                                @if ($bayar->status == 'Menunggu Konfirmasi')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.konfirmasi', $bayar->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-teal-600 hover:bg-teal-200 transition-colors">Konfirmasi</button>
                                    </form>
                                    <form action="{{ route('admin.tolak', $bayar->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 text-red-600 hover:bg-red-200 transition-colors">Tolak</button>
                                    </form>
                                </div>
                                @elseif ($bayar->status == 'Lunas')
                                <span class="text-xs text-teal-600 font-semibold">Lunas</span>
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
    </div>

    <script>
        function filterSearch() {
            var keyword = document.getElementById('search-input').value.toLowerCase();
            document.querySelectorAll('tbody tr'). forEach(function(row) {
                var nama = row.getAttribute('data-nama') || '';
                row.style.display = nama.includes(keyword) ? '' : 'none';
            });
        }
    </script>

@endsection
