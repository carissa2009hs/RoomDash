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
    <button id="btnTambahPenyewa"
        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-full text-sm font-medium transition-all shadow-sm">
        + Tambah Penyewa
    </button>
</div>

<div class="flex flex-wrap items-center justify-between gap-4 mb-8">
    <div class="flex flex-wrap gap-2"></div>
    <div class="flex items-center bg-white border border-gray-200 rounded-full pl-4 pr-1 py-1 shadow-sm w-full max-w-xs">
        <i class="fa-solid fa-magnifying-glass text-sm text-gray-400"></i>
        <input type="text" id="searchInput" placeholder="Cari nama atau kamar"
            class="w-full px-3 py-2 text-sm focus:outline-none bg-transparent">
        <button id="btnCari"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-full text-xs font-medium transition">Cari</button>
    </div>
</div>

<div id="cardContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8"></div>

<div id="modalTambahPenyewa"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h2 class="text-xl font-bold text-gray-900">Tambah Penyewa Baru</h2>
            <button id="btnCloseModal" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <form id="formTambahPenyewa" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                    <input type="tel" name="telepon" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar *</label>
                    <input type="text" name="kamar" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-in *</label>
                <input type="date" name="checkin" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" id="btnBatalModal"
                    class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let allData = [];

    function formatTanggalIndonesia(tanggal) {
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const date = new Date(tanggal);
        return `${String(date.getDate()).padStart(2, '0')} ${bulan[date.getMonth()]} ${date.getFullYear()}`;
    }

    async function loadData() {
        try {
            const response = await fetch('/admin/data-penyewa/data');
            const data = await response.json();
            allData = data;
            renderCards(allData);
        } catch (error) {
            document.getElementById('cardContainer').innerHTML = `
                <div class="col-span-full text-center py-16">
                    <i class="fa-solid fa-exclamation-triangle text-red-400 text-5xl mb-4"></i>
                    <p class="text-red-600 font-semibold">Gagal memuat data</p>
                    <button onclick="loadData()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">Coba Lagi</button>
                </div>
            `;
        }
    }

    function renderCards(data) {
        const container = document.getElementById('cardContainer');
        container.innerHTML = '';

        if (data.length === 0) {
            container.innerHTML = `
                <div class="col-span-full text-center py-16">
                    <i class="fa-solid fa-users text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg font-medium">Belum ada data penyewa</p>
                    <p class="text-gray-400 text-sm mt-2">Klik tombol "+ Tambah Penyewa" untuk menambahkan data</p>
                </div>
            `;
            return;
        }

        data.forEach((penyewa) => {
            const card = `
                <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 text-base truncate">${penyewa.nama}</h3>
                            <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                                <i class="fa-solid fa-envelope text-gray-400 text-[10px]"></i>
                                ${penyewa.email}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone w-4 text-gray-400 text-[10px]"></i>${penyewa.telepon}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-door-closed w-4 text-gray-400 text-[10px]"></i>Kamar ${penyewa.kamar}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar w-4 text-gray-400 text-[10px]"></i>Check-in: ${formatTanggalIndonesia(penyewa.checkin)}
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                        <button onclick="hapusPenyewa(${penyewa.id}, '${penyewa.nama}')"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-600 transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.innerHTML += card;
        });
    }

    function searchData(keyword) {
        keyword = keyword.toLowerCase();
        return allData.filter(p => p.nama.toLowerCase().includes(keyword) || p.kamar.toLowerCase().includes(keyword));
    }

    async function hapusPenyewa(id, nama) {
        if (confirm(`Yakin ingin menghapus ${nama}?`)) {
            try {
                const response = await fetch(`/admin/data-penyewa/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();
                if (result.success) loadData();
            } catch (error) {
                console.error(error);
            }
        }
    }

    const modal = document.getElementById('modalTambahPenyewa');

    document.getElementById('btnTambahPenyewa').addEventListener('click', () => modal.classList.remove('hidden'));
    document.getElementById('btnCloseModal').addEventListener('click', () => {
        modal.classList.add('hidden');
        document.getElementById('formTambahPenyewa').reset();
    });
    document.getElementById('btnBatalModal').addEventListener('click', () => {
        modal.classList.add('hidden');
        document.getElementById('formTambahPenyewa').reset();
    });

    document.getElementById('formTambahPenyewa').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        try {
            const response = await fetch('/admin/data-penyewa', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                await loadData();
                modal.classList.add('hidden');
                e.target.reset();
            }
        } catch (error) {
            console.error(error);
        }
    });

    document.getElementById('btnCari').addEventListener('click', () => renderCards(searchData(document.getElementById('searchInput').value)));
    document.getElementById('searchInput').addEventListener('input', (e) => renderCards(e.target.value === '' ? allData : searchData(e.target.value)));
    document.getElementById('searchInput').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') renderCards(searchData(e.target.value));
    });

    loadData();
</script>

@endsection