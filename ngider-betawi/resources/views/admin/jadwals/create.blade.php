<x-layouts.admin title="Tambah Jadwal Wisata - Admin" header="Tambah Jadwal & Kuota">

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.jadwals.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-amber-600 mb-4 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Jadwal</span>
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
            <form action="{{ route('admin.jadwals.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', now()->addDay()->format('Y-m-d')) }}" required min="{{ now()->format('Y-m-d') }}"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                    <p class="text-[11px] text-slate-400 mt-1">Pilih tanggal di mana kegiatan wisata akan dibuka.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kapasitas Maksimal Peserta (Kuota)</label>
                    <div class="relative">
                        <input type="number" name="kuota" value="{{ old('kuota', 100) }}" required min="1" max="1000"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        <span class="absolute right-4 top-2.5 text-xs font-bold text-slate-400">Peserta</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Kuota default untuk satu rombongan / batch harian (disarankan 50 - 150 peserta).</p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.jadwals.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-md shadow-amber-600/20 transition">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
