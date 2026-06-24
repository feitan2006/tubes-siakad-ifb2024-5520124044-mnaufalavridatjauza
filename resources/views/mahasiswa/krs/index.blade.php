<x-app-layout>
    <x-slot name="header">KRS Saya</x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div style="border: 1px solid #C9A84C; color: #C9A84C; background-color: #0F1C2E;" class="px-4 py-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="border: 1px solid #ef4444; color: #ef4444; background-color: #0F1C2E;" class="px-4 py-3 rounded text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(!$mahasiswa)
            <div style="border: 1px solid #C9A84C; background-color: #0F1C2E;" class="px-4 py-3 rounded text-sm text-gray-400">
                Data mahasiswa tidak ditemukan. Hubungi admin.
            </div>
        @else

        <!-- Info Banner -->
        <div style="background-color: #0F1C2E; border: 1px solid #C9A84C;" class="rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Mahasiswa</p>
                    <h2 class="text-white text-2xl font-medium" style="font-family: 'Playfair Display', serif;">{{ $mahasiswa->nama }}</h2>
                    <p style="color: #C9A84C;" class="text-sm font-mono mt-1">NPM: {{ $mahasiswa->npm }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-500 text-xs uppercase tracking-widest">Total SKS</p>
                    <p style="color: #C9A84C; font-family: 'Playfair Display', serif;" class="text-5xl font-light">
                        {{ $krs->sum(fn($k) => $k->mataKuliah->sks ?? 0) }}
                    </p>
                    <p class="text-gray-600 text-xs">SKS diambil</p>
                </div>
            </div>
        </div>

        <!-- Ambil MK -->
        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Registrasi</p>
            <h3 class="text-white text-lg mb-4" style="font-family: 'Playfair Display', serif;">Ambil Mata Kuliah</h3>
            @if($mataKuliahs->count() > 0)
            <form action="{{ route('mahasiswa.krs.store') }}" method="POST" class="flex gap-3">
                @csrf
                <select name="kode_matakuliah"
                    style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                    class="flex-1 rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($mataKuliahs as $mk)
                        <option value="{{ $mk->kode_matakuliah }}">
                            {{ $mk->kode_matakuliah }} — {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    style="background-color: #C9A84C;"
                    class="text-white px-6 py-3 rounded text-sm font-medium hover:opacity-90 transition">
                    Ambil
                </button>
            </form>
            @else
                <p class="text-gray-600 text-sm">Semua mata kuliah sudah diambil.</p>
            @endif
        </div>

        <!-- Daftar KRS -->
        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Daftar</p>
            <h3 class="text-white text-lg mb-4" style="font-family: 'Playfair Display', serif;">Mata Kuliah yang Diambil</h3>

            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid #C9A84C;">
                        <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">No</th>
                        <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Kode</th>
                        <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Nama Mata Kuliah</th>
                        <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3">SKS</th>
                        <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $i => $item)
                    <tr style="border-bottom: 1px solid #162032;" class="hover:bg-white hover:bg-opacity-5 transition">
                        <td class="text-gray-500 py-4">{{ $i + 1 }}</td>
                        <td style="color: #C9A84C;" class="py-4 font-mono text-xs">{{ $item->mataKuliah->kode_matakuliah ?? '-' }}</td>
                        <td class="text-gray-200 py-4 font-medium">{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                        <td class="py-4 text-center text-gray-400">{{ $item->mataKuliah->sks ?? '-' }}</td>
                        <td class="py-4 text-center">
                            <form action="{{ route('mahasiswa.krs.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin drop mata kuliah ini?')">
                                @csrf @method('DELETE')
                                <button class="text-gray-600 hover:text-red-400 text-xs uppercase tracking-wide transition">Drop</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-600">Belum ada mata kuliah yang diambil</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @endif
    </div>

</x-app-layout>