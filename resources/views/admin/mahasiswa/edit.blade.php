<x-app-layout>
    <x-slot name="header">Edit Mahasiswa</x-slot>
    <div class="max-w-lg">
        <div style="background-color: #0F1C2E; border: 1px solid #1e2d42;" class="rounded-lg p-8">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">Form</p>
            <h3 class="text-white text-xl mb-6" style="font-family: 'Playfair Display', serif;">Edit Data Mahasiswa</h3>
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-5">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">NPM</label>
                    <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm) }}"
                        style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                    @error('npm') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-8">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}"
                        style="background-color: #162032; border: 1px solid #2a3a50; color: #ffffff;"
                        class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition">
                    @error('nama') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" style="background-color: #C9A84C;"
                        class="text-white px-6 py-2.5 rounded text-sm font-medium hover:opacity-90 transition">Update</button>
                    <a href="{{ route('admin.mahasiswa.index') }}"
                        style="border: 1px solid #2a3a50; color: #6b7280;"
                        class="px-6 py-2.5 rounded text-sm hover:border-gray-500 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>