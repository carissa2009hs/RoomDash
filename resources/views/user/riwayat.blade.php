@extends('layouts.user')
@section('title', 'Laporan user')
@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-clock-rotate-left text-blue-600 text-lg"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Riwayat</h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">


        <!--Laporan Pembayaran-->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="bg-white rounded-xl border border-stone-200">
                <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg mb-1 mt-2">
                            <i class="fa-solid fa-wallet text-blue-600 mr-2"></i>
                            Riwayat Pembayaran
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">6 Bulan Terakhir</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">15 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Rp 1.200.000
                        </p>
                    </div>
                </div>
            </div>

            <!-- Laporan Baru -->
            <div class="bg-white rounded-xl border border-stone-200">
                <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg mb-1 mt-2">
                            <i class="fa-solid fa-wrench text-blue-600 mr-1"></i>
                            Riwayat Laporan
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Semua laporan kerusakan</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class=" text-gray-500 text-xs">23 Februari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Proses
                            </span>
                        </div>
                        <p class="text-base text-gray-900 my-1 leading-relaxed font-semibold">Ac tidak dingin</p>
                        <p class=" text-gray-500 text-xs">Prioritas: Sedang </p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class=" text-gray-500 text-xs">9 Januari 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </div>
                        <p class="text-base text-gray-900 my-1 leading-relaxed font-semibold">Flush toilet rusak</p>
                        <p class=" text-gray-500 text-xs">Prioritas: Sedang </p>

                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class=" text-gray-500 text-xs">30 Desember 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </div>
                        <p class="text-base text-gray-900 my-1 leading-relaxed font-semibold">Air di westafel mati</p>
                        <p class=" text-gray-500 text-xs">Prioritas: Sedang </p>

                    </div>
                </div>

                <div class="flex gap-4 p-4 mx-5 my-3 border border-stone-200 rounded-xl hover:border-blue-600">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class=" text-gray-500 text-xs">1 Desember 2026</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </div>
                        <p class="text-base text-gray-900 my-1 leading-relaxed font-semibold">Shower tidak mau menyala</p>
                        <p class=" text-gray-500 text-xs">Prioritas: Rendah </p>

                    </div>
                </div>
            </div>












        @endsection
