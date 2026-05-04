<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RoomDash')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- SIDEBAR -->
    <aside
        class="fixed left-0 top-0 w-64 h-screen bg-white text-gray-700 border-r border-gray-200 z-50 shadow-sm">

        <div class="h-20 flex items-center px-6 border-b border-gray-200/50">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center shadow-md">
                <i class="fa-solid fa-house-chimney text-white text-lg"></i>
            </div>
            <span
                class="text-xl font-bold bg-gradient-to-r from-blue-800 to-blue-600 bg-clip-text text-transparent ml-3">RoomDash</span>
        </div>

        <nav class="p-4 space-y-2 mt-4">
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-700 shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:shadow-sm hover:text-blue-600' }}">
                <i
                    class="fa-solid fa-chart-line w-5 {{ request()->routeIs('user.dashboard') ? 'text-blue-600' : '' }}"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('user.pembayaran') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.pembayaran') ? 'bg-blue-50 text-blue-700 shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:shadow-sm hover:text-blue-600' }}">
                <i
                    class="fa-solid fa-wallet w-5 {{ request()->routeIs('user.pembayaran') ? 'text-blue-600' : '' }}"></i>
                <span>Pembayaran Sewa</span>
            </a>

            <a href="{{ route('user.laporan') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.laporan') ? 'bg-blue-50 text-blue-700 shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:shadow-sm hover:text-blue-600' }}">
                <i class="fa-solid fa-wrench w-5 {{ request()->routeIs('user.laporan') ? 'text-blue-600' : '' }}"></i>
                <span>Laporan Kerusakan</span>
            </a>

            <a href="{{ route('user.riwayat') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.riwayat') ? 'bg-blue-50 text-blue-700 shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:shadow-sm hover:text-blue-600' }}">
                <i class="fa-solid fa-clock-rotate-left w-5 {{ request()->routeIs('user.riwayat') ? 'text-blue-600' : '' }}"></i>
                <span>Riwayat</span>
            </a>
        </nav>

        {{-- Logout --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200/50 bg-blue-50/50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white hover:shadow-md transition-all duration-200 w-full group">
                    <i class="fa-solid fa-right-from-bracket w-5 group-hover:translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
   
    <div class="fixed top-0 left-64 right-0 h-16 z-40 flex items-center justify-between px-8 bg-white border-b border-gray-100 shadow-sm">
        <div>
            <h2 class="text-xl font-semibold text-slate-900 leading-none">
                Selamat Datang, {{ auth()->user()->name }} !
            </h2>
        </div>
        <div class="relative ml-auto">
            <button onclick="toggleNotif()"
                class="relative w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 transition-all">
                <i class="fa-solid fa-bell text-gray-600 text-lg"></i>
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </button>
            
            

            <div id="notif-dropdown"
                class="hidden absolute right-0 top-12 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 z-50">
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                    <span class="font-semibold text-gray-700">Notifikasi</span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <a href="{{ route('notifikasi.baca-semua') }}" class="text-xs text-blue-500 hover:underline">
                            Tandai semua dibaca
                        </a>
                    @endif
                </div>

                <div class="max-h-80 overflow-y-auto">
                    @forelse(auth()->user()->notifications->take(5) as $notif)
                        <a href="{{ route('notifikasi.baca', $notif->id) }}"
                            class="flex gap-3 px-4 py-3 hover:bg-gray-50 transition-all border-b border-gray-50 {{ $notif->read_at ? 'opacity-60' : '' }}">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                            {{ $notif->data['icon'] === 'success' ? 'bg-green-100' : '' }}
                            {{ $notif->data['icon'] === 'error' ? 'bg-red-100' : '' }}
                            {{ $notif->data['icon'] === 'info' ? 'bg-blue-100' : '' }}">
                                <i class="text-sm
                                {{ $notif->data['icon'] === 'success' ? 'fa-solid fa-check text-green-600' : '' }}
                                {{ $notif->data['icon'] === 'error' ? 'fa-solid fa-xmark text-red-600' : '' }}
                                {{ $notif->data['icon'] === 'info' ? 'fa-solid fa-wrench text-blue-600' : '' }}">
                                </i>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-700 truncate">
                                    {{ $notif->data['judul'] }}
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">
                                    {{ $notif->data['pesan'] }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if (!$notif->read_at)
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-1"></div>
                            @endif
                        </a>
                    @empty
                        <div class="py-8 text-center">
                            <i class="fa-solid fa-bell-slash text-gray-300 text-3xl"></i>
                            <p class="text-gray-400 text-sm mt-2">Belum ada notifikasi</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="ml-3 flex items-center gap-2">
            <div
                class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                <span class="text-white text-sm font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
            </div>
                <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
        </div>
    </div>
    
    <main class="ml-64 mt-16 p-8">
        @yield('content')
    </main>

        <script>
            function toggleNotif() {
                const dropdown = document.getElementById('notif-dropdown');
                dropdown.classList.toggle('hidden');
            }

            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('notif-dropdown');
                const btn = e.target.closest('button');
                if (!dropdown.contains(e.target) && !btn) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
</body>

</html>
