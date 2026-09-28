<x-layouts.admin title="Edit Pos Kegiatan - Admin" header="Edit Pos Kegiatan Edukasi">

    <div class="max-w-2xl mx-auto">
        <a href="{{ route('admin.pos.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-amber-600 mb-4 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Pos</span>
        </a>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-xs">
            <form action="{{ route('admin.pos.update', $pos->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Pos Kegiatan</label>
                    <input type="text" name="nama_pos" value="{{ old('nama_pos', $pos->nama_pos) }}" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Deskripsi Singkat Pos</label>
                    <textarea name="deskripsi" rows="3" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">{{ old('deskripsi', $pos->deskripsi) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tantangan Siswa (Challenge Misi)</label>
                    <textarea name="challenge" rows="2" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">{{ old('challenge', $pos->challenge) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Hadiah / Cap Misi (Reward)</label>
                    <input type="text" name="reward" value="{{ old('reward', $pos->reward) }}" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.pos.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-md shadow-amber-600/20 transition">
                        Perbarui Pos
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
