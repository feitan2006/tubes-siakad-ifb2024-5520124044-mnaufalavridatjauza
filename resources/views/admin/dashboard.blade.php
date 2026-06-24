<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @foreach([
            ['label' => 'Dosen', 'value' => $totalDosen, 'route' => 'admin.dosen.index'],
            ['label' => 'Mahasiswa', 'value' => $totalMahasiswa, 'route' => 'admin.mahasiswa.index'],
            ['label' => 'Mata Kuliah', 'value' => $totalMataKuliah, 'route' => 'admin.mata-kuliah.index'],
            ['label' => 'Jadwal', 'value' => $totalJadwal, 'route' => 'admin.jadwal.index'],
            ['label' => 'KRS', 'value' => $totalKrs, 'route' => 'admin.krs.index'],
        ] as $stat)
        <a href="{{ route($stat['route']) }}"
            style="background-color: #0F1C2E; border: 1px solid #1e2d42;"
            class="rounded-lg p-5 hover:border-yellow-700 transition group">
            <p class="text-gray-400 text-xs uppercase tracking-widest mb-2">{{ $stat['label'] }}</p>
            <p style="color: #C9A84C;" class="text-4xl font-light">{{ $stat['value'] }}</p>
            <p class="text-gray-600 text-xs mt-2 group-hover:text-yellow-600 transition">Lihat data →</p>
        </a>
        @endforeach
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Statistik</p>
            <h3 class="text-white font-medium text-lg mb-4" style="font-family: 'Playfair Display', serif;">Mahasiswa Paling Aktif</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid #1e2d42;">
                        <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Mahasiswa</th>
                        <th class="text-right text-gray-400 text-xs uppercase tracking-widest pb-3">MK</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krsPerMahasiswa as $item)
                    <tr style="border-bottom: 1px solid #162032;" class="hover:bg-opacity-50 transition">
                        <td class="text-gray-300 py-3">{{ $item->mahasiswa->nama ?? $item->npm }}</td>
                        <td class="text-right py-3">
                            <span style="color: #C9A84C;" class="font-semibold">{{ $item->total }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-gray-600 text-center py-6">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Statistik</p>
            <h3 class="text-white font-medium text-lg mb-4" style="font-family: 'Playfair Display', serif;">Mata Kuliah Terpopuler</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid #1e2d42;">
                        <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Mata Kuliah</th>
                        <th class="text-right text-gray-400 text-xs uppercase tracking-widest pb-3">Peminat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataKuliahTerpopuler as $item)
                    <tr style="border-bottom: 1px solid #162032;" class="transition">
                        <td class="text-gray-300 py-3">{{ $item->mataKuliah->nama_matakuliah ?? $item->kode_matakuliah }}</td>
                        <td class="text-right py-3">
                            <span style="color: #C9A84C;" class="font-semibold">{{ $item->total }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-gray-600 text-center py-6">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Quick Access -->
    <div style="border-top: 1px solid #d4c5a0;" class="pt-8">
        <p style="color: #6b5d3f;" class="text-xs uppercase tracking-widest mb-4">Akses Cepat</p>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            @foreach([
                ['label' => 'Data Dosen', 'route' => 'admin.dosen.index'],
                ['label' => 'Data Mahasiswa', 'route' => 'admin.mahasiswa.index'],
                ['label' => 'Mata Kuliah', 'route' => 'admin.mata-kuliah.index'],
                ['label' => 'Jadwal', 'route' => 'admin.jadwal.index'],
                ['label' => 'KRS', 'route' => 'admin.krs.index'],
            ] as $menu)
            <a href="{{ route($menu['route']) }}"
                style="border: 1px solid #d4c5a0; color: #6b5d3f;"
                class="rounded px-4 py-3 text-center text-sm hover:bg-yellow-900 hover:bg-opacity-20 hover:text-yellow-700 transition tracking-wide">
                {{ $menu['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</x-app-layout>