@extends('layouts.user')
@section('title', 'Laporan user')
@section('content')

<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-wrench text-blue-600 text-lg"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Laporan Kerusakan</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl border border-gray-200">
    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h1 class="text-xl text-gray-800 font-semibold mb-1">Form Laporan Kerusakan</h1>
    <p class="text-sm text-gray-500 mb-6">Sertakan foto yang jelas dan deskripsi detail masalah.</p>

    <div class="bg-blue-100 bg-opacity-80 border border-blue-500 rounded-xl p-2 mb-6 relative overflow-hidden">
        <div class="flex gap-4">
            <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
                <i class="fa-solid fa-info text-lg text-blue-200"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-800 mt-1">
                    Foto yang jelas akan mempercepat proses penanganan oleh teknisi.</p>
            </div>
        </div>
    </div>

    <div class="border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 p-6 text-center mb-8 cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all"
        id="uploadZone" onclick="document.getElementById('fileInput').click()">
        <div
            class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-camera text-2xl text-white"></i>
        </div>
        <h3 class="font-semibold text-gray-800">Foto bagian yang rusak</h3>
        <p class="text-gray-500 text-sm">Ambil dari berbagai sudut</p>
        <p class="text-gray-500 text-xs">JPG, PNG, PDF • Maks 5MB</p>
        <input type="file" id="fileInput" name="foto" accept="image/*" class="hidden" onchange="handleFileUpload(event)">
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

     <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-800 mb-2">Judul Masalah</label>
            <input type="text" name="judul" placeholder="Contoh: Ac tidak dingin..."
            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm
             text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
     </div>

     <div class="mb-4">
        <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi detail</label>
       <textarea name="deskripsi" rows="4" placeholder="Jelaskan masalahnya secara detail" 
       class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm
       text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
     </div>

     <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-800 mb-2">Lokasi Spesifik</label>
            <input type="text" placeholder="Contoh: Sudut kanan kamar.."
            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm
             text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
     </div>
 
     <div class="mb-6">
     <label class="block text-sm font-semibold text-gray-900 mb-2">Tingkat Prioritas</label>
     <select name="prioritas" class="w-full px-4 py-3 border border-gray-300 rounded-xl placeholder:Pilih Tingkat Prioritas">
        <option value="Ringan">Ringan</option>
        <option value="Sedang">Sedang</option>
        <option value="Berat">Berat</option>
     </select>
    </div>


    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-xl text-base font-bold hover:-translate-y-1 shadow-sm hover:shadow-lg transition-all flex items-center justify-center gap-2">
        <i class="fa-solid fa-upload mr-2"></i>
        <p class="text-sm text-white">Kirim Laporan</p>
       </button>
    </form>
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
