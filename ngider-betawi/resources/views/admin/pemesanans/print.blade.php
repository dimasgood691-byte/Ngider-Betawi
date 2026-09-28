<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Resmi - {{ $pemesanan->kode_booking }} - Ngider Betawi</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-card { border: 1px solid #e2e8f0 !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-slate-100 py-10 font-sans text-slate-800 antialiased">

    <div class="max-w-3xl mx-auto px-4">

        {{-- Tombol Navigasi Cetak --}}
        <div class="no-print mb-6 flex justify-between items-center bg-white p-4 rounded-2xl shadow-xs border border-slate-200">
            <a href="{{ route('admin.pemesanans.show', $pemesanan->id) }}" class="text-xs font-bold text-slate-600 hover:text-amber-600 flex items-center gap-1">
                ← Kembali ke Detail
            </a>
            <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-md transition">
                🖨️ Print / Simpan PDF
            </button>
        </div>

        {{-- Lembar Tiket --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden print-card">

            {{-- Header Tiket Resmi --}}
            <div class="p-8 border-b-2 border-dashed border-amber-300 bg-gradient-to-r from-amber-500 to-orange-500 text-white flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo" class="w-14 h-14 object-contain bg-white/20 p-1.5 rounded-2xl">
                    <div>
                        <h1 class="text-2xl font-black tracking-tight">TIKET WISATA RESMI</h1>
                        <p class="text-xs text-amber-100 font-semibold tracking-wide uppercase">Padepokan Ciliwung Condet & Ngider Betawi</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-amber-200 block">Kode Reservasi</span>
                    <span class="text-2xl font-black font-mono tracking-wider">{{ $pemesanan->kode_booking }}</span>
                </div>
            </div>

            {{-- Isi Tiket --}}
            <div class="p-8 space-y-6">

                <div class="flex flex-col sm:flex-row justify-between items-center gap-6 p-6 bg-amber-50/60 rounded-2xl border border-amber-100">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Validasi</span>
                        <p class="text-lg font-black text-emerald-700 uppercase">{{ $pemesanan->status === 'dikonfirmasi' ? 'LUNAS  DAN TERKONFIRMASI' : strtoupper(str_replace('_', ' ', $pemesanan->status)) }}</p>
                        <p class="text-xs text-slate-500">Dicetak pada: {{ now()->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
                    </div>
                    <div class="text-center sm:text-right">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($pemesanan->kode_booking) }}" alt="QR Code" class="w-24 h-24 mx-auto sm:ml-auto border border-amber-200 p-1 bg-white rounded-xl">
                        <span class="text-[10px] text-slate-400 mt-1 block">Tunjukkan saat registrasi</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 text-xs sm:text-sm">
                    <div class="space-y-3">
                        <div>
                            <span class="text-slate-400 block text-xs">Instansi / Sekolah:</span>
                            <p class="font-black text-slate-900 text-base">{{ $pemesanan->asal_sekolah }}</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Penanggung Jawab:</span>
                            <p class="font-bold text-slate-800">{{ $pemesanan->nama_lengkap }} ({{ $pemesanan->no_telepon }})</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Kategori Peserta:</span>
                            <p class="font-medium text-slate-700">{{ $pemesanan->rentang_umur }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <span class="text-slate-400 block text-xs">Paket Wisata Terpilih:</span>
                            <p class="font-black text-amber-700 text-base">{{ $pemesanan->paketWisata->nama_paket ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Hari & Tanggal Kunjungan:</span>
                            <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($pemesanan->jadwalWisata->tanggal ?? now())->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-xs">Jumlah Kuota Peserta:</span>
                            <p class="font-black text-slate-900">{{ $pemesanan->jumlah_peserta }} Orang</p>
                        </div>
                    </div>
                </div>

                {{-- Catatan & Tanda Tangan --}}
                <div class="pt-6 border-t border-slate-200 flex justify-between items-end text-xs">
                    <div class="max-w-xs space-y-1 text-slate-500">
                        <p class="font-bold text-slate-800">Perhatian:</p>
                        <p class="text-[11px] leading-relaxed">Peserta harap hadir 15 menit sebelum kegiatan dimulai. Menggunakan pakaian yang nyaman untuk aktivitas outdoor & budaya.</p>
                    </div>

                    <div class="text-center w-44">
                        <p class="text-[11px] text-slate-500 mb-12">Pengelola Padepokan,</p>
                        <p class="font-bold text-slate-900 border-b border-slate-400 pb-1">Petugas Resmi</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Ngider Betawi Condet</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
