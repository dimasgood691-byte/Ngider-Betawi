<x-layouts.admin title="Dashboard Admin - Ngider Betawi" header="Ringkasan Operasional Wisata">
    
    {{-- Grid 4 Statistik Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        {{-- Total Pemesanan --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Reservasi</span>
                <div class="p-2.5 rounded-2xl bg-amber-50 text-amber-600">
                    <i data-lucide="ticket" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-slate-900 mt-3">{{ $totalPemesanan }}</p>
            <p class="text-xs text-slate-400 mt-1">Seluruh riwayat booking</p>
        </div>

        {{-- Pending Verifikasi --}}
        <div class="bg-white p-6 rounded-3xl border border-amber-200 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Perlu Verifikasi</span>
                <div class="p-2.5 rounded-2xl bg-amber-100 text-amber-700">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-amber-600 mt-3">{{ $pemesananPending }}</p>
            <p class="text-xs text-amber-700/70 mt-1">Bukti transfer belum dicek</p>
        </div>

        {{-- Terkonfirmasi / Tiket Aktif --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Terkonfirmasi</span>
                <div class="p-2.5 rounded-2xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="check-check" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-emerald-600 mt-3">{{ $pemesananConfirmed }}</p>
            <p class="text-xs text-slate-400 mt-1">{{ $totalPeserta }} Total Peserta Hadir</p>
        </div>

        {{-- Estimasi Pendapatan --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Omset Terverifikasi</span>
                <div class="p-2.5 rounded-2xl bg-indigo-50 text-indigo-600">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-2xl font-black text-indigo-600 mt-3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Dari paket terkonfirmasi</p>
        </div>

    </div>

    {{-- Grid Layout: Tabel Reservasi Terbaru & Jadwal Kuota Mendatang --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Kolom Kiri: Tabel Reservasi Terbaru --}}
        <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-black text-slate-900">Pemesanan Terbaru Masuk</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Daftar transaksi dan registrasi terbaru dari website.</p>
                </div>
                <a href="{{ route('admin.pemesanans.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] uppercase font-bold text-slate-400 border-b border-slate-100">
                        <tr>
                            <th class="py-3.5 px-4">Kode & Instansi</th>
                            <th class="py-3.5 px-4">Paket Wisata</th>
                            <th class="py-3.5 px-4">Tgl Kunjungan</th>
                            <th class="py-3.5 px-4">Peserta & Total</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($latestBookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4">
                                <span class="font-mono font-bold text-slate-900 block">{{ $booking->kode_booking }}</span>
                                <span class="font-medium text-slate-700 block truncate max-w-[160px]">{{ $booking->asal_sekolah }}</span>
                                <span class="text-[10px] text-slate-400">{{ $booking->nama_lengkap }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-semibold text-slate-800 block">{{ $booking->paketWisata->nama_paket ?? '-' }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($booking->jadwalWisata->tanggal ?? $booking->created_at)->format('d M Y') }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-slate-800">{{ $booking->jumlah_peserta }} org</span>
                                <span class="text-[11px] text-amber-600 block font-semibold">Rp {{ number_format(($booking->paketWisata->harga ?? 0) * $booking->jumlah_peserta, 0, ',', '.') }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($booking->status === 'dikonfirmasi' || $booking->status === 'terverifikasi')
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">Terkonfirmasi</span>
                                @elseif($booking->status === 'ditolak')
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-rose-100 text-rose-800">Ditolak</span>
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">Pending</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <a href="{{ route('admin.pemesanans.show', $booking->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-amber-600 hover:text-white text-slate-700 font-bold text-[11px] transition">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">Belum ada transaksi pemesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Kolom Kanan: Jadwal Mendatang & Quick Action --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Quick Actions Card --}}
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white p-6 rounded-3xl shadow-sm space-y-4">
                <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider">Aksi Cepat Admin</h3>
                <div class="space-y-2 text-xs">
                    <a href="{{ route('admin.pemesanans.index') }}" class="flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/20 transition">
                        <span class="flex items-center gap-2"><i data-lucide="check-square" class="w-4 h-4 text-amber-400"></i> Verifikasi Bukti Bayar</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('admin.pakets.create') }}" class="flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/20 transition">
                        <span class="flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-emerald-400"></i> Tambah Paket Wisata</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('admin.jadwals.create') }}" class="flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/20 transition">
                        <span class="flex items-center gap-2"><i data-lucide="calendar-plus" class="w-4 h-4 text-sky-400"></i> Buka Slot Kuota Wisata</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            {{-- Kuota Jadwal Mendatang --}}
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-black text-slate-900">Jadwal & Kuota Mendatang</h3>
                    <a href="{{ route('admin.jadwals.index') }}" class="text-[11px] font-bold text-amber-600 hover:underline">Kelola</a>
                </div>

                <div class="space-y-3">
                    @forelse($upcomingJadwals as $j)
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, D MMM Y') }}</p>
                            <p class="text-[11px] text-slate-400">Sisa Kuota: {{ $j->sisa_kuota }} / {{ $j->kuota }} org</p>
                        </div>
                        <div class="w-16 bg-slate-200 h-2 rounded-full overflow-hidden">
                            @php
                                $percent = $j->kuota > 0 ? (($j->kuota - $j->sisa_kuota) / $j->kuota) * 100 : 0;
                            @endphp
                            <div class="bg-amber-600 h-full rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 text-center py-4">Belum ada data jadwal mendatang.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</x-layouts.admin>
