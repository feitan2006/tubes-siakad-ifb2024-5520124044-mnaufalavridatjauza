<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Greeting -->
    <div style="background-color: #0F1C2E; border: 1px solid #C9A84C;" class="rounded-lg p-8 mb-8">
        <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-2">Selamat Datang</p>
        <h2 class="text-white text-3xl font-light mb-1" style="font-family: 'Playfair Display', serif;">
            {{ auth()->user()->name }}
        </h2>
        <p class="text-gray-500 text-sm">Sistem Informasi Akademik — SIAKAD</p>
    </div>

    <!-- Menu -->
    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('mahasiswa.jadwal.index') }}"
            style="background-color: #0F1C2E; border: 1px solid #1e2d42;"
            class="rounded-lg p-8 hover:border-yellow-700 transition group">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-3">Akademik</p>
            <h3 class="text-white text-xl mb-2" style="font-family: 'Playfair Display', serif;">Jadwal Kuliah</h3>
            <p class="text-gray-600 text-sm group-hover:text-yellow-600 transition">Lihat jadwal perkuliahan →</p>
        </a>
        <a href="{{ route('mahasiswa.krs.index') }}"
            style="background-color: #0F1C2E; border: 1px solid #C9A84C;"
            class="rounded-lg p-8 hover:border-yellow-500 transition group">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-3">Registrasi</p>
            <h3 class="text-white text-xl mb-2" style="font-family: 'Playfair Display', serif;">KRS Saya</h3>
            <p class="text-gray-600 text-sm group-hover:text-yellow-600 transition">Ambil & kelola mata kuliah →</p>
        </a>
    </div>

</x-app-layout>