<x-layouts.admin title="Edit Paket Wisata - Admin" header="Edit Paket Wisata Edukasi">

    <div class="max-w-2xl mx-auto">
        <a href="{{ route('admin.pakets.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-amber-600 mb-4 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Paket</span>
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
            <form action="{{ route('admin.pakets.update', $paket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Paket Wisata</label>
                    <input type="text" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Harga per Peserta (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $paket->harga) }}" required min="0"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Deskripsi Lengkap Paket</label>
                    <textarea name="deskripsi" rows="4" required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                </div>

                <div class="space-y-1.5" x-data="{ fileName: '', imagePreview: null }">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Ganti Foto Sampul (Opsional)</label>
                    {{-- Preview Foto Sampul --}}
                    <div class="mb-2">
                        {{-- Preview jika ada file baru yang dipilih --}}
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Preview File Baru" class="w-32 h-20 object-cover rounded-xl border border-amber-300 shadow-sm">
                        </template>
                        {{-- Preview gambar lama dari database (hanya muncul jika belum pilih file baru) --}}
                        @if($paket->gambar)
                        <template x-if="!imagePreview">
                            <img src="{{ Str::startsWith($paket->gambar, 'http') ? $paket->gambar : asset('storage/' . $paket->gambar) }}"
                                alt="Preview Gambar Saat Ini" class="w-32 h-20 object-cover rounded-xl border border-slate-200">
                        </template>
                        @endif
                    </div>
                    {{-- Input Asli Disembunyikan --}}
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden"
                        @change="
                                const file = $event.target.files[0];
                                    if (file) {
                                    fileName = file.name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { imagePreview = e.target.result; };
                                        reader.readAsDataURL(file);
                                    } else {
                                    fileName = '';
                                    imagePreview = null;
                                    }
                                ">
                    {{-- Tombol & Nama File Custom --}}
                    <div class="flex items-center gap-3 p-1.5 bg-slate-50/50 border border-slate-200 rounded-xl hover:border-amber-300 transition-all duration-200">
                        <label for="gambar" class="cursor-pointer inline-flex items-center gap-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-bold text-xs px-3.5 py-1.5 rounded-lg transition-all duration-200 active:scale-95 shrink-0">
                            <i data-lucide="image-plus" class="w-3.5 h-3.5"></i>
                            <span>Pilih Sampul</span>
                        </label>
                        <span class="text-xs font-medium truncate pr-2" :class="fileName ? 'text-slate-800' : 'text-slate-400'" x-text="fileName ? fileName : 'Belum ada gambar baru dipilih'"></span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilih Pos Misi Kegiatan yang Termasuk</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 p-4 bg-slate-50 rounded-2xl border border-slate-100 max-h-56 overflow-y-auto">
                        @foreach($posKegiatans as $pos)
                        <label class="flex items-start gap-2.5 p-2 rounded-xl bg-white border border-slate-200/60 hover:border-amber-400 cursor-pointer text-xs transition">
                            <input type="checkbox" name="pos_kegiatan_ids[]" value="{{ $pos->id }}"
                                {{ in_array($pos->id, old('pos_kegiatan_ids', $selectedPos)) ? 'checked' : '' }}
                                class="w-4 h-4 text-amber-600 rounded border-slate-300 focus:ring-amber-500 mt-0.5">
                            <div>
                                <span class="font-bold text-slate-800 block">{{ $pos->nama_pos }}</span>
                                <span class="text-[10px] text-slate-400 line-clamp-1">{{ $pos->challenge }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.pakets.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-md shadow-amber-600/20 transition">
                        Perbarui Paket
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>