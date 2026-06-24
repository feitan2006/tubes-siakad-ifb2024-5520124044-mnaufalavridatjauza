<x-guest-layout>
<div class="w-full max-w-md">

    <!-- Logo -->
    <div class="text-center mb-10">
        <div style="border: 1px solid #C9A84C;" class="w-16 h-16 rounded mx-auto flex items-center justify-center mb-4">
            <span style="color: #C9A84C; font-family: 'Playfair Display', serif;" class="font-bold text-3xl">S</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; color: #ffffff;" class="text-3xl font-semibold">SIAKAD</h1>
        <p style="color: #C9A84C;" class="text-xs tracking-widest uppercase mt-1">Sistem Informasi Akademik</p>
    </div>

    <!-- Card -->
    <div style="background-color: #162032; border: 1px solid #1e2d42;" class="rounded-lg p-8 shadow-2xl">

        <h2 class="text-white text-lg font-medium mb-6 text-center">Masuk ke Akun Anda</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="email@example.com"
                    style="background-color: #0F1C2E; border: 1px solid #2a3a50; color: #ffffff;"
                    class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition placeholder-gray-600">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required
                    placeholder="••••••••"
                    style="background-color: #0F1C2E; border: 1px solid #2a3a50; color: #ffffff;"
                    class="w-full rounded px-4 py-3 text-sm focus:outline-none focus:border-yellow-600 transition placeholder-gray-600">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-400">Ingat Saya</label>
            </div>

            <button type="submit"
                style="background-color: #C9A84C;"
                class="w-full hover:opacity-90 text-white font-semibold py-3 rounded transition text-sm tracking-widest uppercase">
                Masuk
            </button>
        </form>

        <div style="border-top: 1px solid #1e2d42;" class="mt-6 pt-4 text-center">
            <p class="text-xs text-gray-600">admin@siakad.com / mahasiswa@siakad.com — password: password</p>
        </div>

    </div>
</div>
</x-guest-layout>