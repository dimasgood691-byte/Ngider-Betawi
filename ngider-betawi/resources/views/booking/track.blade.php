<x-layouts.app title="Cek Status Tiket & Booking - Ngider Betawi">
    <div class="bg-gradient-to-b from-amber-50/60 via-slate-50 to-white min-h-screen py-8 sm:py-12 relative overflow-hidden">
        {{-- Background Ambient Glowing Orbs --}}
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[300px] sm:w-[600px] h-[300px] sm:h-[600px] bg-gradient-to-tr from-amber-200/20 to-orange-200/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Header --}}
            <div class="text-center mb-6 sm:mb-8" data-aos="fade-down">
                <div class="flex justify-start gap-3 mb-4 sm:mb-6">
                    <a href="{{ route('home') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold text-amber-800 bg-white/80 hover:bg-white backdrop-blur-md px-4 py-2 rounded-2xl border border-amber-200/80 shadow-xs hover:shadow-md transition-all duration-300 hover:-translate-x-0.5">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-amber-600"></i>
                        <span>Kembali ke Situs</span>
                    </a>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Lacak Status Reservasi</h1>
                <p class="text-slate-600 text-xs sm:text-sm mt-1.5 max-w-lg mx-auto leading-relaxed">Masukkan Kode Booking (contoh: <code class="px-1.5 py-0.5 rounded bg-amber-100/80 text-amber-800 font-mono text-xs font-bold">NB-ABC123</code>) atau Nomor WhatsApp yang Anda daftarkan.</p>
            </div>

            {{-- Form Pencarian Tracking --}}
            <div class="bg-gradient-to-br from-white via-amber-50/20 to-white backdrop-blur-md p-4 sm:p-6 lg:p-8 rounded-3xl shadow-sm hover:shadow-md border border-amber-200/60 mb-8 transition-all duration-300 relative overflow-hidden" data-aos="fade-up">
                <form action="{{ route('booking.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1 group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-600 transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="code" value="{{ $query ?? '' }}" required
                            placeholder="Ketik Kode Booking atau Nomor WA..."
                            class="w-full pl-12 pr-4 py-3.5 text-xs sm:text-sm rounded-2xl border border-slate-200 focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none uppercase tracking-wider font-semibold hover:border-amber-300 transition-all duration-200">
                    </div>
                    <button type="submit" class="relative overflow-hidden w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 text-white font-bold text-sm shadow-md shadow-amber-600/20 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group/btn shrink-0">
                        <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                        <span class="relative z-10 flex items-center gap-2">
                            <span>Cari Pesanan</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-200"></i>
                        </span>
                    </button>
                </form>
            </div>

            @if(isset($query) && empty($pemesanan))
            {{-- Not Found Alert --}}
            <div class="bg-rose-50/80 border border-rose-200 rounded-3xl p-5 sm:p-8 text-center space-y-3 shadow-xs" data-aos="zoom-in">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mx-auto shadow-sm">
                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                </div>
                <h3 class="text-base font-bold text-rose-900">Pesanan Tidak Ditemukan</h3>
                <p class="text-xs sm:text-sm text-rose-700 max-w-md mx-auto leading-relaxed break-words">
                    Kami tidak menemukan pemesanan dengan kata kunci "<strong>{{ $query }}</strong>". Pastikan kode booking atau nomor WhatsApp yang Anda masukkan sudah benar.
                </p>
            </div>
            @endif

            @if(!empty($pemesanan))
            {{-- Kartu Tiket Digital --}}
            <div class="bg-white rounded-3xl shadow-xl border border-amber-200/80 overflow-hidden hover:shadow-2xl transition-all duration-300 print:border-none print:shadow-none" id="printableTicket" data-aos="fade-up">

                {{-- Header Tiket --}}
                <div class="bg-gradient-to-r from-amber-600 via-orange-600 to-amber-700 p-5 sm:p-8 text-white relative">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo" class="w-10 h-10 sm:w-12 sm:h-12 object-contain bg-white/20 rounded-2xl p-1 backdrop-blur-sm shadow-inner shrink-0">
                            <div>
                                <h2 class="text-base sm:text-xl font-black tracking-tight leading-snug sm:leading-normal">TIKET RESERVASI WISATA EDUKASI</h2>
                                <p class="text-[11px] sm:text-xs text-amber-100">Padepokan Ciliwung Condet - Ngider Betawi</p>
                            </div>
                        </div>
                        <div class="text-left sm:text-right border-t border-amber-500/40 sm:border-t-0 pt-3 sm:pt-0">
                            <span class="text-[10px] sm:text-xs font-semibold text-amber-200 block uppercase mb-1">Status Verifikasi</span>
                            @if($pemesanan->status === 'dikonfirmasi' || $pemesanan->status === 'terverifikasi')
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold shadow-sm w-fit">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                <i data-lucide="check-check" class="w-3.5 h-3.5"></i> Terkonfirmasi
                            </span>
                            @elseif($pemesanan->status === 'ditolak')
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-rose-500 text-white rounded-full text-xs font-bold shadow-sm w-fit">
                                <i data-lucide="x-circle" class="w-3.5 h-3.5"></i> Ditolak
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-amber-400 text-slate-900 rounded-full text-xs font-bold shadow-sm w-fit">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-900 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-slate-900"></span>
                                </span>
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i> Menunggu Verifikasi
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Body Tiket --}}
                <div class="p-5 sm:p-8 space-y-6 sm:space-y-8">
                    {{-- Kode & Barcode --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center p-4 sm:p-6 bg-amber-50/60 rounded-2xl border border-amber-100/80 shadow-2xs">
                        <div x-data="{ copied: false }" class="text-center sm:text-left">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kode Booking</span>
                            <div class="flex items-center justify-center sm:justify-start gap-2 mt-1">
                                <p class="text-2xl sm:text-3xl font-mono font-black text-amber-700 tracking-wider break-all">{{ $pemesanan->kode_booking }}</p>
                                <button type="button"
                                    @click="navigator.clipboard.writeText('{{ $pemesanan->kode_booking }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="p-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-100 transition shadow-2xs text-xs shrink-0"
                                    title="Salin Kode">
                                    <i data-lucide="copy" class="w-3.5 h-3.5" x-show="!copied"></i>
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600" x-show="copied" x-cloak></i>
                                </button>
                            </div>
                            <p class="text-[11px] sm:text-xs text-slate-500 mt-1">Dipesan pada {{ $pemesanan->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="flex flex-col items-center sm:items-end">
                            <div class="bg-white p-2.5 rounded-xl border border-amber-200 inline-block shadow-xs hover:scale-105 transition-transform duration-300">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode($pemesanan->kode_booking) }}" alt="QR Code" class="w-20 h-20 sm:w-24 sm:h-24">
                            </div>
                            <span class="text-[10px] text-slate-400 mt-1.5 text-center sm:text-right">Scan saat registrasi ulang di lokasi</span>
                        </div>
                    </div>

                    {{-- Rincian Peserta & Paket --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3 sm:space-y-4">
                            <h3 class="text-xs sm:text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2 flex items-center gap-1.5">
                                <i data-lucide="user" class="w-4 h-4 text-amber-600"></i>
                                <span>Detail Pemesan</span>
                            </h3>
                            <div class="text-xs sm:text-sm space-y-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Nama Instansi/Sekolah:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right break-words">{{ $pemesanan->asal_sekolah }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Penanggung Jawab:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right break-words">{{ $pemesanan->nama_lengkap }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Nomor WhatsApp:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right break-all">{{ $pemesanan->no_telepon }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Kategori Usia:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right">{{ $pemesanan->rentang_umur }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 sm:space-y-4">
                            <h3 class="text-xs sm:text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2 flex items-center gap-1.5">
                                <i data-lucide="calendar" class="w-4 h-4 text-amber-600"></i>
                                <span>Detail Kunjungan</span>
                            </h3>
                            <div class="text-xs sm:text-sm space-y-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Paket Wisata:</span>
                                    <span class="font-bold text-amber-700 text-left sm:text-right break-words">{{ $pemesanan->paketWisata->nama_paket ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Tanggal Kunjungan:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right">{{ \Carbon\Carbon::parse($pemesanan->jadwalWisata->tanggal ?? now())->isoFormat('dddd, D MMMM Y') }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Jumlah Peserta:</span>
                                    <span class="font-bold text-slate-800 text-left sm:text-right">{{ $pemesanan->jumlah_peserta }} Orang</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-50 gap-0.5 sm:gap-2">
                                    <span class="text-slate-500 shrink-0">Total Pembayaran:</span>
                                    <span class="font-black text-amber-600 text-left sm:text-right text-base sm:text-sm">Rp {{ number_format(($pemesanan->paketWisata->harga ?? 0) * $pemesanan->jumlah_peserta, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pos Kegiatan yang Diikuti --}}
                    @if($pemesanan->paketWisata && $pemesanan->paketWisata->posKegiatan->count() > 0)
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-amber-600"></i>
                            <span>Rute Pos Misi & Tantangan Budaya:</span>
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($pemesanan->paketWisata->posKegiatan as $idx => $pos)
                            <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-200/60 flex items-start gap-2.5 hover:border-amber-300 hover:shadow-xs transition-all duration-200">
                                <span class="w-6 h-6 rounded-full bg-amber-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-2xs">
                                    {{ $idx + 1 }}
                                </span>
                                <div class="min-w-0">
                                    <p class="font-bold text-xs text-slate-900 truncate">{{ $pos->nama_pos }}</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $pos->challenge }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- Footer Tiket / Print Bar --}}
                <div class="bg-slate-50 p-4 sm:p-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4 print:hidden">
                    <div class="text-xs text-slate-500 flex items-start sm:items-center gap-2 text-left">
                        <i data-lucide="info" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5 sm:mt-0"></i>
                        <span>Tunjukkan tiket ini atau sebutkan kode booking kepada staf saat tiba di lokasi.</span>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <button onclick="window.print()" class="flex-1 sm:flex-none px-4 sm:px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 active:scale-95 shadow-sm">
                            <i data-lucide="printer" class="w-4 h-4"></i>
                            <span>Cetak Tiket</span>
                        </button>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ngider%20Betawi,%20saya%20ingin%20konfirmasi%20tiket%20{{ $pemesanan->kode_booking }}" target="_blank" class="flex-1 sm:flex-none px-4 sm:px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 active:scale-95 shadow-sm">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Hubungi Staf</span>
                        </a>
                    </div>
                </div>

            </div>
            @endif

        </div>
    </div>
</x-layouts.app>