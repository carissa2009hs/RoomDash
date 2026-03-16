@extends('layouts.admin')
@section('title', 'Laporan Kerusakan')
@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-wrench text-blue-600 text-lg"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Kerusakan</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-sky-600 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-clipboard-list text-2xl text-sky-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Total Laporan</p>
                    <p class="text-xl text-gray-900 font-bold">12</p>

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
                    <p class="text-xl text-gray-900 font-bold">3</p>
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
                    <p class="text-xl text-gray-900 font-bold">4</p>
                    <p class="text-xs text-gray-600">Dalam Pengerjaan</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-300 rounded-2xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-green-400 bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur">
                    <i class="fa-solid fa-check text-2xl text-green-600"></i>
                </div>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 font-semibold ">Selesai</p>
                    <p class="text-xl text-gray-900 font-bold">5</p>
                    <p class="text-xs text-gray-600">Bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <!--Laporan Aktif-->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base">Laporan Aktif</h3>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $laporanAktif->count() }} Laporan Menunggu Penanganan</p>
                </div>
                <div class="flex gap-1 bg-stone-100 rounded-lg p-1">
                    <button class="px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Baru</button>
                    <button class="px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-white shadow-sm">Proses</button>
                </div>
            </div>

            @forelse ($laporanAktif as $laporan)
            <div
                class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl cursor-pointer transition-all duration-200 hover:border-amber-400 hover:bg-amber-50">
                <div class="flex-1">
                    <p class="font-bold text-gray-900">{{ $laporan->judul }}</p>
                    <p class="text-xs text-gray-800 mt-1">
                        <i class="fas fa-door-closed text-xs text-gray-800 mt-1"></i>
                        {{ $laporan->user->penyewa->nomor_kamar ?? '-' }} - {{ $laporan->user->name }}</p>
                    </p>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                        {{ $laporan->deskripsi }}
                      </p>

                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                          {{ $laporan->prioritas == 'Berat' ? 'bg-red-100 text-red-600' : ($laporan->prioritas == 'Sedang' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-700') }}">
                    {{ $laporan->prioritas }}
                </span>

                <span class="text-xs text-gray-500">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST" class="ml-auto">
                    @csrf
                    @if ($laporan->status == 'Menunggu')
                        <input type="hidden" name="status" value="Diproses">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-semibold bg-yellow-100 text-yellow-700 hover:bg-yellow-200">Proses</button>
                    @elseif ($laporan->status == 'Diproses')
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-semibold bg-green-100 text-green-700 hover:bg-green-200">Proses</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center text-gray-400 text-sm py-8">Tidak ada laporan aktif</p>
    @endforelse
</div>

        <!-- Laporan Baru -->
        <div class="bg-white rounded-xl border border-stone-200">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base">Laporan Baru</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Butuh Tindakan Segera</p>
                </div>
            </div>
        
            @forelse ($laporanBaru as $laporan)
            <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl cursor-pointer transition-all duration-200 hover:border-amber-400 hover:bg-amber-50">
                <div class="flex-1">
                    <p class="font-bold text-gray-900">{{ $laporan->judul }}</p>
                    <p class="text-xs text-gray-800 mt-1">
                        <i class="fas fa-door-closed text-xs text-gray-800 mr-1"></i>
                        {{ $laporan->user->penyewa->nomor_kamar ?? '-' }} - {{ $laporan->user->name }}</p>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">{{ $laporan->deskripsi }}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                           {{ $laporan->prioritas == 'Berat' ? 'bg-red-100 text-red-600' : ($laporan->prioritas == 'Sedang' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-700') }}">
                           {{ $laporan->prioritas }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-3 px-12 bg-green-200 bg-opacity-40 rounded-xl mt-4 w-fit mx-auto">
                <p class="text-emerald-500 text-sm flex items-center justify-center">
                    <i class="fa-solid fa-check text-emerald-500 text-sm mr-1"></i>
                    Semua laporan baru sudah ditangani
                </p>
            </div>
            @endforelse
        </div>
@endsection
