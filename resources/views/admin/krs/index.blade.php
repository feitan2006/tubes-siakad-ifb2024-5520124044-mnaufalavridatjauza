<x-app-layout>
    <x-slot name="header">Data KRS</x-slot>

    <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500 text-sm">Total <span style="color: #C9A84C;" class="font-semibold">{{ $krs->total() }}</span> data KRS</p>
            <div class="flex gap-3">
                <a href="{{ route('admin.krs.export.excel') }}"
                    style="border: 1px solid #C9A84C; color: #C9A84C;"
                    class="px-4 py-2 rounded text-sm hover:bg-yellow-900 hover:bg-opacity-30 transition">
                    Export Excel
                </a>
                <a href="{{ route('admin.krs.export.pdf') }}"
                    style="background-color: #C9A84C;"
                    class="text-white px-4 py-2 rounded text-sm hover:opacity-90 transition">
                    Export PDF
                </a>
            </div>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid #C9A84C;">
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">No</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">NPM</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Nama Mahasiswa</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Mata Kuliah</th>
                    <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $item)
                <tr style="border-bottom: 1px solid #162032;" class="hover:bg-white hover:bg-opacity-5 transition">
                    <td class="text-gray-500 py-4 px-2">{{ $loop->iteration }}</td>
                    <td class="py-4 px-2 font-mono text-xs" style="color: #C9A84C;">{{ $item->mahasiswa->npm ?? '-' }}</td>
                    <td class="text-gray-200 py-4 px-2 font-medium">{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td class="text-gray-400 py-4 px-2">{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="py-4 px-2 text-center text-gray-300">{{ $item->mataKuliah->sks ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-600">Belum ada data KRS</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">{{ $krs->links() }}</div>
    </div>
</x-app-layout>