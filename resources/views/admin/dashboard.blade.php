@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="flex items-center gap-3 mb-6">
    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
        <i class="fa-solid fa-chart-line text-blue-600 text-lg"></i>
    </div>
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <a href="{{ route('admin.pembayaran') }}"
        class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-sack-dollar text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Pendapatan bulan ini</h3>
        </div>
        <div class="text-2xl font-bold text-gray-900 mb-2">Rp {{ number_format($totalLunas * 1500000, 0, ',', '.') }}</div>
    </a>

    <a href="{{ route('admin.data-penyewa') }}"
        class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-door-open text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Total kamar</h3>
        </div>
        <div class="text-2xl font-bold text-gray-900 mb-2">{{ $totalPenyewa }}</div>
        <p class="text-xs text-gray-500">{{ $totalPenyewa }} kamar terisi</p>
    </a>

    <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-calendar-days text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Jatuh Tempo</h3>
        </div>
        <div class="text-2xl font-bold text-gray-900 mb-2">{{ $totalJatuhTempo }}</div>
        <p class="text-xs text-gray-500">{{ $totalJatuhTempo }} penyewa belum bayar bulan ini</p>
    </div>

    <a href="{{ route('admin.laporan') }}"
        class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg hover:-translate-y-1 hover:scale-105 transition-all duration-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Laporan Kerusakan</h3>
            <span id="badge-laporan" class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full {{ $totalLaporan == 0 ? 'hidden' : '' }}">
                {{ $totalLaporan }}
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-900 mb-4" id="count-laporan">{{ $totalLaporan }}</div>
        <p class="text-xs text-gray-500"><span id="text-laporan">{{ $totalLaporan }}</span> laporan kerusakan terbaru</p>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-stone-200 shadow-md p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-stone-100">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Pembayaran</h3>
            <div class="flex gap-1 bg-stone-100 rounded-xl p-1">
                <button onclick="filterTab('semua', this)"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold bg-white shadow-sm text-gray-800">Semua</button>
                <button onclick="filterTab('Menunggu Konfirmasi', this)"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white text-gray-800">Menunggu</button>
                <button onclick="filterTab('Belum Lunas', this)"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white text-gray-800">Telat</button>
                <button onclick="filterTab('Lunas', this)"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white text-gray-800">Lunas</button>
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="w-full">
                <thead class="bg-blue-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">No Kamar</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Nama Penghuni</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Tagihan</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Jatuh Tempo</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Status</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Bukti</th>
                        <th class="text-left py-3 px-4 font-semibold uppercase tracking-wider text-gray-700 text-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaranTerbaru as $bayar)
                    @php
                        $telat = 0;
                        if ($bayar->status == 'Belum Lunas' && $bayar->user->penyewa) {
                            $telat = (int) now()->diffInDays(\Carbon\Carbon::parse($bayar->user->penyewa->jatuh_tempo), false) * -1;
                        }
                    @endphp
                    <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors"
                        data-status="{{ $bayar->status }}"
                        data-nama="{{ $bayar->user->name }} {{ $bayar->user->penyewa->nomor_kamar ?? '' }}">
                        <td class="py-4 px-4 text-gray-700">
                            <div class="font-bold text-sm">{{ $bayar->user->penyewa->nomor_kamar ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->user->name }}</td>
                        <td class="py-4 px-4">
                            <span class="font-bold text-base text-gray-800">Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}</span>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $bayar->bulan }}</td>
                        <td class="py-4 px-4">
                            @if ($bayar->status == 'Belum Lunas' && $telat > 0)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                    Telat {{ $telat }} Hari
                                </span>
                            @elseif ($bayar->status == 'Menunggu Konfirmasi')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                    Menunggu Konfirmasi
                                </span>
                            @elseif ($bayar->status == 'Lunas')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700">
                                    Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-600">
                                    {{ $bayar->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-500">
                            {{ $bayar->tanggal_bayar ? \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-4">
                            @if ($bayar->status == 'Menunggu Konfirmasi')
                                <div class="flex gap-2 flex-wrap">
                                    @if ($bayar->bukti_bayar)
                                    <a href="{{ asset('storage/' . $bayar->bukti_bayar) }}" target="_blank"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                        Lihat Bukti
                                    </a>
                                    @endif
                                    <form action="{{ route('admin.konfirmasi', $bayar->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-teal-600 hover:bg-teal-200 transition-colors">
                                            Konfirmasi
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.tolak', $bayar->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 text-red-600 hover:bg-red-200 transition-colors">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @elseif ($bayar->status == 'Belum Lunas')
                                <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-orange-100 text-orange-600 hover:bg-orange-200 transition-colors">
                                    Ingatkan
                                </button>
                            @elseif ($bayar->status == 'Lunas')
                                @if ($bayar->bukti_bayar)
                                <a href="{{ asset('storage/' . $bayar->bukti_bayar) }}" target="_blank"
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                    Lihat Bukti
                                </a>
                                @else
                                <span class="text-xs text-teal-600 font-semibold">✓ Lunas</span>
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
                class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat Selengkapnya -></a>
        </div>
    </div>

    <div class="lg:col-span-1 bg-white rounded-2xl shadow border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Laporan Kerusakan</h3>
        </div>
        <div class="p-6 space-y-4">
            @forelse ($laporanTerbaru as $laporan)
            <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-400 hover:shadow-sm transition-all duration-200 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex items-start gap-3 flex-1">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $laporan->user->name }}</h4>
                            <p class="text-gray-600 mt-1 text-sm">{{ $laporan->judul }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white ml-2 flex-shrink-0">Baru</span>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-4">Belum ada laporan</p>
            @endforelse

            <a href="{{ route('admin.laporan') }}"
                class="text-blue-700 text-sm font-semibold mt-3 mb-4 flex items-center justify-center">Lihat Selengkapnya -></a>
        </div>
    </div>
</div>

<script>
function filterTab(status, el) {
    document.querySelectorAll('.tab-btn').forEach(function(b) {
        b.classList.remove('bg-white', 'shadow-sm');
    });
    el.classList.add('bg-white', 'shadow-sm');
    document.querySelectorAll('tbody tr').forEach(function(row) {
        row.style.display = (status === 'semua' || row.getAttribute('data-status') === status) ? '' : 'none';
    });
}

setInterval(function() {
    fetch('{{ route("admin.notif.count") }}')
        .then(function(r) { return r.json(); })
        .then(function(data) {
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