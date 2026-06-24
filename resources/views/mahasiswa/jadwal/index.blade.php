<x-app-layout>
    <x-slot name="header">Jadwal Perkuliahan</x-slot>

    <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-6">

        <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-6">
            {{ count($jadwals) }} jadwal tersedia
        </p>

        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid #C9A84C;">
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">No</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Mata Kuliah</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Dosen</th>
                    <th class="text-center text-gray-400 text-xs uppercase tracking-widest pb-3">Kelas</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Hari</th>
                    <th class="text-left text-gray-400 text-xs uppercase tracking-widest pb-3">Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                <tr style="border-bottom: 1px solid #162032;" class="hover:bg-white hover:bg-opacity-5 transition">
                    <td class="text-gray-500 py-4">{{ $loop->iteration }}</td>
                    <td class="text-gray-200 py-4 font-medium">{{ $jadwal->mataKuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="text-gray-400 py-4">{{ $jadwal->dosen->nama ?? '-' }}</td>
                    <td style="color: #C9A84C;" class="py-4 text-center font-semibold">{{ $jadwal->kelas }}</td>
                    <td class="text-gray-300 py-4">{{ $jadwal->hari }}</td>
                    <td class="text-gray-400 py-4 font-mono text-xs">{{ $jadwal->jam }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-12 text-gray-600">Belum ada jadwal</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>