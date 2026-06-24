<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .gold { color: #C9A84C; }
        .bg-gold { background-color: #C9A84C; }
        .border-gold { border-color: #C9A84C; }
        .navy { color: #0F1C2E; }
        .bg-navy { background-color: #0F1C2E; }
        .bg-navy-light { background-color: #162032; }
        .bg-navy-dark { background-color: #0A1320; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { padding-left: 1.5rem; }
        .hover-gold:hover { color: #C9A84C; }
    </style>
</head>
<body class="bg-gray-100" style="background-color: #f0ede8;">

    <!-- Navbar -->
    <nav style="background-color: #0F1C2E;" class="shadow-xl sticky top-0 z-50">
        <div class="px-8 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('mahasiswa.dashboard') }}"
                class="flex items-center gap-3">
                <div style="border: 1px solid #C9A84C;" class="w-10 h-10 rounded flex items-center justify-center">
                    <span style="color: #C9A84C; font-family: 'Playfair Display', serif;" class="font-bold text-lg">S</span>
                </div>
                <div>
                    <p style="font-family: 'Playfair Display', serif; color: #ffffff;" class="font-semibold text-lg leading-none tracking-wide">
                        SIAKAD
                    </p>
                    <p style="color: #C9A84C;" class="text-xs tracking-widest uppercase">Sistem Informasi Akademik</p>
                </div>
            </a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex items-center gap-8">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Dashboard</a>
                <a href="{{ route('admin.dosen.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Dosen</a>
                <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Mahasiswa</a>
                <a href="{{ route('admin.mata-kuliah.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Mata Kuliah</a>
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Jadwal</a>
                <a href="{{ route('admin.krs.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">KRS</a>
                @else
                <a href="{{ route('mahasiswa.dashboard') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Dashboard</a>
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">Jadwal</a>
                <a href="{{ route('mahasiswa.krs.index') }}" class="text-gray-300 hover-gold text-sm tracking-wide transition">KRS Saya</a>
                @endif
            </div>

            <!-- User -->
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest">{{ auth()->user()->role }}</p>
                </div>
                <a href="{{ route('logout') }}"
                    style="border: 1px solid #C9A84C; color: #C9A84C;"
                    class="hover:bg-yellow-800 hover:bg-opacity-30 text-sm font-medium px-4 py-2 rounded transition tracking-wide">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        @if(isset($header))
        <div class="mb-8">
            <p style="color: #C9A84C;" class="text-xs uppercase tracking-widest mb-1">SIAKAD</p>
            <h1 style="font-family: 'Playfair Display', serif; color: #0F1C2E;" class="text-3xl font-semibold">{{ $header }}</h1>
            <div style="background-color: #C9A84C;" class="h-0.5 w-12 mt-3"></div>
        </div>
        @endif

        {{ $slot }}
    </main>

    <footer style="background-color: #0F1C2E;" class="mt-16 py-6 text-center">
        <p style="color: #C9A84C;" class="text-xs tracking-widest uppercase">SIAKAD © {{ date('Y') }} — Sistem Informasi Akademik</p>
    </footer>

</body>
</html>