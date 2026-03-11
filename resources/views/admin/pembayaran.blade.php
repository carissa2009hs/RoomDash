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
                    <p class="text-l text-gray-900 font-bold ">Rp 20.000.000</p>
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
                    <p class="text-l text-gray-900 font-bold ">3</p>
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
                    <p class="text-l text-gray-900 font-bold ">2</p>
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
                    <p class="text-l text-gray-900 font-bold ">5</p>
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
                <input type="text" placeholder="Cari nama atau kamar"
                    class="w-full px-2 py-2 text-sm focus:outline-none bg-transparent">
            </div>
        </div>
    </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-md p-8">
            <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
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
                        <!--Baris 1 Lunas-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    A09
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">Carissa</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700">Lunas</span>
                            </td>
                            <td class="px-4 py-4 text-xs text-gray-400">10 Feb 2026</td>
                            <td class="px-4 py-4">
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                    Lihat Bukti
                                </button>
                            </td>
                        </tr>

                        <!--Baris 2 Lunas-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    A09
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">Carissa</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700">Lunas</span>
                            </td>
                            <td class="px-4 py-4 text-xs text-gray-400">10 Feb 2026</td>
                            <td class="px-4 py-4">
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                    Lihat Bukti
                                </button>
                            </td>
                        </tr>

                        <!--Baris 3 Telat-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    A09
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">Hana</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">Telat
                                    5 hari</span>
                            </td>
                            <td class="px-4 py-4 text-xs text-gray-400">-</td>
                            <td class="px-4 py-4">
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-gray-600 hover:bg-teal-500 transition-colors">
                                    Ingatkan
                                </button>
                            </td>
                        </tr>

                        <!--Baris 4 Konfirmasi-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-3 px-3">
                                <span class="font-bold text-sm text-gray-700">A09</span>
                            </td>
                            <td class="py-3 px-3 text-sm text-gray-700">Saphira</td>
                            <td class="py-3 px-3">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-3 px-3 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-3 px-3">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700 whitespace-nowrap">
                                    Menunggu Konfirmasi
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <button
                                    class="text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors whitespace-nowrap ml-5">
                                    Lihat →
                                </button>
                            </td>
                            <td class="py-3 px-3">
                                <button
                                    class="px-2 py-1 rounded-lg font-semibold text-xs bg-teal-100 text-teal-700 hover:bg-teal-200 transition whitespace-nowrap">
                                    Konfirmasi
                                </button>
                            </td>
                        </tr>

                        <!--Baris 5 Telat-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    A09
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">Hana</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">Telat
                                    5 hari</span>
                            </td>
                            <td class="px-4 py-4 text-xs text-gray-400">-</td>
                            <td class="px-4 py-4">
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-teal-100 text-gray-600 hover:bg-teal-500 transition-colors">
                                    Ingatkan
                                </button>
                            </td>
                        </tr>

                        <!--Baris 6 Lunas-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-4 text-gray-700">
                                <div class="flex items-center gap-2 font-bold text-sm">
                                    A09
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">Carissa</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700">Lunas</span>
                            </td>
                            <td class="px-4 py-4 text-xs text-gray-400">10 Feb 2026</td>
                            <td class="px-4 py-4">
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-stone-100 text-gray-600 hover:bg-stone-200 transition-colors">
                                    Lihat Bukti
                                </button>
                            </td>
                        </tr>

                        <!--Baris 7 Konfirmasi-->
                        <tr class="border-b border-gray-100 bg-white hover:bg-blue-50 transition-colors">
                            <td class="py-3 px-3">
                                <span class="font-bold text-sm text-gray-700">A09</span>
                            </td>
                            <td class="py-3 px-3 text-sm text-gray-700">Saphira</td>
                            <td class="py-3 px-3">
                                <span class="font-bold text-base text-gray-800">Rp 1.200.000</span>
                            </td>
                            <td class="py-3 px-3 text-sm text-gray-700">5 Feb 2026</td>
                            <td class="py-3 px-3">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700 whitespace-nowrap">
                                    Menunggu Konfirmasi
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <button
                                    class="text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors whitespace-nowrap ml-5">
                                    Lihat →
                                </button>
                            </td>
                            <td class="py-3 px-3">
                                <button
                                    class="px-2 py-1 rounded-lg font-semibold text-xs bg-teal-100 text-teal-700 hover:bg-teal-200 transition whitespace-nowrap">
                                    Konfirmasi
                                </button>
                            </td>
                        </tr>





                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>






@endsection
