<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RoomDash</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 via-lime-50 to-emerald-100 flex items-center justify-center p-4">

<div class="w-full max-w-sm bg-white rounded-3xl shadow-xl shadow-green-100 p-10">

    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-house-chimney text-white"></i>
        </div>
        <span class="text-xl font-bold text-gray-900">RoomDash</span>
    </div>

    <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat datang Admin!</h2>
    <p class="text-sm text-gray-400 mb-8">Masuk untuk kelola para penyewa</p>

    @if ($errors->any())
    <div class="flex items-center gap-2 bg-red-50 border border-red-100 text-red-600 text-sm px-4 py-3 rounded-xl mb-5">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="/admin/login" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <div class="relative">
                <input type="email" name="email" placeholder="nama@email.com" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-10 text-sm outline-none focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all">
                <i class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <div class="relative">
                <input type="password" name="password" id="passwordInput" placeholder="••••••••" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-10 pr-10 text-sm outline-none focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all">
                <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                <button type="button" onclick="togglePw()" id="pwBtn"
                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-300 hover:text-green-400 transition-colors">
                    <i class="fa-solid fa-eye text-sm"></i>
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl text-sm transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-green-200 flex items-center justify-center gap-2 mt-2">
            Masuk
            <i class="fa-solid fa-arrow-right text-sm"></i>
        </button>
    </form>
</div>

<script>
function togglePw() {
    const input = document.getElementById('passwordInput');
    const btn = document.getElementById('pwBtn');
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.innerHTML = input.type === 'password'
        ? '<i class="fa-solid fa-eye text-sm"></i>'
        : '<i class="fa-solid fa-eye-slash text-sm"></i>';
}
</script>

</body>
</html>