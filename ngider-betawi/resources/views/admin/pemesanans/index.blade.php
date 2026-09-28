<x-layouts.admin title="Data Pemesanan & Reservasi - Admin Ngider Betawi" header="Manajemen Pemesanan Wisata">

    {{-- Filter Tab Status & Search Bar --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-5">
        <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4">
            
            {{-- Tab Status Pills --}}
            <div class="flex flex-wrap gap-2 text-xs font-bold">
                <a href="{{ route('admin.pemesanans.index') }}"
                    class="px-4 py-2 rounded-xl transition {{ empty($status) ? 'bg-amber-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua ({{ $counts['all'] }})
                </a>
                <a href="{{ route('admin.pemesanans.index', ['status' => 'menunggu_verifikasi']) }}"
                    class="px-4 py-2 rounded-xl transition {{ $status === 'menunggu_verifikasi' ? 'bg-amber-500 text-white shadow-xs' : 'bg-amber-50 text-amber-800 hover:bg-amber-100' }}">
                    Menunggu Verifikasi ({{ $counts['menunggu_verifikasi'] }})
                </a>
                <a href="{{ route('admin.pemesanans.index', ['status' => 'dikonfirmasi']) }}"
                    class="px-4 py-2 rounded-xl transition {{ $status === 'dikonfirmasi' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}">
                    Terkonfirmasi ({{ $counts['dikonfirmasi'] }})
                </a>
                <a href="{{ route('admin.pemesanans.index', ['status' => 'ditolak']) }}"
                    class="px-4 py-2 rounded-xl transition {{ $status === 'ditolak' ? 'bg-rose-600 text-white shadow-xs' : 'bg-rose-50 text-rose-800 hover:bg-rose-100' }}">
                    Ditolak ({{ $counts['ditolak'] }})
                </a>
            </div>

            {{-- Form Search --}}
            <form action="{{ route('admin.pemesanans.index') }}" method="GET" class="flex items-center gap-2">
                @if(!empty($status))
                <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative w-full md:w-64">
                    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari kode/instansi/nama..."
                        class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                </div>
                <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-xs font-bold transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    {{-- Tabel Pemesanan --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase font-bold text-slate-400 border-b border-slate-100">
                    <tr>
                        <th class="py-4 px-5">Kode Booking</th>
                        <th class="py-4 px-5">Instansi & Pemesan</th>
                        <th class="py-4 px-5">Paket Wisata</th>
                        <th class="py-4 px-5">Jadwal Kunjungan</th>
                        <th class="py-4 px-5">Peserta & Total Tagihan</th>
                        <th class="py-4 px-5">Bukti Bayar</th>
                        <th class="py-4 px-5">Status</th>
                        <th class="py-4 px-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pemesanans as $p)
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-4 px-5">
                            <span class="font-mono font-black text-amber-700 block text-sm">{{ $p->kode_booking }}</span>
                            <span class="text-[10px] text-slate-400">{{ $p->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="py-4 px-5">
                            <span class="font-bold text-slate-900 block text-xs">{{ $p->asal_sekolah }}</span>
                            <span class="text-slate-500 block">{{ $p->nama_lengkap }} ({{ $p->no_telepon }})</span>
                            <span class="text-[10px] text-slate-400">{{ $p->rentang_umur }}</span>
                        </td>
                        <td class="py-4 px-5">
                            <span class="font-semibold text-slate-800 block">{{ $p->paketWisata->nama_paket ?? '-' }}</span>
                            <span class="text-[11px] text-slate-400">Rp {{ number_format($p->paketWisata->harga ?? 0, 0, ',', '.') }}/org</span>
                        </td>
                        <td class="py-4 px-5">
                            <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($p->jadwalWisata->tanggal ?? $p->created_at)->isoFormat('dddd, D MMM Y') }}</span>
                        </td>
                        <td class="py-4 px-5">
                            <span class="font-bold text-slate-900 block">{{ $p->jumlah_peserta }} Peserta</span>
                            <span class="font-black text-amber-600 block text-xs">
                                Rp {{ number_format(($p->paketWisata->harga ?? 0) * $p->jumlah_peserta, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-5">
                            @php
                                $bayar = $p->pembayaran()->latest()->first();
                            @endphp
                            @if($bayar && $bayar->bukti_file)
                                <a href="{{ asset('storage/' . $bayar->bukti_file) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-600 hover:text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">
                                    <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                    <span>Lihat File</span>
                                </a>
                            @else
                                <span class="text-slate-400 text-[11px] italic">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="py-4 px-5">
                            @if($p->status === 'dikonfirmasi' || $p->status === 'terverifikasi')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">
                                    <i data-lucide="check" class="w-3 h-3"></i> Terkonfirmasi
                                </span>
                            @elseif($p->status === 'ditolak')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold rounded-full bg-rose-100 text-rose-800">
                                    <i data-lucide="x" class="w-3 h-3"></i> Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">
                                    <i data-lucide="clock" class="w-3 h-3"></i> Menunggu Verifikasi
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.pemesanans.show', $p->id) }}"
                                    class="p-2 rounded-xl bg-amber-50 hover:bg-amber-600 hover:text-white text-amber-700 transition" title="Lihat & Verifikasi">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('admin.pemesanans.print', $p->id) }}" target="_blank"
                                    class="p-2 rounded-xl bg-slate-100 hover:bg-slate-800 hover:text-white text-slate-700 transition" title="Cetak Tiket">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.pemesanans.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pemesanan {{ $p->kode_booking }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-600 transition" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-10 text-center text-slate-400">
                            <i data-lucide="inbox" class="w-8 h-8 mx-auto text-slate-300 mb-2"></i>
                            <p class="text-sm">Belum ada data pemesanan yang sesuai dengan filter.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pemesanans->hasPages())
        <div class="p-5 border-t border-slate-100">
            {{ $pemesanans->links() }}
        </div>
        @endif
    </div>

</x-layouts.admin>
