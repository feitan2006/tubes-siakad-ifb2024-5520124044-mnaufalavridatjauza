<x-app-layout>
    <x-slot name="header">Data Mahasiswa</x-slot>

    <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">

        @if(session('success'))
            <div style="border: 1px solid #C9A84C; color: #C9A84C;" class="px-4 py-3 rounded mb-5 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
            <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau NPM..."
                    style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                    class="rounded px-4 py-2 text-sm focus:outline-none placeholder-gray-600 focus:border-yellow-600 transition">
                <button type="submit"
                    style="border: 1px solid #C9A84C; color: #C9A84C;"
                    class="px-4 py-2 rounded text-sm hover:bg-yellow-900 hover:bg-opacity-30 transition">
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-500 px-3 py-2 text-sm hover:text-gray-300 transition">Reset</a>
                @endif
            </form>
            <a href="{{ route('admin.mahasiswa.create') }}"
                style="background-color: #C9A84C;"
                class="text-white px-5 py-2 rounded text-sm font-medium hover:opacity-90 transition">
                + Tambah Mahasiswa
            </a>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid #C9A84C;">
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">No</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">NPM</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Nama</th>
                    <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3 px-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $mahasiswa)
                <tr style="border-bottom: 1px solid #162032;" class="hover:bg-white hover:bg-opacity-5 transition">
                    <td class="text-gray-500 py-4 px-2">{{ $loop->iteration }}</td>
                    <td class="py-4 px-2 font-mono text-xs" style="color: #C9A84C;">{{ $mahasiswa->npm }}</td>
                    <td class="text-gray-200 py-4 px-2 font-medium">{{ $mahasiswa->nama }}</td>
                    <td class="py-4 px-2 text-center">
                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}"
                            class="text-gray-400 hover:text-yellow-500 text-xs uppercase tracking-wide mr-3 transition">Edit</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-gray-600 hover:text-red-400 text-xs uppercase tracking-wide transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-gray-600">Belum ada data mahasiswa</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">{{ $mahasiswas->links() }}</div>
    </div>

</x-app-layout>