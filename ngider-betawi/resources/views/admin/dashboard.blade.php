<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - NgiderBetawi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between p-6">
            <div class="space-y-8">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-600 flex items-center justify-center font-black text-white">NB</div>
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
                <nav class="space-y-2 text-sm font-semibold text-slate-300">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-amber-600 text-white shadow-md">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('admin.pemesanans.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition">
                        <span>📝</span> Data Pemesanan
                    </a>
                </nav>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 text-center text-sm font-bold text-red-400 hover:bg-red-500/10 rounded-xl transition">
                    Keluar / Logout
                </button>
            </form>
        </aside>

        {{-- Content Area --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-black text-slate-900">Dashboard Ringkasan</h1>
                    <p class="text-xs text-slate-500 mt-1">Pantau performa reservasi wisata Padepokan Ciliwung.</p>
                </div>
                <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-200 text-xs font-semibold">
                    👤 {{ auth()->user()->name ?? 'Administrator' }}
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Reservasi</p>
                    <p class="text-3xl font-black text-slate-900 mt-2">{{ $totalPemesanan }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-xs font-bold text-amber-600 uppercase tracking-wider">Status Pending</p>
                    <p class="text-3xl font-black text-amber-600 mt-2">{{ $pemesananPending }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Terkonfirmasi</p>
                    <p class="text-3xl font-black text-emerald-600 mt-2">{{ $pemesananConfirmed }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Est. Pendapatan</p>
                    <p class="text-2xl font-black text-indigo-600 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Table Terbaru --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-900">Reservasi Terbaru</h3>
                    <a href="{{ route('admin.pemesanans.index') }}" class="text-xs font-bold text-amber-600 hover:underline">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-400 border-b border-slate-100">
                            <tr>
                                <th class="p-4">Kode Booking</th>
                                <th class="p-4">Instansi/Pemesan</th>
                                <th class="p-4">Tanggal Kunjungan</th>
                                <th class="p-4">Jumlah</th>
                                <th class="p-4">Total Harga</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($latestBookings as $booking)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 font-bold text-slate-900">{{ $booking->kode_booking }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">{{ $booking->nama_instansi }}</div>
                                    <div class="text-xs text-slate-400">{{ $booking->nama_pemesan }}</div>
                                </td>
                                <td class="p-4">{{ $booking->tanggal_kunjungan }}</td>
                                <td class="p-4">{{ $booking->jumlah_peserta }} Orang</td>
                                <td class="p-4 font-semibold text-slate-900">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-400">Belum ada data pemesanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>