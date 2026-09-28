<x-layouts.app title="Pemesanan Berhasil - Ngider Betawi">
    <div class="bg-gradient-to-b from-amber-50/70 via-slate-50 to-white min-h-screen py-12 relative overflow-hidden">
        {{-- Background Ambient Glowing Orbs --}}
        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-gradient-to-tr from-emerald-200/20 to-amber-200/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="zoom-in" data-aos-duration="600">
            
            {{-- Card Sukses --}}
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-amber-200/80 text-center relative overflow-hidden hover:shadow-2xl transition-all duration-300">
                {{-- Ornamen Atas --}}
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 via-orange-500 to-emerald-600"></div>

                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute -inset-2 bg-emerald-400/30 rounded-3xl blur-md animate-pulse"></div>
                    <div class="relative w-20 h-20 rounded-3xl bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-md shadow-emerald-500/20 border border-emerald-200/60">
                        <i data-lucide="check-circle" class="w-10 h-10"></i>
                    </div>
                </div>

                <span class="inline-block px-3.5 py-1 bg-emerald-100 text-emerald-800 font-extrabold text-xs rounded-full uppercase tracking-wider mb-2 border border-emerald-200/60 shadow-2xs">
                    Reservasi Terkirim
                </span>

                <h1 class="text-2xl sm:text-3xl font-black text-slate-900">Alhamdulillah, Pesanan Diterima!</h1>
                <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                    Terima kasih telah memesan paket wisata edukasi <strong>Ngider Betawi</strong>. Bukti pembayaran kamu sedang diproses dan diverifikasi oleh admin kami.
                </p>

                {{-- Box Kode Booking (dengan Fitur Copy Interaktif) --}}
                <div class="my-8 p-6 rounded-2xl bg-amber-50/80 border border-dashed border-amber-300 relative group"
                    x-data="{ copied: false }">
                    <p class="text-xs font-bold text-amber-800 uppercase tracking-widest">Kode Booking Kamu</p>
                    <div class="flex items-center justify-center gap-2 my-2">
                        <span class="text-3xl sm:text-4xl font-mono font-black text-amber-600 tracking-wider">
                            {{ $pemesanan->kode_booking }}
                        </span>
                        <button type="button"
                            @click="navigator.clipboard.writeText('{{ $pemesanan->kode_booking }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="p-2 rounded-xl bg-white border border-amber-200 text-amber-700 hover:bg-amber-100 transition shadow-2xs text-xs font-bold flex items-center gap-1"
                            title="Salin Kode">
                            <i data-lucide="copy" class="w-4 h-4" x-show="!copied"></i>
                            <i data-lucide="check" class="w-4 h-4 text-emerald-600" x-show="copied" x-cloak></i>
                            <span x-text="copied ? 'Tersalin!' : 'Salin'"></span>
                        </button>
                    </div>
                    <p class="text-xs text-slate-500">Simpan kode ini untuk mengecek status tiket atau konfirmasi kehadiran.</p>
                </div>

                {{-- Ringkasan Pesanan Singkat --}}
                <div class="text-left bg-slate-50/80 rounded-2xl p-5 border border-slate-200/60 text-xs sm:text-sm space-y-2.5 shadow-2xs">
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500">Nama Instansi/Sekolah:</span>
                        <span class="font-bold text-slate-800">{{ $pemesanan->asal_sekolah }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500">Paket Wisata:</span>
                        <span class="font-bold text-slate-800">{{ $pemesanan->paketWisata->nama_paket ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500">Tanggal Kunjungan:</span>
                        <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($pemesanan->jadwalWisata->tanggal ?? now())->isoFormat('dddd, D MMMM Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500">Jumlah Peserta:</span>
                        <span class="font-bold text-slate-800">{{ $pemesanan->jumlah_peserta }} Peserta</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
                        <span class="text-slate-500">Total Biaya:</span>
                        <span class="font-black text-amber-600">Rp {{ number_format(($pemesanan->paketWisata->harga ?? 0) * $pemesanan->jumlah_peserta, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-slate-500">Status Saat Ini:</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                            {{ ucfirst(str_replace('_', ' ', $pemesanan->status)) }}
                        </span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('booking.track', ['code' => $pemesanan->kode_booking]) }}" class="relative overflow-hidden flex-1 py-3.5 px-6 rounded-2xl bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 text-white font-bold text-sm shadow-md shadow-amber-600/20 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                        <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                        <span class="relative z-10 flex items-center gap-2">
                            <i data-lucide="ticket" class="w-4 h-4 group-hover/btn:rotate-12 transition-transform duration-200"></i>
                            <span>Lihat & Cetak Tiket</span>
                        </span>
                    </a>
                    <a href="{{ route('home') }}" class="flex-1 py-3.5 px-6 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm shadow-xs transition flex items-center justify-center gap-2">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>

                {{-- WhatsApp Support --}}
                <p class="text-xs text-slate-400 mt-6">
                    Butuh bantuan konfirmasi cepat? Hubungi kami via 
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ngider%20Betawi,%20saya%20sudah%20booking%20dengan%20Kode:%20{{ $pemesanan->kode_booking }}" target="_blank" class="text-emerald-600 font-bold hover:underline inline-flex items-center gap-1">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5 inline"></i> WhatsApp Admin
                    </a>.
                </p>
            </div>

        </div>
    </div>
</x-layouts.app>
