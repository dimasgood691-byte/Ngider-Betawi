<x-layouts.admin title="Pos Kegiatan & Challenge Edukasi - Admin" header="Kelola Pos Misi & Gamifikasi">

    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-xs text-slate-500">Daftar pos rute Cultural Quest Ngider Betawi beserta tantangan (challenge) dan hadiah (reward) cap misi.</p>
        </div>
        <a href="{{ route('admin.pos.create') }}"
            class="px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-amber-600/20 transition">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Pos Misi Baru</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posKegiatans as $idx => $pos)
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs hover:shadow-md transition p-6 flex flex-col justify-between group">
            <div class="space-y-4">
                {{-- Header Pos Card --}}
                <div class="flex justify-between items-start">
                    <span class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 font-black text-sm flex items-center justify-center">
                        #{{ $idx + 1 }}
                    </span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.pos.edit', $pos->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-slate-100 transition" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('admin.pos.destroy', $pos->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pos {{ $pos->nama_pos }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div>
                    <h3 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition">{{ $pos->nama_pos }}</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $pos->deskripsi }}</p>
                </div>

                {{-- Box Challenge --}}
                <div class="p-3.5 rounded-2xl bg-amber-50/60 border border-amber-200/60 text-xs space-y-1">
                    <span class="text-[10px] font-bold text-amber-800 uppercase tracking-wider flex items-center gap-1">
                        <i data-lucide="target" class="w-3.5 h-3.5 text-amber-600"></i> Tantangan Siswa (Challenge)
                    </span>
                    <p class="font-medium text-slate-800 leading-relaxed">{{ $pos->challenge }}</p>
                </div>

                {{-- Box Reward --}}
                <div class="p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/60 text-xs space-y-1">
                    <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider flex items-center gap-1">
                        <i data-lucide="award" class="w-3.5 h-3.5 text-emerald-600"></i> Penghargaan / Cap (Reward)
                    </span>
                    <p class="font-medium text-slate-800 leading-relaxed">{{ $pos->reward }}</p>
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400">
                <span>Dipakai pada <strong>{{ $pos->paket_wisata_count }}</strong> paket</span>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-200 text-center text-slate-400">
            <i data-lucide="map-pin" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
            <p class="text-sm font-semibold">Belum ada pos misi kegiatan.</p>
            <a href="{{ route('admin.pos.create') }}" class="mt-3 inline-block text-xs font-bold text-amber-600 hover:underline">Buat pos pertama sekarang →</a>
        </div>
        @endforelse
    </div>

</x-layouts.admin>
