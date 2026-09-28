<x-layouts.admin title="Edit Jadwal Wisata - Admin" header="Perbarui Jadwal & Kuota">

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

        @php
            $terpakai = $jadwal->kuota - $jadwal->sisa_kuota;
        @endphp

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-xs space-y-6">
            {{-- Info kuota terpakai --}}
            <div class="p-4 bg-amber-50/70 border border-amber-200/70 rounded-2xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-900">Status Penggunaan Kuota</p>
                    <p class="text-[11px] text-amber-700">Sudah terpesan: <strong>{{ $terpakai }} peserta</strong> dari total {{ $jadwal->kuota }} peserta.</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black text-amber-800">{{ $jadwal->sisa_kuota }} Slot Sisa</span>
                </div>
            </div>

            <form action="{{ route('admin.jadwals.update', $jadwal->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kapasitas Maksimal Peserta (Kuota)</label>
                    <div class="relative">
                        <input type="number" name="kuota" value="{{ old('kuota', $jadwal->kuota) }}" required min="{{ $terpakai }}" max="1000"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        <span class="absolute right-4 top-2.5 text-xs font-bold text-slate-400">Peserta</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Minimal {{ $terpakai }} peserta (karena sudah ada slot reservasi yang terisi).</p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.jadwals.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-md shadow-amber-600/20 transition">
                        Perbarui Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
