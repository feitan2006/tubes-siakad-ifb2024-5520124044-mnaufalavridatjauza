<x-app-layout>
    <x-slot name="header">Tambah Mata Kuliah</x-slot>
    <div class="max-w-lg">
        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-8">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Form</p>
            <h3 class="text-white text-xl mb-6" style="font-family: 'Playfair Display', serif;">Tambah Mata Kuliah</h3>
            <form action="{{ route('admin.mata-kuliah.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Kode Mata Kuliah</label>
                    <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}" placeholder="Contoh: MK001"
                        style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition placeholder-gray-600">
                    @error('kode_matakuliah') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}" placeholder="Nama mata kuliah..."
                        style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition placeholder-gray-600">
                    @error('nama_matakuliah') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-8">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">SKS</label>
                    <select name="sks"
                        style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                        <option value="">-- Pilih SKS --</option>
                        @foreach([1,2,3,4,5,6] as $sks)
                            <option value="{{ $sks }}" {{ old('sks') == $sks ? 'selected' : '' }}>{{ $sks }} SKS</option>
                        @endforeach
                    </select>
                    @error('sks') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" style="background-color: #C9A84C;"
                        class="text-white px-6 py-2.5 rounded text-sm font-medium hover:opacity-90 transition">Simpan</button>
                    <a href="{{ route('admin.mata-kuliah.index') }}"
                        style="border: 1px solid #2a3a50; color: #6b7280;"
                        class="px-6 py-2.5 rounded text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>