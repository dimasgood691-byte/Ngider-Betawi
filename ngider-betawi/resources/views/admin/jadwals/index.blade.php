<x-layouts.admin title="Jadwal & Kuota Wisata - Admin" header="Kelola Jadwal & Kuota Wisata">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <p class="text-xs text-slate-500">Atur ketersediaan tanggal kunjungan dan batasan kuota harian peserta wisata edukasi.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.jadwals.create') }}"
                class="px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-amber-600/20 transition">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Jadwal & Kuota</span>
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider">Total Jadwal</span>
                <i data-lucide="calendar" class="w-4 h-4 text-amber-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</p>
            <p class="text-[11px] text-slate-400 mt-1">Tanggal terdaftar</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider">Mendatang</span>
                <i data-lucide="clock" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-900">{{ $stats['upcoming'] }}</p>
            <p class="text-[11px] text-slate-400 mt-1">Jadwal aktif ke depan</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider">Total Kapasitas</span>
                <i data-lucide="users" class="w-4 h-4 text-indigo-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-900">{{ number_format($stats['total_kuota']) }}</p>
            <p class="text-[11px] text-slate-400 mt-1">Peserta keseluruhan</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider">Sisa Kuota Aktif</span>
                <i data-lucide="user-check" class="w-4 h-4 text-amber-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-900">{{ number_format($stats['sisa_kuota']) }}</p>
            <p class="text-[11px] text-slate-400 mt-1">Slot masih tersedia</p>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs mb-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Filter:</span>
            <a href="{{ route('admin.jadwals.index') }}"
                class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ !request('filter') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua
            </a>
            <a href="{{ route('admin.jadwals.index', ['filter' => 'upcoming']) }}"
                class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ request('filter') === 'upcoming' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Mendatang
            </a>
            <a href="{{ route('admin.jadwals.index', ['filter' => 'past']) }}"
                class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ request('filter') === 'past' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Lewat
            </a>
        </div>
    </div>

    {{-- Table Jadwal --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Tanggal Kunjungan</th>
                        <th class="py-3.5 px-6">Status Waktu</th>
                        <th class="py-3.5 px-6">Kapasitas (Kuota)</th>
                        <th class="py-3.5 px-6">Sisa Kuota</th>
                        <th class="py-3.5 px-6">Pemesanan</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwals as $jadwal)
                    @php
                        $isPast = \Carbon\Carbon::parse($jadwal->tanggal)->isPast() && !\Carbon\Carbon::parse($jadwal->tanggal)->isToday();
                        $terisi = $jadwal->kuota - $jadwal->sisa_kuota;
                        $persen = $jadwal->kuota > 0 ? round(($terisi / $jadwal->kuota) * 100) : 0;
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl {{ $isPast ? 'bg-slate-100 text-slate-500' : 'bg-amber-50 text-amber-700' }} font-black flex flex-col items-center justify-center border border-amber-200/40">
                                    <span class="text-xs leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</span>
                                    <span class="text-[9px] uppercase tracking-tight">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('M') }}</span>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                    <p class="text-[11px] text-slate-400">ID #{{ $jadwal->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if(\Carbon\Carbon::parse($jadwal->tanggal)->isToday())
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                Hari Ini
                            </span>
                            @elseif($isPast)
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600">
                                Selesai
                            </span>
                            @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-100 text-blue-800">
                                Mendatang
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-bold text-slate-700">
                            {{ $jadwal->kuota }} Peserta
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1 max-w-[140px]">
                                <div class="flex justify-between items-center text-[11px] font-bold">
                                    <span class="{{ $jadwal->sisa_kuota > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $jadwal->sisa_kuota }} sisa
                                    </span>
                                    <span class="text-slate-400">{{ $persen }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $persen >= 100 ? 'bg-rose-500' : ($persen > 70 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-bold">
                                {{ $jadwal->pemesanan_count }} Reservasi
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.jadwals.edit', $jadwal->id) }}"
                                    class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-slate-100 transition"
                                    title="Edit Kuota">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                @if($jadwal->pemesanan_count == 0)
                                <form action="{{ route('admin.jadwals.destroy', $jadwal->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal tanggal {{ $jadwal->tanggal }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-slate-400">
                            <i data-lucide="calendar" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                            <p class="text-sm font-semibold">Belum ada jadwal wisata yang ditambahkan.</p>
                            <a href="{{ route('admin.jadwals.create') }}" class="mt-2 inline-block text-xs font-bold text-amber-600 hover:underline">
                                Tambah jadwal baru sekarang →
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jadwals->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $jadwals->links() }}
        </div>
        @endif
    </div>

</x-layouts.admin>
