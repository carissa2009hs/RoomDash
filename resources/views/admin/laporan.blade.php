@extends('layouts.admin')
@section('title', 'Laporan Kerusakan')
@section('content')

<h1 class="text-xl text-gray-800">Laporan Kerusakan</h1>
<p class="text-sm text-gray-400 mb-8">Kelola dan tindaklanjuti laporan dari penyewa</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-sky-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-clipboard-list text-2xl text-sky-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Total Laporan</p>
                    <p class="text-xl text-gray-900 font-bold">{{ $laporans->count() }}</p>

                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-red-400 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-exclamation text-2xl text-red-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Laporan Baru</p>
                    <p class="text-xl text-gray-900 font-bold">{{ $laporanBaru->count() }}</p>
                    <p class="text-xs text-gray-600">Belum Ditangani</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div
                    class="w-12 h-12 bg-orange-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-spinner text-2xl text-orange-400"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Proses</p>
                    <p class="text-xl text-gray-900 font-bold">{{ $laporans->where('status', 'Diproses')->count() }}</p>
                    <p class="text-xs text-gray-600">Dalam Pengerjaan</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-sky-400 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-check text-2xl text-sky-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Selesai</p>
                    <p class="text-xl text-gray-900 font-bold">{{ $laporanSelesai->count() }}</p>
                    <p class="text-xs text-gray-600">Bulan ini</p>
                </div>
            </div>
        </div>
    </div>

        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base">Semua Laporan</h3>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $laporanAktif->count() }} Total laporan</p>
                </div>
                <div class="flex gap-1 bg-stone-100 rounded-lg p-1">
                    <button onclick="filterLaporan('semua', this)" class="tab-filter px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Semua</button>
                    <button onclick="filterLaporan('Menunggu', this)" class="tab-filter px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Baru</button>
                    <button onclick="filterLaporan('Diproses', this)"  class="tab-filter px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Proses</button>
                    <button onclick="filterLaporan('Selesai', this)" class="tab-filter px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Selesai</button>
                </div>
            </div>

            @forelse ($laporans as $laporan)
                <div class="laporan-card px-6 py-4 border-b border-stone-200 transition-all duration-20 hover:bg-teal-50"
                data-status="{{ $laporan->status }}">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                        <p class="font-bold text-gray-900">{{ $laporan->judul }}</p>
                        <p class="text-xs text-gray-800 mt-1">
                            <i class="fas fa-door-closed text-xs text-gray-800 mt-1"></i>
                            {{ $laporan->user->penyewa->nomor_kamar ?? '-' }} - {{ $laporan->user->name }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            {{ $laporan->deskripsi }}
                        </p>
                    </div>
                        <div class="flex flex-col items-end gap-2 flex-shrink-0">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold
                          {{ $laporan->prioritas == 'Berat' ? 'bg-red-100 text-red-600' : ($laporan->prioritas == 'Sedang' ? 'bg-yellow-100 text-yellow-800' : 'bg-sky-100 text-sky-700') }}">
                                {{ $laporan->prioritas }}
                            </span>
                            <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="updateStatus(this)"
                                    class="text-xs border-0 rounded-lg px-2 py-1 cursor-pointer focus:outline-none font-semibold
                                    {{ $laporan->status == 'Menunggu' ? 'bg-red-100 text-red-600' : ($laporan->status == 'Diproses' ? 'bg-yellow-100 text-yellow-700' : 'bg-sky-100 text-sky-700') }}">
                                    <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>Belum
                                        Ditangani</option>
                                    <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Sedang
                                        Diperbaiki</option>
                                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                        Diperbaiki</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-xs text-gray-400">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                        @if ($laporan->foto)
                            <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank"
                                class="inline-flex items-center gap-1.5 mt-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-sky-50 text-sky-600 hover:bg-sky-100 transition border border-sky-200">
                                <i class="fa-solid fa-image text-xs"></i>
                                Lihat Bukti
                            </a>
                        @endif
                    </div>
                    </div>
            @empty
                <p class="text-center text-gray-400 text-sm py-8">Tidak ada laporan aktif</p>
            @endforelse
        </div>

    <script>
        function filterLaporan(status, el) {
            document.querySelectorAll('.tab-filter').forEach(function(b) {
                b.classList.remove('bg-white', 'shadow-sm');
            });
            el.classList.add('bg-white', 'shadow-sm');

            document.querySelectorAll('.laporan-card').forEach(function(card) {
                card.style.display = (status === 'semua' || card.getAttribute('data-status') === status) ? '' : 'none' ;
            });
        }

        function updateStatus(el) {
    if (el.value === 'Menunggu') {
        el.className = 'text-xs rounded-lg px-2 py-1 cursor-pointer focus:outline-none font-semibold border-0 bg-red-100 text-red-600';
    } else if (el.value === 'Diproses') {
        el.className = 'text-xs rounded-lg px-2 py-1 cursor-pointer focus:outline-none font-semibold border-0 bg-yellow-100 text-yellow-700';
    } else {
        el.className = 'text-xs rounded-lg px-2 py-1 cursor-pointer focus:outline-none font-semibold border-0 bg-sky-100 text-sky-700';
    }

    var url = el.closest('form').action;
    var token = '{{ csrf_token() }}';

    fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: '_token=' + token + '&status=' + el.value
    });
}
    </script>

@endsection
