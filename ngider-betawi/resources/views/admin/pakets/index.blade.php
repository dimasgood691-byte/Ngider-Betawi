<x-layouts.admin title="Paket Wisata Edukasi - Admin" header="Kelola Paket Wisata Edukasi">

    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-xs text-slate-500">Kelola paket wisata edukasi, harga per peserta, dan penetapan pos misi kegiatan.</p>
        </div>
        <a href="{{ route('admin.pakets.create') }}"
            class="px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-amber-600/20 transition">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Paket Wisata</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pakets as $p)
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs hover:shadow-md transition p-6 flex flex-col justify-between group">
            <div class="space-y-4">
                {{-- Badge & Actions --}}
                <div class="flex justify-between items-start">
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-800">
                        {{ $p->pos_kegiatan_count }} Pos Misi
                    </span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.pakets.edit', $p->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-slate-100 transition" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('admin.pakets.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket {{ $p->nama_paket }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Gambar Paket jika ada --}}
                @if($p->gambar)
                <div class="relative overflow-hidden rounded-2xl aspect-video bg-slate-100">
                    <img src="{{ Str::startsWith($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_paket }}" class="w-full h-full object-cover">
                </div>
                @endif

                <div>
                    <h3 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition">{{ $p->nama_paket }}</h3>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $p->deskripsi }}</p>
                </div>

                {{-- Harga --}}
                <div class="pt-3 border-t border-slate-100 flex items-baseline justify-between">
                    <span class="text-xs text-slate-400 font-medium">Harga / Peserta:</span>
                    <span class="text-lg font-black text-amber-600">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                </div>

                {{-- Pos Kegiatan List --}}
                @if($p->posKegiatan && $p->posKegiatan->count() > 0)
                <div class="space-y-1.5 pt-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Misi Termasuk:</span>
                    <div class="flex flex-wrap gap-1">
                        @foreach($p->posKegiatan as $pos)
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[10px] font-semibold">{{ $pos->nama_pos }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="pt-4 mt-4 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400 font-medium">
                <span>{{ $p->pemesanan_count }} total pemesanan</span>
                <a href="{{ route('booking.create', $p->id) }}" target="_blank" class="text-amber-600 font-bold hover:underline flex items-center gap-1 text-[11px]">
                    <span>Coba Booking</span>
                    <i data-lucide="external-link" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-200 text-center text-slate-400">
            <i data-lucide="package" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
            <p class="text-sm font-semibold">Belum ada paket wisata edukasi.</p>
            <a href="{{ route('admin.pakets.create') }}" class="mt-3 inline-block text-xs font-bold text-amber-600 hover:underline">Tambah paket pertama sekarang →</a>
        </div>
        @endforelse
    </div>

</x-layouts.admin>
