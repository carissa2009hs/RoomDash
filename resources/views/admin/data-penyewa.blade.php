@extends('layouts.admin')
@section('title', 'Data Penyewa')
@section('content')


        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-blue-600 text-lg"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Data Penyewa</h1>
            </div>
            <button
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-full text-sm font-medium transition-all shadow-sm">+Tambah
                Penyewa</button>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div class="flex flex-wrap gap-2">
                <span
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:text-white rounded-full hover:bg-blue-800  text-xs font-medium">Semua</span>
                <span
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:text-white rounded-full hover:bg-blue-800  text-xs font-medium">Aktif</span>
                <span
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:text-white rounded-full hover:bg-blue-800  text-xs font-medium">Tidak
                    Aktif</span>
            </div>
            <div class="flex items-center bg-white border-gray-200 rounded-full pl-4 pr-1 py-1 shadow-sm w-full max-w-xs ">
                <i class="fa-solid fa-magnifying-glass text-sm text-gray-400"></i>
                <input type="text" placeholder="Cari nama atau kamar"
                    class="w-full px-3 py-2 text-sm focus:outline-none bg-transparent">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-full text-xs font-medium transition">Cari</button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
           
            <!--Card 1-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <!--Card 2-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
             
            <!--Card 3-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <!--Card 4-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <!--Card 5-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <!--Card 6-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <!--Card 7-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

            <!--Card 8-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

             <!--Card 9-->
            <div
                class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 text-base truncate">Carissa Hana</h3>
                        <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                            carissa@gmail.com
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                    </span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>0812-3456-9876
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar A-102
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: 01 Februari 2026
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


























































@endsection
