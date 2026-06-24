<x-app-layout>
    <x-slot name="header">Edit Jadwal</x-slot>
    <div class="max-w-lg">
        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-8">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Form</p>
            <h3 class="text-white text-xl mb-6" style="font-family: 'Playfair Display', serif;">Edit Jadwal</h3>
            <form action="{{ route('admin.jadwal.update', $jadwal) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-5">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Mata Kuliah</label>
                    <select name="kode_matakuliah" style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                        @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                                {{ $mk->kode_matakuliah }} — {{ $mk->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Dosen</label>
                    <select name="nidn" style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->nidn }}" {{ old('nidn', $jadwal->nidn) == $dosen->nidn ? 'selected' : '' }}>
                                {{ $dosen->nidn }} — {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-3 mb-8">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Kelas</label>
                        <select name="kelas" style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                            class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                            @foreach(['A','B','C','D','E'] as $kelas)
                                <option value="{{ $kelas }}" {{ old('kelas', $jadwal->kelas) == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Hari</label>
                        <select name="hari" style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                            class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Jam</label>
                        <select name="jam" style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                            class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                            @foreach(['07:00-08:40','08:40-10:20','10:20-12:00','13:00-14:40','14:40-16:20','16:20-18:00'] as $jam)
                                <option value="{{ $jam }}" {{ old('jam', $jadwal->jam) == $jam ? 'selected' : '' }}>{{ $jam }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button type="submit" style="background-color: #C9A84C;"
                        class="text-white px-6 py-2.5 rounded text-sm font-medium hover:opacity-90 transition">Update</button>
                    <a href="{{ route('admin.jadwal.index') }}"
                        style="border: 1px solid #2a3a50; color: #6b7280;"
                        class="px-6 py-2.5 rounded text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>