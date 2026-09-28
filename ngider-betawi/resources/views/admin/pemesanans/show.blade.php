<x-layouts.admin title="Detail Pemesanan {{ $pemesanan->kode_booking }} - Admin" header="Detail Pemesanan & Verifikasi">

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.pemesanans.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-amber-600 mb-2 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Daftar Pemesanan</span>
            </a>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-black text-slate-900 font-mono">{{ $pemesanan->kode_booking }}</h1>
                @if($pemesanan->status === 'dikonfirmasi' || $pemesanan->status === 'terverifikasi')
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800">Terkonfirmasi</span>
                @elseif($pemesanan->status === 'ditolak')
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-rose-100 text-rose-800">Ditolak</span>
                @else
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800">Menunggu Verifikasi</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pemesanans.print', $pemesanan->id) }}" target="_blank"
                class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs flex items-center gap-2 transition shadow-xs">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Cetak Lembar Tiket</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pemesanan->no_telepon) }}?text=Halo%20Bapak/Ibu%20{{ urlencode($pemesanan->nama_lengkap) }},%20kami%20dari%20Admin%20Ngider%20Betawi%20mengenai%20reservasi%20{{ $pemesanan->kode_booking }}" target="_blank"
                class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-2 transition shadow-xs">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Chat Pemesan via WA</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Kolom Kiri: Detail Informasi --}}
        <div class="lg:col-span-7 space-y-6">
            
            {{-- Data Pemesan & Rombongan --}}
            <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4 text-amber-600"></i>
                    <span>Informasi Instansi & Kontak</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div>
                        <span class="text-slate-400 block text-xs">Instansi / Sekolah</span>
                        <p class="font-bold text-slate-800 mt-0.5">{{ $pemesanan->asal_sekolah }}</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Nama Penanggung Jawab</span>
                        <p class="font-bold text-slate-800 mt-0.5">{{ $pemesanan->nama_lengkap }}</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Nomor WhatsApp</span>
                        <p class="font-bold text-slate-800 mt-0.5 font-mono">{{ $pemesanan->no_telepon }}</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Email</span>
                        <p class="font-medium text-slate-700 mt-0.5">{{ $pemesanan->email }}</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Kategori Usia / Jenjang</span>
                        <p class="font-medium text-slate-700 mt-0.5">{{ $pemesanan->rentang_umur }}</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Waktu Pemesanan</span>
                        <p class="font-medium text-slate-700 mt-0.5">{{ $pemesanan->created_at->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
                    </div>
                </div>
            </div>

            {{-- Detail Paket & Kunjungan --}}
            <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i data-lucide="package" class="w-4 h-4 text-amber-600"></i>
                    <span>Detail Paket & Estimasi Biaya</span>
                </h3>

                <div class="space-y-3 text-xs sm:text-sm">
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Nama Paket Wisata:</span>
                        <span class="font-bold text-slate-900">{{ $pemesanan->paketWisata->nama_paket ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Tanggal Kunjungan:</span>
                        <span class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($pemesanan->jadwalWisata->tanggal ?? now())->isoFormat('dddd, D MMMM Y') }}</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Harga Satuan Paket:</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($pemesanan->paketWisata->harga ?? 0, 0, ',', '.') }} / peserta</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Jumlah Peserta Terdaftar:</span>
                        <span class="font-black text-slate-900">{{ $pemesanan->jumlah_peserta }} Orang</span>
                    </div>
                    <div class="flex justify-between py-2 bg-amber-50/80 px-4 rounded-xl border border-amber-100">
                        <span class="font-bold text-amber-900">Total Nominal Pembayaran:</span>
                        <span class="text-lg font-black text-amber-700">Rp {{ number_format(($pemesanan->paketWisata->harga ?? 0) * $pemesanan->jumlah_peserta, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Pos Kegiatan --}}
                @if($pemesanan->paketWisata && $pemesanan->paketWisata->posKegiatan->count() > 0)
                <div class="pt-3 border-t border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Pos Kegiatan & Tantangan:</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($pemesanan->paketWisata->posKegiatan as $pos)
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2 text-xs">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                            <div>
                                <p class="font-bold text-slate-800">{{ $pos->nama_pos }}</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ $pos->challenge }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

        </div>

        {{-- Kolom Kanan: Verifikasi Pembayaran & Bukti Transfer --}}
        <div class="lg:col-span-5 space-y-6">
            
            @php
                $pembayaran = $pemesanan->pembayaran()->latest()->first();
            @endphp

            <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200 shadow-xs space-y-5">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-4 h-4 text-amber-600"></i>
                    <span>Bukti Transfer & Verifikasi</span>
                </h3>

                {{-- Preview Bukti Bayar --}}
                @if($pembayaran && $pembayaran->bukti_file)
                <div class="space-y-2">
                    <span class="text-xs font-semibold text-slate-500">File Bukti Transfer:</span>
                    <div class="relative overflow-hidden rounded-2xl border border-slate-200 aspect-[4/3] bg-slate-100 group">
                        <img src="{{ asset('storage/' . $pembayaran->bukti_file) }}" alt="Bukti Transfer" class="w-full h-full object-cover">
                        <a href="{{ asset('storage/' . $pembayaran->bukti_file) }}" target="_blank"
                            class="absolute inset-0 bg-black/40 flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition backdrop-blur-xs">
                            <i data-lucide="maximize-2" class="w-4 h-4 mr-1.5"></i> Buka Gambar Resolusi Penuh
                        </a>
                    </div>
                </div>
                @else
                <div class="p-6 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200 text-xs text-slate-400">
                    Belum ada bukti pembayaran yang diunggah.
                </div>
                @endif

                {{-- Status Verifikasi Saat Ini --}}
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs space-y-1.5">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Metode Bayar:</span>
                        <span class="font-bold text-slate-700 uppercase">{{ $pembayaran->metode ?? 'Transfer Bank' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Status Pembayaran:</span>
                        <span class="font-bold {{ ($pembayaran->status_verifikasi ?? '') === 'valid' ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ strtoupper($pembayaran->status_verifikasi ?? 'PENDING') }}
                        </span>
                    </div>
                    @if($pembayaran && $pembayaran->verified_at)
                    <div class="flex justify-between">
                        <span class="text-slate-400">Diverifikasi Pada:</span>
                        <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($pembayaran->verified_at)->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                    @if($pembayaran && $pembayaran->catatan_admin)
                    <div class="pt-2 border-t border-slate-200/60">
                        <span class="text-slate-400 block text-[11px]">Catatan Terakhir:</span>
                        <p class="font-medium text-slate-700 italic mt-0.5">"{{ $pembayaran->catatan_admin }}"</p>
                    </div>
                    @endif
                </div>

                {{-- Form Aksi Verifikasi Admin --}}
                <form action="{{ route('admin.pemesanans.verify', $pemesanan->id) }}" method="POST" class="space-y-4 pt-2">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Catatan Tambahan untuk Pemesan</label>
                        <textarea name="catatan_admin" rows="2" placeholder="Contoh: Pembayaran lunas telah diterima. Selamat berkunjung!"
                            class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">{{ $pembayaran->catatan_admin ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button type="submit" name="action" value="approve"
                            class="py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-md shadow-emerald-600/20 transition">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>Konfirmasi / Setujui</span>
                        </button>
                        <button type="submit" name="action" value="reject"
                            onclick="return confirm('Yakin ingin menolak reservasi ini? Kuota kunjungan akan otomatis dikembalikan ke sistem.')"
                            class="py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-md shadow-rose-600/20 transition">
                            <i data-lucide="x-circle" class="w-4 h-4"></i>
                            <span>Tolak Pemesanan</span>
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</x-layouts.admin>
