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

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl border border-gray-200">
        <h1 class="text-xl text-gray-800 font-semibold mb-1">Upload Bukti Transfer</h1>
        <p class="text-sm text-gray-500 mb-6">Pastikan bukti transfer terlihat jelas dan nominal sesuai tagihan</p>

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

        <div class="border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 p-6 text-center mb-8 cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all"
            id="uploadZone" onclick="document.getElementById('fileInput').click()">
            <div
                class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-camera text-2xl text-white"></i>
            </div>
            <h3 class="font-semibold text-gray-800">Klik atau drag bukti transfer</h3>
            <p class="text-gray-500 text-sm">Screenshot dari mobile banking</p>
            <p class="text-gray-500 text-xs">JPG, PNG, PDF • Maks 5MB</p>
            <input type="file" id="fileInput" accept="image/*,.pdf" class="hidden" onclick="handleFileUpload(event)">
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

         <button class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-xl text-base font-bold 
         hover:-translate-y-1 shadow-sm hover:shadow-lg transition-all flex items-center justify-center">
         <i class="fa-solid fa-upload mr-2"></i>
         <p class="text-sm text-white">Kirim Bukti</p>
        </button>

    </div>


@endsection
