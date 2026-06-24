<x-app-layout>
    <x-slot name="header">Jadwal Perkuliahan</x-slot>

    <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">

        @if(session('success'))
            <div style="border: 1px solid #C9A84C; color: #C9A84C;" class="px-4 py-3 rounded mb-5 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
            <form method="GET" action="{{ route('admin.jadwal.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari mata kuliah atau dosen..."
                    style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                    class="rounded px-4 py-2 text-sm focus:outline-none placeholder-gray-600 focus:border-yellow-600 transition">
                <select name="hari"
                    style="background-color: #162032; border: 1px solid #2a3a50; color: #9ca3af;"
                    class="rounded px-4 py-2 text-sm focus:outline-none focus:border-yellow-600 transition">
                    <option value="">Semua Hari</option>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                        <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }} style="color:white;">{{ $hari }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    style="border: 1px solid #C9A84C; color: #C9A84C;"
                    class="px-4 py-2 rounded text-sm hover:bg-yellow-900 hover:bg-opacity-30 transition">Cari</button>
                @if(request('search') || request('hari'))
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 px-3 py-2 text-sm hover:text-gray-300 transition">Reset</a>
                @endif
            </form>
            <a href="{{ route('admin.jadwal.create') }}"
                style="background-color: #C9A84C;"
                class="text-white px-5 py-2 rounded text-sm font-medium hover:opacity-90 transition">
                + Tambah Jadwal
            </a>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid #C9A84C;">
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">No</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Mata Kuliah</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Dosen</th>
                    <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Kelas</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Hari</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Jam</th>
                    <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                <tr style="border-bottom: 1px solid #162032;" class="hover:bg-white hover:bg-opacity-5 transition">
                    <td class="text-gray-500 py-4 px-2">{{ $loop->iteration }}</td>
                    <td class="text-gray-200 py-4 px-2 font-medium">{{ $jadwal->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="text-gray-400 py-4 px-2">{{ $jadwal->dosen->nama ?? '-' }}</td>
                    <td class="py-4 px-2 text-center" style="color: #C9A84C;">{{ $jadwal->kelas }}</td>
                    <td class="text-gray-300 py-4 px-2">{{ $jadwal->hari }}</td>
                    <td class="text-gray-400 py-4 px-2 font-mono text-xs">{{ $jadwal->jam }}</td>
                    <td class="py-4 px-2 text-center">
                        <a href="{{ route('admin.jadwal.edit', $jadwal) }}"
                            class="text-gray-400 hover:text-yellow-500 text-xs uppercase tracking-wide mr-3 transition">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-gray-600 hover:text-red-400 text-xs uppercase tracking-wide transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-12 text-gray-600">Belum ada jadwal</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">{{ $jadwals->links() }}</div>
    </div>
</x-app-layout>