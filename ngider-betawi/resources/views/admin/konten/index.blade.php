<x-layouts.admin title="Kelola Konten - Ngider Betawi" header="Manajemen Konten Website">

    {{-- Tab Navigation --}}
    <div x-data="{ tab: window.location.hash === '#galeri' ? 'galeri' : (window.location.hash === '#testimoni' ? 'testimoni' : 'funfact') }">

        <div class="flex gap-1 bg-slate-100 rounded-2xl p-1 w-fit mb-6">
            <button @click="tab = 'funfact'" :class="tab === 'funfact' ? 'bg-white shadow text-slate-900 font-bold' : 'text-slate-500 hover:text-slate-700'"
                class="px-4 py-2 text-sm rounded-xl transition flex items-center gap-2">
                <i data-lucide="book-open" class="w-4 h-4"></i> Fun Fact Betawi
                <span class="px-2 py-0.5 text-[10px] font-black rounded-full bg-amber-100 text-amber-700">{{ $funfacts->count() }}</span>
            </button>
            <button @click="tab = 'galeri'" :class="tab === 'galeri' ? 'bg-white shadow text-slate-900 font-bold' : 'text-slate-500 hover:text-slate-700'"
                class="px-4 py-2 text-sm rounded-xl transition flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4"></i> Galeri Foto
                <span class="px-2 py-0.5 text-[10px] font-black rounded-full bg-sky-100 text-sky-700">{{ $galeris->count() }}</span>
            </button>
            <button @click="tab = 'testimoni'" :class="tab === 'testimoni' ? 'bg-white shadow text-slate-900 font-bold' : 'text-slate-500 hover:text-slate-700'"
                class="px-4 py-2 text-sm rounded-xl transition flex items-center gap-2">
                <i data-lucide="star" class="w-4 h-4"></i> Testimoni
                <span class="px-2 py-0.5 text-[10px] font-black rounded-full bg-emerald-100 text-emerald-700">{{ $testimonis->count() }}</span>
            </button>
        </div>

        {{-- ============================= --}}
        {{-- TAB 1: FUN FACT BETAWI        --}}
        {{-- ============================= --}}
        <div x-show="tab === 'funfact'" x-transition>
            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Form Tambah Fun Fact --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6">
                        <h3 class="font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-amber-500"></i>
                            Tambah Fun Fact
                        </h3>
                        <form action="{{ route('admin.konten.funfact.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Fun Fact</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none @error('judul') border-red-400 @enderror"
                                    placeholder="cth: Asal Usul Ondel-Ondel">
                                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Isi / Deskripsi</label>
                                <textarea name="isi" rows="4" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none resize-none @error('isi') border-red-400 @enderror"
                                    placeholder="Tuliskan fakta menarik tentang kebudayaan Betawi...">{{ old('isi') }}</textarea>
                                @error('isi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1.5" x-data="{ fileName: '', imagePreview: null }">
                                <label class="block text-xs font-semibold text-slate-600">
                                    Gambar <span class="text-slate-400 font-normal">(opsional)</span>
                                </label>
                                {{-- Live Preview Gambar Baru --}}
                                <template x-if="imagePreview">
                                    <div class="mb-2">
                                        <img :src="imagePreview" alt="Preview Gambar" class="w-32 h-20 object-cover rounded-xl border border-amber-300 shadow-sm">
                                    </div>
                                </template>
                                {{-- Input File Asli (Disembunyikan) --}}
                                <input type="file" id="gambar_opsional" name="gambar" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden"
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
                                <div class="flex items-center gap-3 p-1.5 bg-slate-50/50 border rounded-xl transition-all duration-200 @error('gambar') border-red-500 @else border-slate-200 hover:border-amber-300 @enderror">
                                    <label for="gambar_opsional" class="cursor-pointer inline-flex items-center gap-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-bold text-xs px-3.5 py-1.5 rounded-lg transition-all duration-200 active:scale-95 shrink-0">
                                        <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                        <span>Pilih Gambar</span>
                                    </label>
                                    <span class="text-xs font-medium truncate pr-2" :class="fileName ? 'text-slate-800' : 'text-slate-400'" x-text="fileName ? fileName : 'Belum ada gambar dipilih'"></span>
                                </div>
                                {{-- Pesan Error Validation Laravel --}}
                                @error('gambar')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm rounded-xl transition flex items-center justify-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Fun Fact
                            </button>
                        </form>
                    </div>
                </div>

                {{-- List Fun Facts --}}
                <div class="lg:col-span-2 space-y-3">
                    @forelse($funfacts as $funfact)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-4 flex items-start gap-4">
                        @if($funfact->gambar)
                        <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}"
                            class="w-16 h-16 object-cover rounded-xl shrink-0">
                        @else
                        <div class="w-16 h-16 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <i data-lucide="book-open" class="w-6 h-6 text-amber-400"></i>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-slate-800 text-sm">{{ $funfact->judul }}</p>
                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-2">{{ $funfact->isi }}</p>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $funfact->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="{{ route('admin.konten.funfact.destroy', $funfact->id) }}" method="POST"
                            onsubmit="return confirm('Hapus fun fact ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-10 text-center">
                        <i data-lucide="book-open" class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>
                        <p class="text-sm font-semibold text-slate-400">Belum ada fun fact</p>
                        <p class="text-xs text-slate-400 mt-1">Tambahkan fakta menarik kebudayaan Betawi lewat form di samping.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ============================= --}}
        {{-- TAB 2: GALERI FOTO            --}}
        {{-- ============================= --}}
        <div x-show="tab === 'galeri'" x-transition style="display:none">
            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Form Upload Galeri --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6">
                        <h3 class="font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i data-lucide="upload" class="w-5 h-5 text-sky-500"></i>
                            Upload Foto
                        </h3>
                        <form action="{{ route('admin.konten.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Foto</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-400 focus:border-transparent outline-none @error('judul') border-red-400 @enderror"
                                    placeholder="cth: Kegiatan Melukis Topeng">
                                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1.5" x-data="{ fileName: '', imagePreview: null }">
                                <label class="block text-xs font-semibold text-slate-600">
                                    File Foto <span class="text-red-500">*</span>
                                </label>
                                {{-- Live Preview Gambar --}}
                                <template x-if="imagePreview">
                                    <div class="mb-2">
                                        <img :src="imagePreview" alt="Preview Foto" class="w-32 h-20 object-cover rounded-xl border border-amber-300 shadow-sm">
                                    </div>
                                </template>
                                {{-- Input File Asli (Disembunyikan, Tetap Required) --}}
                                <input type="file" id="foto_wajib" name="gambar" accept="image/jpeg,image/png,image/jpg,image/webp" required class="hidden"
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
                                <div class="flex items-center gap-3 p-1.5 bg-slate-50/50 border rounded-xl transition-all duration-200 @error('gambar') border-red-500 @else border-slate-200 hover:border-sky-300 @enderror">
                                    <label for="foto_wajib" class="cursor-pointer inline-flex items-center gap-1.5 bg-sky-500 hover:bg-sky-600 text-white font-bold text-xs px-3.5 py-1.5 rounded-lg transition-all duration-200 active:scale-95 shrink-0">
                                        <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                                        <span>Pilih Foto</span>
                                    </label>
                                    <span class="text-xs font-medium truncate pr-2" :class="fileName ? 'text-slate-800' : 'text-slate-400'" x-text="fileName ? fileName : 'Belum ada foto dipilih'"></span>
                                </div>
                                <p class="text-[11px] text-slate-400">JPG/PNG/WebP, maks. 3MB</p>
                                {{-- Pesan Error Validation Laravel --}}
                                @error('gambar')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-bold text-sm rounded-xl transition flex items-center justify-center gap-2">
                                <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload Foto
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Grid Galeri --}}
                <div class="lg:col-span-2">
                    @if($galeris->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($galeris as $galeri)
                        <div class="relative group rounded-2xl overflow-hidden border border-slate-200 shadow-xs aspect-square bg-slate-100">
                            <img src="{{ Storage::url($galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-3">
                                <p class="text-white text-xs font-bold truncate">{{ $galeri->judul }}</p>
                                <form action="{{ route('admin.konten.galeri.destroy', $galeri->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus foto ini?')" class="mt-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-[10px] font-bold rounded-lg transition flex items-center gap-1">
                                        <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-10 text-center h-full flex flex-col items-center justify-center">
                        <i data-lucide="image" class="w-10 h-10 text-slate-300 mb-3"></i>
                        <p class="text-sm font-semibold text-slate-400">Belum ada foto galeri</p>
                        <p class="text-xs text-slate-400 mt-1">Upload foto dokumentasi kegiatan wisata melalui form di samping.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ============================= --}}
        {{-- TAB 3: TESTIMONI              --}}
        {{-- ============================= --}}
        <div x-show="tab === 'testimoni'" x-transition style="display:none">
            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Form Tambah Testimoni --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6">
                        <h3 class="font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i data-lucide="star" class="w-5 h-5 text-emerald-500"></i>
                            Tambah Testimoni
                        </h3>
                        <form action="{{ route('admin.konten.testimoni.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Sekolah / Instansi</label>
                                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah') }}" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-400 focus:border-transparent outline-none @error('nama_sekolah') border-red-400 @enderror"
                                    placeholder="cth: SDN Condet 01 Pagi">
                                @error('nama_sekolah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Isi Testimoni</label>
                                <textarea name="isi" rows="4" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-400 focus:border-transparent outline-none resize-none @error('isi') border-red-400 @enderror"
                                    placeholder="Tuliskan ulasan dari sekolah/instansi...">{{ old('isi') }}</textarea>
                                @error('isi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Rating (1-5)</label>
                                <div class="flex gap-1" x-data="{ rating: {{ old('rating', 5) }} }">
                                    <input type="hidden" name="rating" :value="rating">
                                    <template x-for="i in 5" :key="i">
                                        <button type="button" @click="rating = i"
                                            :class="i <= rating ? 'text-amber-400' : 'text-slate-300'"
                                            class="text-2xl hover:text-amber-400 transition">★</button>
                                    </template>
                                    <span class="ml-2 text-sm font-bold text-slate-600 self-center" x-text="rating + '/5'"></span>
                                </div>
                                @error('rating') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm rounded-xl transition flex items-center justify-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Testimoni
                            </button>
                        </form>
                    </div>
                </div>

                {{-- List Testimoni --}}
                <div class="lg:col-span-2 space-y-3">
                    @forelse($testimonis as $testimoni)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-5 flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                            <i data-lucide="school" class="w-5 h-5 text-emerald-500"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-slate-800 text-sm">{{ $testimoni->nama_sekolah }}</p>
                                <div class="flex items-center gap-0.5 text-amber-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $testimoni->rating ? '★' : '☆' }}</span>
                                        @endfor
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $testimoni->isi }}</p>
                            <p class="text-[10px] text-slate-400 mt-2">{{ $testimoni->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="{{ route('admin.konten.testimoni.destroy', $testimoni->id) }}" method="POST"
                            onsubmit="return confirm('Hapus testimoni ini?')" class="shrink-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-10 text-center">
                        <i data-lucide="star" class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>
                        <p class="text-sm font-semibold text-slate-400">Belum ada testimoni</p>
                        <p class="text-xs text-slate-400 mt-1">Tambahkan ulasan dari sekolah/instansi melalui form di samping.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>