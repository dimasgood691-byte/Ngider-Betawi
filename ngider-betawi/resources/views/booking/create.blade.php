<x-layouts.app title="Booking Paket Wisata - Ngider Betawi">
    <div class="bg-gradient-to-b from-amber-50/60 via-slate-50 to-white min-h-screen py-12 relative overflow-hidden"
        x-data="{
            pakets: {{ json_encode($pakets) }},
            selectedPaketId: '{{ $selectedPaketId ?? (count($pakets) > 0 ? $pakets[0]->id : '') }}',
            peserta: 25,
            get selectedPaket() {
                return this.pakets.find(p => p.id == this.selectedPaketId) || null;
            },
            get hargaSatuan() {
                return this.selectedPaket ? parseInt(this.selectedPaket.harga) : 0;
            },
            get totalHarga() {
                return this.hargaSatuan * (parseInt(this.peserta) || 0);
            },
            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        }">

        {{-- Background Ambient Glowing Orbs --}}
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-amber-200/20 to-orange-200/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Header Halaman --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4" data-aos="fade-down">
                <div class="gap-3 mb-4 sm:mb-0">
                    <a href="{{ route('home') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold text-amber-800 bg-white/80 hover:bg-white backdrop-blur-md px-4 py-2 rounded-2xl border border-amber-200/80 shadow-xs hover:shadow-md transition-all duration-300 hover:-translate-x-0.5">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-amber-600"></i>
                        <span>Kembali ke Situs</span>
                    </a>
                    <h1 class="text-3xl font-black text-slate-900">Formulir Reservasi Wisata</h1>
                    <p class="text-slate-600 text-sm mt-1">Lengkapi data rombongan dan amankan kuota kunjungan Padepokan Ciliwung Condet.</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('booking.track') }}" class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200/80 text-xs font-bold text-slate-700 hover:text-amber-600 hover:border-amber-300 shadow-xs hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                        <i data-lucide="ticket" class="w-4 h-4 text-amber-600 group-hover:rotate-12 transition-transform"></i>
                        <span>Sudah Punya Tiket? Cek Status</span>
                    </a>
                </div>
            </div>

            {{-- Pesan Alert Validasi Error --}}
            @if ($errors->any())
            <div class="mb-6 p-5 bg-rose-50 border border-rose-200 rounded-3xl text-rose-700 text-sm space-y-1 shadow-sm" data-aos="fade-up">
                <div class="flex items-center gap-2 font-bold text-rose-800 mb-1">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
                    <span>Harap periksa kembali isian formulir:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                @csrf

                {{-- Kolom Kiri: Form Data Pemesan --}}
                <div class="lg:col-span-7 bg-gradient-to-br from-white via-amber-50/20 to-white backdrop-blur-md p-6 sm:p-8 rounded-3xl shadow-sm hover:shadow-md border border-amber-200/60 space-y-6 transition-all duration-300 relative overflow-hidden" data-aos="fade-right">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="text-base sm:text-lg font-black text-slate-900 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-amber-600 text-white text-xs flex items-center justify-center font-bold shadow-sm">1</span>
                            <span>Informasi Pemesan & Rombongan</span>
                        </h2>
                    </div>

                    {{-- Pilih Paket Wisata --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pilihan Paket Wisata</label>
                        <select name="paket_wisata_id" x-model="selectedPaketId" required class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none bg-slate-50/50 hover:bg-white transition-all duration-200">
                            @foreach($pakets as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_paket }} — Rp {{ number_format($p->harga, 0, ',', '.') }} / peserta
                            </option>
                            @endforeach
                        </select>

                        {{-- Dynamic Box Detail Paket --}}
                        <div x-show="selectedPaket"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-3 p-4 rounded-2xl bg-amber-50/70 border border-amber-200/80 text-xs text-slate-700 space-y-2 shadow-xs">
                            <p class="font-semibold text-slate-800" x-text="selectedPaket ? selectedPaket.deskripsi : ''"></p>
                            <template x-if="selectedPaket && selectedPaket.pos_kegiatan && selectedPaket.pos_kegiatan.length > 0">
                                <div>
                                    <span class="font-bold text-amber-800 block mb-1">Misi yang didapatkan:</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        <template x-for="pos in selectedPaket.pos_kegiatan" :key="pos.id">
                                            <span class="px-2 py-0.5 rounded-md bg-white border border-amber-200/80 text-slate-700 font-medium text-[11px] shadow-2xs hover:scale-105 transition-transform" x-text="pos.nama_pos"></span>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Nama Instansi / Sekolah --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Instansi / Sekolah / Komunitas</label>
                        <input type="text" name="nama_instansi" value="{{ old('nama_instansi') }}" required placeholder="Contoh: SMP Negeri 49 Jakarta" class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none hover:border-amber-300 transition-all duration-200">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Penanggung Jawab</label>
                            <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan') }}" required placeholder="Nama lengkap Bapak/Ibu" class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none hover:border-amber-300 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nomor WhatsApp Aktif</label>
                            <input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp') }}" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none hover:border-amber-300 transition-all duration-200">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Penanggung Jawab (Opsional)</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@sekolah.sch.id" class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none hover:border-amber-300 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kategori Jenjang / Usia</label>
                            <select name="rentang_umur" class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none bg-white hover:border-amber-300 transition-all duration-200">
                                <option value="SD / Madrasah Ibtidaiyah">SD / MI (Anak-anak)</option>
                                <option value="SMP / MTs">SMP / MTs (Remaja Awal)</option>
                                <option value="SMA / SMK / MA">SMA / SMK (Remaja)</option>
                                <option value="Mahasiswa / Komunitas">Mahasiswa / Komunitas / Umum</option>
                                <option value="Keluarga">Keluarga & Anak-anak</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Kunjungan</label>
                            <select name="jadwal_wisata_id" required class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none bg-white hover:border-amber-300 transition-all duration-200">
                                <option value="" disabled {{ old('jadwal_wisata_id') ? '' : 'selected' }}>-- Pilih Tanggal --</option>
                                @forelse($jadwals as $j)
                                    <option value="{{ $j->id }}" {{ old('jadwal_wisata_id') == $j->id ? 'selected' : '' }} {{ $j->sisa_kuota <= 0 ? 'disabled' : '' }}>
                                        {{ \Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, D MMMM Y') }} — Sisa Kuota: {{ $j->sisa_kuota }} Slot {{ $j->sisa_kuota <= 0 ? '(Penuh)' : '' }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada jadwal kunjungan tersedia</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Jumlah Peserta (Min. 20)</label>
                            <input type="number" name="jumlah_peserta" x-model.number="peserta" min="20" required class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none font-bold text-slate-800 hover:border-amber-300 transition-all duration-200">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Ada request menu sarapan Nyahi kue cucur, preferensi jam kedatangan, dll." class="w-full px-4 py-3 text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none hover:border-amber-300 transition-all duration-200">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                {{-- Kolom Kanan: Ringkasan Biaya, Pembayaran & Upload Bukti --}}
                <div class="lg:col-span-5 space-y-6" data-aos="fade-left">

                    {{-- Box Estimasi Biaya Interaktif --}}
                    <div class="bg-gradient-to-br from-amber-600 via-orange-600 to-amber-700 rounded-3xl p-6 sm:p-7 text-white shadow-xl shadow-amber-600/20 space-y-4 relative overflow-hidden group">
                        <span class="text-[11px] uppercase font-extrabold tracking-wider bg-white/20 backdrop-blur-md px-3 py-1 rounded-full inline-block border border-white/20">
                            Ringkasan Estimasi Biaya
                        </span>

                        <div class="space-y-2.5 text-xs sm:text-sm text-amber-50">
                            <div class="flex justify-between items-center">
                                <span class="text-amber-100">Paket Terpilih:</span>
                                <span class="font-bold text-white text-right" x-text="selectedPaket ? selectedPaket.nama_paket : '-'"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-amber-100">Harga per Orang:</span>
                                <span class="font-bold text-white" x-text="'Rp ' + formatRupiah(hargaSatuan)"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-amber-100">Jumlah Peserta:</span>
                                <span class="font-bold text-white" x-text="(peserta || 0) + ' Orang'"></span>
                            </div>
                        </div>

                        <div class="pt-3.5 border-t border-white/20 flex justify-between items-center">
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-100">Total Tagihan</span>
                            <span class="text-2xl sm:text-3xl font-black text-white group-hover:scale-105 transition-transform duration-300 origin-right" x-text="'Rp ' + formatRupiah(totalHarga)"></span>
                        </div>
                    </div>

                    {{-- Box Instruksi Transfer Bank / QRIS --}}
                    <div class="bg-gradient-to-br from-white via-amber-50/20 to-white backdrop-blur-md p-6 sm:p-8 rounded-3xl shadow-sm border border-amber-200/60 space-y-5 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h2 class="text-base sm:text-lg font-black text-slate-900 flex items-center gap-2">
                                <span class="w-7 h-7 rounded-full bg-amber-600 text-white text-xs flex items-center justify-center font-bold shadow-sm">2</span>
                                <span>Pembayaran Reservasi</span>
                            </h2>
                        </div>

                        <div class="bg-amber-50/70 p-5 sm:p-6 rounded-3xl border border-amber-200/80 text-center space-y-4 max-w-sm sm:max-w-md mx-auto shadow-sm">
                            <p class="text-xs sm:text-sm font-extrabold text-amber-900 uppercase tracking-wider">Rekening Resmi Padepokan</p>

                            {{-- QRIS Container --}}
                            <div class="bg-white rounded-2xl inline-block shadow-md shadow-amber-900/5 border border-amber-100 hover:scale-105 transition-transform duration-300 w-full max-w-[350px] sm:max-w-[380px] overflow-hidden">
                                <img id="qrisImage" src="{{ asset('qris-pembayaran.png') }}" alt="QRIS Pembayaran" class="w-full h-auto block mx-auto">
                            </div>

                            {{-- Tombol Simpan QRIS dengan Onclick Event --}}
                            <div>
                                <button type="button" onclick="downloadQris()"
                                    class="relative overflow-hidden w-fit mx-auto px-3 py-1.5 text-xs font-bold text-white bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 rounded-xl shadow-md shadow-amber-600/20 active:scale-95 transition-all duration-200 flex items-center justify-center group/btn">
                                    <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                                    <span class="relative z-10 flex items-center justify-center gap-1.5">
                                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                        <span>Simpan QRIS</span>
                                    </span>
                                </button>
                            </div>

                            {{-- Detail Rekening --}}
                            <div class="text-xs sm:text-sm text-slate-700 space-y-1 bg-white p-3.5 sm:p-4 rounded-2xl border border-amber-100 shadow-xs">
                                <p class="font-bold text-slate-900">BCA: <span class="font-mono text-amber-700 font-black text-base sm:text-lg select-all ml-1">123-456-7890</span></p>
                                <p class="text-[11px] sm:text-xs text-slate-500">a.n. <strong>Padepokan Ciliwung Condet</strong></p>
                            </div>
                        </div>

                        {{-- Script Force Download --}}
                        <script>
                            function downloadQris() {
                                const imageUrl = document.getElementById('qrisImage').src;

                                fetch(imageUrl)
                                    .then(response => response.blob())
                                    .then(blob => {
                                        const url = window.URL.createObjectURL(blob);
                                        const a = document.createElement('a');
                                        a.style.display = 'none';
                                        a.href = url;
                                        a.download = 'QRIS-Padepokan-Ciliwung.png';
                                        document.body.appendChild(a);
                                        a.click();
                                        window.URL.revokeObjectURL(url);
                                    })
                                    .catch(() => alert('Gagal mengunduh gambar. Silakan coba lagi.'));
                            }
                        </script>

                        {{-- Upload Bukti Transfer --}}
                        <div class="space-y-1.5" x-data="{ fileName: '' }">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Unggah Bukti Transfer</label>
                            {{-- Input Asli Disembunyikan Tapi Tetap 'required' --}}
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg" required class="hidden"
                                @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                            {{-- Tombol & Nama File Custom --}}
                            <div class="flex items-center gap-3 p-1.5 bg-slate-50/50 border border-slate-200 rounded-2xl hover:border-amber-300 transition-all duration-200">
                                <label for="bukti_pembayaran" class="cursor-pointer inline-flex items-center gap-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-bold text-xs px-4 py-2 rounded-xl transition-all duration-200 active:scale-95 shrink-0">
                                    <i data-lucide="upload" class="w-3.5 h-3.5"></i>
                                    <span>Pilih Bukti</span>
                                </label>
                                <span class="text-xs font-medium truncate pr-2" :class="fileName ? 'text-slate-800' : 'text-slate-400'" x-text="fileName ? fileName : 'Belum ada file dipilih'"></span>
                            </div>
                            <p class="text-[11px] text-slate-400">Format: JPG/PNG, ukuran maks. 2MB</p>
                        </div>

                        <button type="submit" class="relative overflow-hidden w-full py-4 text-sm sm:text-base font-bold text-white bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 rounded-2xl shadow-lg shadow-amber-600/30 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-4 h-4 group-hover/btn:translate-x-1 group-hover/btn:-translate-y-0.5 transition-transform duration-200"></i>
                                <span>Kirim & Konfirmasi Reservasi</span>
                            </span>
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</x-layouts.app>