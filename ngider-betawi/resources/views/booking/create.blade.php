<x-layouts.app>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Halaman --}}
            <div class="mb-8 text-center sm:text-left">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 hover:text-amber-700 mb-4 transition">
                    ← Kembali ke Beranda
                </a>
                <h1 class="text-3xl font-black text-slate-900">Form Pemesanan & Pembayaran</h1>
                <p class="text-slate-600 text-sm mt-1">Lengkapi data diri dan unggah bukti transfer untuk mengamankan slot kunjungan.</p>
            </div>

            {{-- Pesan Alert Validasi Error --}}
            @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-sm">
                <p class="font-bold mb-1">Terjadi kesalahan pada inputan Anda:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                @csrf

                {{-- Kolom Kiri: Form Data Pemesan --}}
                <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 space-y-5">
                    <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">1. Informasi Pemesan</h2>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pilih Paket Wisata</label>
                        <select name="paket_wisata_id" required class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                            <option value="" disabled {{ empty($selectedPaketId) ? 'selected' : '' }}>-- Pilih Paket Wisata --</option>
                            @if (isset($pakets) && count($pakets) > 0)
                            @foreach($pakets as $p)
                            <option value="{{ $p->id }}" {{ (isset($selectedPaketId) && $selectedPaketId == $p->id) ? 'selected' : '' }}>
                                {{ $p->nama_paket }} - Rp {{ number_format($p->harga, 0, ',', '.') }}/orang
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Instansi / Sekolah / Komunitas</label>
                        <input type="text" name="nama_instansi" value="{{ old('nama_instansi') }}" required placeholder="Contoh: SD Negeri 01 Pagi" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan') }}" required placeholder="Nama lengkap" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nomor WhatsApp</label>
                            <input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp') }}" required placeholder="08123456789" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" required class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Jumlah Peserta</label>
                            <input type="number" name="jumlah_peserta" min="20" value="{{ old('jumlah_peserta') }}" required placeholder="Min 20" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Request khusus, alergi makanan, dll." class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 outline-none">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                {{-- Kolom Kanan: Instruksi Pembayaran & Upload Bukti Transfer --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 space-y-5">
                        <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">2. Pembayaran Manual</h2>

                        {{-- Tampilan QRIS & No Rekening --}}
                        <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200 text-center space-y-3">
                            <p class="text-xs font-bold text-amber-900 uppercase tracking-wider">Scan QRIS / Transfer Bank</p>

                            {{-- Gambar QRIS --}}
                            <div class="bg-white p-3 rounded-xl inline-block shadow-sm border border-amber-100">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=NgiderBetawiQRIS" alt="QRIS Pembayaran" class="w-40 h-40 mx-auto">
                            </div>

                            <div class="text-xs text-slate-700 space-y-1">
                                <p class="font-bold">Bank BCA: <span class="font-mono text-amber-800">123-456-7890</span></p>
                                <p>a.n. <strong>Padepokan Ciliwung Condet</strong></p>
                            </div>
                        </div>

                        {{-- Upload Bukti Transfer --}}
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_pembayaran" accept="image/*" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                            <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        <button type="submit" class="w-full py-3.5 text-base font-bold text-white bg-amber-600 hover:bg-amber-700 rounded-2xl shadow-lg shadow-amber-600/30 transition">
                            Kirim Pemesanan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-layouts.app>