@extends('layouts.user')
@section('title', 'Pembayaran user')
@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-wallet text-blue-600 text-lg"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Pembayaran Sewa</h1>
        </div>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-800 rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-800 rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-circle-xmark"></i>
        {{ session('error') }}
    </div>
    @endif

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl border border-gray-200">
        <h1 class="text-xl text-gray-800 font-semibold mb-1">Upload Bukti Transfer</h1>
        <p class="text-sm text-gray-500 mb-6">Pastikan bukti transfer terlihat jelas dan nominal sesuai tagihan</p>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Tagihan Bulan Ini</p>
                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($penyewa->tagihan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jatuh Tempo</p>
                    <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                          {{ $penyewa->status_bayar === 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                          {{ $penyewa->status_bayar }}
                     </span>
                </div>
            </div>
        </div>

        <div class="bg-yellow-100 bg-opacity-80 border border-yellow-500 rounded-xl p-2 mb-6 relative overflow-hidden">
            <div class="flex gap-4">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
                    <i class="fa-solid fa-triangle-exclamation text-lg text-yellow-200"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-900">
                        Transfer ke Rekening Kos:</p>
                    <p class="text-xs text-gray-600 mt-1">Bank BCA:
                        <span class="text-xs font-semibold text-gray-800">1234-5678-90</span>
                        a.n. Kos Mentari
                    </p>
                </div>
            </div>
        </div>

        @if($pembayaranAktif && $pembayaranAktif->status === 'Menunggu Konfirmasi')
            <div class="bg-blue-50 border border-blue-300 rounded-xl p-4 mb-6 text-center">
                <i class="fa-solid fa-hourglass-half text-blue-500 text-2xl mb-2"></i>
                <p class="font-semibold text-blue-700">Bukti bayar sudah dikirim</p>
                <p class="text-sm text-gray-500 mt-1">Menunggu konfirmasi dari admin</p>
            </div>
        @else
          <form action="{{ route('pembayaran.upload', $pembayaranAktif->id ?? 0) }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 p-6 text-center mb-8 cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all"
            id="uploadZone" onclick="document.getElementById('fileInput').click()">
            <div
                class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-camera text-2xl text-white"></i>
            </div>
            <h3 class="font-semibold text-gray-800">Klik atau drag bukti transfer</h3>

            <input type="file" id="fileInput" name="bukti_bayar" accept="image/*" class="hidden" onchange="handleFileUpload(event)">
        </div>
         <div id="previewBox" class="hidden border border-gray-200 rounded-2xl overflow-hidden mb-8">
            <img id="previewImg" src="" alt="preview" class="w-full max-h-64 object-contain bg-gray-50">
            <div class="p-4 flex items-center justify-between bg-white">
                <div>
                    <p id="fileName" class="text-sm font-semibold text-gray-900">bukti.jpg</p>
                    <p id="fileSize" class="text-xs text-gray-500">1.2 MB</p>
                </div>
                <button onclick="removeFile()" class="text-sm font-semibold text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                    Hapus
                </button>
            </div>
         </div>

         @error('bukti_bayar')
             <p class="text-red-50 text-xs mb-4">{{ $message }}</p>
         @enderror

         <div class="mb-6">
            <label class="block text-base font-semibold text-gray-800 mb-2">Jumlah Transfer</label>
                <input type="text"class="w-full px-4 py-3 border border-gray-300 rounded-xl text-base
                 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
         </div>

         <div class="mb-6">
            <label class="block text-base font-semibold text-gray-900 mb-2">Tanggal Transfer</label>
            <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-base
            text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
         </div>

         <div class="mb-8">
            <label class="block text-base font-semibold text-gray-900 mb-2">Catatan (opsional)</label>
           <textarea rows="4" placeholder="Tambahkan catatan..." 
           class="w-full px-4 py-3 border border-gray-300 rounded-xl text-base
           text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
         </div>

         <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-xl text-base font-bold hover:-translate-y-1 shadow-sm hover:shadow-lg transition-all flex items-center justify-center gap-2">
         <i class="fa-solid fa-upload mr-2"></i>
         <p class="text-sm text-white">Kirim Bukti</p>
        </button>
    </form>
    @endif
    </div>

    <div class="max-w-4xl mx-auto mt-6 bg-white rounded-2xl border border-gray-200 p-6">
        <h2 class="font-bold text-gray-800 mb-4">Riwayat Pembayaran</h2>

        @forelse ($pembayarans as $bayar )
            <div class="flex justify-between items-center p-4 border border-stone-200 rounded-xl mb-3 hover:border-blue-400 transition">
                <div>
                    <p class="font-bold text-gray-900">{{ $bayar->bulan }}</p>
                    <p class="text-sm text-gray-500">Rp {{ number_format($bayar->jumlah, 0, ', ', '.') }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                {{ $bayar->status === 'Lunas' ? 'bg-green-100 text-green-700' : '' }}
                {{ $bayar->status === 'Menunggu Konfirmasi' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $bayar->status === 'Belum Lunas' ? 'bg-red-100 text-red-700' : '' }}">
                {{ $bayar->status }}
            </span>
            </div>
        @empty
        <p class="text-center text-gray-400 text-sm py-4">Belum ada riwayat pembayaran</p> 
        @endforelse
    </div>

    <script>
        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src= e.target.result;
                document.getElementById('fileName').textContent= file.name;
                document.getElementById('fileSize').textContent= (file.size/ 1024 / 1024). toFixed(2) + 'MB';
                document.getElementById('previewBox').classList.remove('hidden');
                document.getElementById('uploadZone').classList.add('hidden');
            }
            reader.readAsDataURL(file)
        }

        function removeFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('previewBox').classList.add('hidden');
            document.getElementById('uploadZone').classList.remove('hidden');
        }
    </script>


@endsection
