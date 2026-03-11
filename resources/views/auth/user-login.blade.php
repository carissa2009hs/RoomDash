<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-100 flex items-center justify-center p-4">


    <div
        class="fixed top-0 left-0 w-96 h-96 bg-blue-200 rounded-full opacity-20 blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none">
    </div>
    <div
        class="fixed bottom-0 right-0 w-80 h-80 bg-indigo-200 rounded-full opacity-20 blur-3xl translate-x-1/4 translate-y-1/4 pointer-events-none">
    </div>
    <div class="fixed top-1/2 right-1/4 w-64 h-64 bg-sky-200 rounded-full opacity-25 blur-3xl pointer-events-none">
    </div>


    <div
        class="relative z-10 w-full max-w-4xl bg-white rounded-3xl shadow-xl shadow-blue-100 overflow-hidden flex min-h-[560px]">

        <div
            class="hidden md:flex md:w-5/12 bg-gradient-to-b from-blue-700 via-blue-600 to-blue-400 flex-col justify-between p-12 relative overflow-hidden">


            <div
                class="absolute top-0 right-0 w-52 h-52 bg-white opacity-10 rounded-full -translate-y-1/4 translate-x-1/4 pointer-events-none">
            </div>
            <div
                class="absolute bottom-10 left-0 w-36 h-36 bg-white opacity-5 rounded-full -translate-x-1/4 pointer-events-none">
            </div>


            <div class="flex items-center gap-3 relative z-10">
                <div
                    class="w-11 h-11 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-house-chimney text-white text-xl"></i>
                </div>
                <span class="text-white text-xl font-bold tracking-tight">RoomDash</span>
            </div>


            <div class="relative z-10 flex flex-col items-center text-center my-auto">
                <h1 class="text-white text-3xl font-bold leading-tight tracking-tight mb-4">
                    Selamat Datang!
                </h1>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">
                    Bayar sewa, lapor kerusakan, cek riwayat - mudah, cepat dan transparan.
                </p>
            </div>
        </div>


        <div class="flex-1 flex flex-col justify-center px-10 py-12">

            <div
                class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600 text-xs font-semibold px-4 py-1.5 rounded-full w-fit mb-6">
                Login terlebih dahulu.
            </div>

            <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-1">Masuk ke akun</h2>
            <p class="text-sm text-slate-400 mb-8">Isi email dan password untuk melanjutkan</p>

            @if ($errors->any())
                <div
                    class="flex items-center gap-2 bg-red-50 border border-red-100 text-red-600 text-sm px-4 py-3 rounded-xl mb-5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <input type="email" name="email"  placeholder="nama@email.com"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 text-sm text-slate-800 placeholder-slate-300 outline-none focus:border-blue-400 focus:bg-blue-50 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                        <i
                            class="fa-regular fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300 pointer-events-none"></i>
                    </div>
                </div>

                <div class="mb-7">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="passwordInput" placeholder="••••••••"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pl-11 pr-11 text-sm text-slate-800 placeholder-slate-300 outline-none focus:border-blue-400 focus:bg-blue-50 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300 pointer-events-none"></i>

                        <button type="button" onclick="togglePw()" id="pwBtn"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-300 hover:text-blue-400 transition-colors text-base leading-none">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 rounded-xl text-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-200 active:translate-y-0 flex items-center justify-center gap-2">
                    Masuk ke Dashboard
                    <i class="fa-solid fa-arrow-right w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>

        <script>
            function togglePw() {
                const input = document.getElementById('passwordInput');
                const btn = document.getElementById('pwBtn');
                input.type = input.type === 'password' ? 'text' : 'password';
                btn.innerHTML = input.type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>';
            }
        </script>

</body>

</html>
