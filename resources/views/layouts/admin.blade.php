<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RoomDash')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    {{-- SIDEBAR --}}
<aside class="fixed left-0 top-0 w-64 h-screen bg-white text-gray-700 border-r border-gray-200 z-50 shadow-sm">
   
    <div class="h-20 flex items-center px-6 border-b border-gray-200/50">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center shadow-md">
            <i class="fa-solid fa-house-chimney text-white text-lg"></i>
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-sky-800 to-sky-600 bg-clip-text text-transparent ml-3">RoomDash</span>
    </div>

    <nav class="p-4 space-y-2 mt-4">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-700 shadow-md' : 'text-gray-600 hover:bg-sky-50 hover:shadow-sm hover:text-sky-600' }}">
            <i class="fa-solid fa-chart-line w-5 {{ request()->routeIs('admin.dashboard') ? 'text-sky-600' : '' }}"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.data-penyewa') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.data-penyewa') ? 'bg-sky-50 text-sky-700 shadow-md' : 'text-gray-600 hover:bg-sky-50 hover:shadow-sm hover:text-sky-600' }}">
            <i class="fa-solid fa-users w-5 {{ request()->routeIs('admin.penyewa') ? 'text-sky-600' : '' }}"></i>
            <span>Data Penyewa</span>
        </a>

        <a href="{{ route('admin.pembayaran') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.pembayaran') ? 'bg-sky-50 text-sky-700 shadow-md' : 'text-gray-600 hover:bg-sky-50 hover:shadow-sm hover:text-sky-600' }}">
            <i class="fa-solid fa-wallet w-5 {{ request()->routeIs('admin.pembayaran') ? 'text-sky-600' : '' }}"></i>
            <span>Pembayaran Sewa</span>
        </a>

        <a href="{{ route('admin.laporan') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.laporan') ? 'bg-sky-50 text-sky-700 shadow-md' : 'text-gray-600 hover:bg-sky-50 hover:shadow-sm hover:text-sky-600' }}">
            <i class="fa-solid fa-wrench w-5 {{ request()->routeIs('admin.laporan') ? 'text-sky-600' : '' }}"></i>
            <span>Laporan Kerusakan</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200/50 bg-sky-50/50">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white hover:shadow-md transition-all duration-200 w-full group">
                <i class="fa-solid fa-right-from-bracket w-5 group-hover:translate-x-1 transition-transform"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

    <div class="ml-64">
        <header class="h-16 bg-white border-gray-200 sticky top-0 z-40">
            <div class="h-full flex items-center  px-8">
                <h2 class="text-xl font-semibold text-slate-900 ">Selamat Datang, Admin!</h2>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>


</body>

</html>
