<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('logo-ngiderbetawi.png') }}">
    <title>{{ $title ?? 'Admin Panel - Ngider Betawi' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    <div class="h-full min-h-full flex flex-col lg:flex-row">

        {{-- Mobile Sidebar Backdrop --}}
        <div x-show="sidebarOpen"
            style="display: none;"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs lg:hidden"></div>

        {{-- Sidebar Navigation --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 flex flex-col justify-between transition-transform duration-300 ease-in-out lg:sticky lg:top-0 lg:bottom-auto lg:h-screen lg:self-start lg:shrink-0 lg:translate-x-0">

            <div class="flex-1 min-h-0 overflow-y-auto p-6 space-y-6">
                {{-- Logo & Brand --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo" class="w-10 h-10 object-contain rounded-xl">
                        <div>
                            <span class="text-lg font-black tracking-tight text-white block leading-none">
                                Ngider<span class="text-amber-600">Betawi</span>
                            </span>
                            <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                                Administrator Panel
                            </span>
                        </div>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                {{-- Navigation Links --}}
                <nav class="space-y-1.5 text-xs font-semibold">
                    <p class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Utama</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.pemesanans.index') }}"
                        class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pemesanans.*') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="ticket" class="w-4 h-4"></i>
                            <span>Data Pemesanan</span>
                        </div>
                        @php
                            $pendingCount = \App\Models\Pemesanan::where('status', 'menunggu_verifikasi')->count();
                        @endphp
                        @if($pendingCount > 0)
                        <span class="px-2 py-0.5 text-[10px] font-black rounded-full bg-amber-600 text-slate-900">
                            {{ $pendingCount }}
                        </span>
                        @endif
                    </a>

                    <p class="px-3 pt-4 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Wisata & Kegiatan</p>

                    <a href="{{ route('admin.pakets.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pakets.*') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <i data-lucide="package" class="w-4 h-4"></i>
                        <span>Paket Wisata</span>
                    </a>

                    <a href="{{ route('admin.pos.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pos.*') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Pos Kegiatan Edukasi</span>
                    </a>

                    <a href="{{ route('admin.jadwals.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.jadwals.*') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Jadwal & Kuota</span>
                    </a>

                    <p class="px-3 pt-4 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Kelola LandingPage</p>

                    <a href="{{ route('admin.konten.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.konten.*') ? 'bg-amber-600 text-white font-bold shadow-md shadow-amber-600/30' : 'hover:bg-slate-800 hover:text-white text-slate-300' }}">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                        <span>Kelola Konten (Galeri/Testimoni)</span>
                    </a>
                </nav>
            </div>

            {{-- User Info & Logout Button --}}
            <div class="shrink-0 p-6 border-t border-slate-800 bg-slate-950/40 space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-600 text-white font-black text-xs flex items-center justify-center shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@ngiderbetawi.com' }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-slate-800 hover:bg-rose-600/20 text-slate-300 hover:text-rose-400 font-bold text-xs flex items-center justify-center gap-2 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>

        </aside>

        {{-- Main Content Container --}}
        <div class="flex-1 flex flex-col min-w-0 min-h-0 overflow-hidden">

            {{-- Top Header Bar --}}
            <header class="bg-white border-b border-slate-200 sticky top-0 z-30 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-black text-slate-900">{{ $header ?? 'Admin Panel' }}</h1>
                        <p class="text-xs text-slate-400">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pemesanans.index') }}" class="relative p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition" title="Notifikasi Pemesanan">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        @if($pendingCount > 0)
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-amber-500 rounded-full animate-ping"></span>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-amber-500 rounded-full"></span>
                        @endif
                    </a>
                </div>
            </header>

            {{-- Flash Alert Messages --}}
            <main class="flex-1 min-h-0 p-6 sm:p-8 overflow-y-auto space-y-6">
                @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                {{ $slot }}
            </main>

        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
