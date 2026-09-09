<x-layouts.app>
    {{-- Wrapper utama dengan state Alpine.js --}}
    <div x-data="{ mobileMenuOpen: false, bookingModalOpen: false, selectedPaketId: '' }" class="relative">

        {{-- Header / Navbar --}}
        <header class="bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b border-amber-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    {{-- Logo --}}
                    <a href="#" class="flex items-center space-x-3">
                        {{-- Gambar Logo dari public/assets --}}
                        <img src="{{ asset('logo-ngiderbetawi.png') }}"
                            alt="Logo Ngider Betawi"
                            class="w-11 h-11 object-contain rounded-2xl">

                        <div>
                            <span class="text-1.9xl font-black tracking-tight text-slate-900 block leading-none">
                                Ngider<span class="text-amber-600">Betawi</span>
                            </span>
                            <span class="text-[9px] font-semibold tracking-wider text-slate-600 uppercase">
                                Padepokan Ciliwung Condet
                            </span>
                        </div>
                    </a>

                    {{-- Desktop Menu --}}
                    <nav class="hidden lg:flex items-center space-x-1 p-1.5 rounded-2xl bg-slate-100/60 border border-slate-200/50 backdrop-blur-sm text-sm font-semibold text-slate-700">
                        <a href="#hero" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Beranda</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#padepokan" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Padepokan</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#funfact" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Fun Fact</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#paket" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Paket Edukasi</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#galeri" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Galeri</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#testimoni" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Testimoni</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>

                        <a href="#faq" class="relative px-4 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>FAQ</span>
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                    </nav>

                    {{-- Mobile Menu Hamburger Button --}}
                    <div class="flex lg:hidden items-center">
                        <button @click="mobileMenuOpen = true"
                            type="button"
                            class="p-2.5 rounded-xl text-slate-700 hover:text-amber-600 hover:bg-amber-50 focus:outline-none transition">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        {{-- Backdrop Overlay Mobile --}}
        <div x-show="mobileMenuOpen"
            style="display: none;"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 lg:hidden"></div>

        {{-- Mobile Sidebar Drawer --}}
        <div x-show="mobileMenuOpen"
            style="display: none;"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 z-50 w-full max-w-xs bg-white shadow-2xl p-6 flex flex-col justify-between overflow-y-auto lg:hidden">

            <div>
                <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                    <div class="flex items-center space-x-2">
                        <div class="w-9 h-9 rounded-xl bg-amber-600 flex items-center justify-center text-white font-black text-base">
                            NB
                        </div>
                        <span class="text-xl font-black text-slate-900">
                            Ngider<span class="text-amber-600">Betawi</span>
                        </span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 flex flex-col space-y-1">
                    <a href="#hero" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Beranda</a>
                    <a href="#padepokan" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Padepokan</a>
                    <a href="#funfact" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Fun Fact</a>
                    <a href="#paket" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Paket Edukasi</a>
                    <a href="#galeri" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Galeri</a>
                    <a href="#testimoni" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Testimoni</a>
                    <a href="#faq" @click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">FAQ</a>
                </nav>
            </div>
        </div>

        {{-- Hero Section --}}
        <section id="hero" class="relative bg-gradient-to-b from-amber-50 via-orange-50/50 to-white py-16 lg:py-24 overflow-hidden">
            {{-- Ornamen Motif Gigi Balang Dekoratif --}}
            <div class="absolute top-0 left-0 right-0 h-3 bg-repeat-x opacity-80" style="background-image: repeating-linear-gradient(45deg, #d97706 0 10px, transparent 10px 20px);"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Left Text Content --}}
                    <div class="space-y-6 text-center lg:text-left">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-amber-900 bg-amber-200/70 border border-amber-300">
                            <span>🌴</span> Cultural Tourism & Education
                        </span>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                            Jelajahi Warisan <span class="text-amber-600 underline decoration-amber-300 underline-offset-8">Budaya Betawi</span>
                        </h1>
                        <h3><b><span class="text-lg sm:text-xl text-emerald-700 leading-relaxed max-w-xl mx-auto lg:mx-0">Mengenal, Melestarikan, dan Merayakan Budaya Betawi Bersama</span></b></h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                            Ngider Betawi menghadirkan pengalaman wisata edukasi budaya yang autentik dari Ondel-Ondel, kuliner legendaris, hingga sejarah Jakarta dikemas untuk sekolah, keluarga, dan komunitas.
                        </p>
                        <div class="pt-2 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            {{-- Primary CTA Button --}}
                            <a href="#paket" class="inline-flex items-center justify-center px-7 py-3.5 text-sm sm:text-base font-bold text-white bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 rounded-2xl shadow-lg shadow-amber-600/30 hover:shadow-xl hover:shadow-amber-600/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-center group">
                                <span>Pesan Paket Wisata</span>
                            </a>

                            {{-- Secondary CTA Button --}}
                            <a href="#padepokan" class="inline-flex items-center justify-center px-7 py-3.5 text-sm sm:text-base font-semibold text-emerald-700 bg-emerald-50/80 hover:bg-emerald-100/80 border border-emerald-200/80 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-center group">
                                <span>Jelajahi Padepokan</span>
                                <svg class="w-4 h-4 ml-2 text-emerald-600 group-hover:translate-y-0.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                </svg>
                            </a>
                        </div>
                        {{-- Quick Highlights (Card Style Statis) --}}
                        <div class="pt-6 grid grid-cols-1 sm:grid-cols-3 gap-3.5 max-w-lg mx-auto lg:mx-0">

                            {{-- Card 1: Pengunjung --}}
                            <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200/60 shadow-xs hover:shadow-md hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 group">
                                <p class="text-2xl sm:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300 origin-left">
                                    5.000+
                                </p>
                                <p class="text-xs text-slate-600 font-semibold mt-1">Pengunjung</p>
                            </div>

                            {{-- Card 2: Aktivitas --}}
                            <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200/60 shadow-xs hover:shadow-md hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 group">
                                <p class="text-2xl sm:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300 origin-left">
                                    10+
                                </p>
                                <p class="text-xs text-slate-600 font-semibold mt-1">Aktivitas Seru</p>
                            </div>

                            {{-- Card 3: Rating --}}
                            <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200/60 shadow-xs hover:shadow-md hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 group">
                                <p class="text-2xl sm:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300 origin-left">
                                    4.9/5
                                </p>
                                <p class="text-xs text-slate-600 font-semibold mt-1">Rating Kepuasan</p>
                            </div>

                        </div>
                    </div>

                    {{-- Right Hero Image Grid --}}
                    <div class="relative">
                        <div class="grid grid-cols-2 gap-4">
                            <img src="{{ asset('image-beranda-1.png') }}" alt="image-beranda-1" class="rounded-3xl shadow-lg object-cover h-64 w-full transform -rotate-2 hover:rotate-0 transition duration-300 border-4 border-white">
                            <img src="{{ asset('image-beranda-2.png') }}" alt="image-beranda-2" class="rounded-3xl shadow-lg object-cover h-64 w-full transform rotate-2 hover:rotate-0 transition duration-300 border-4 border-white mt-8">
                        </div>
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl border border-amber-100 flex items-center gap-3 w-max">
                            <span class="text-2xl">🎭</span>
                            <div class="text-left">
                                <p class="text-xs font-bold text-slate-900">Edukasi & Konservasi</p>
                                <p class="text-[11px] text-slate-500">Cocok untuk Siswa SD, SMP & Komunitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Padepokan Section --}}
        <section id="padepokan" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Section Header --}}
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Tentang Padepokan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight">
                        Mari Kita Kenal Padepokan Ciliwung Condet
                    </h2>
                </div>

                {{-- Main Layout: Left Media & Right Cards --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left Column: Images & Location Badge --}}
                    <div class="lg:col-span-5 space-y-4">
                        {{-- Main Image --}}
                        <div class="overflow-hidden rounded-3xl shadow-lg border-4 border-amber-50">
                            <img src="{{ asset('image-padepokan-1.png') }}" alt="image padepokan 1" class="w-full h-72 sm:h-80 object-cover hover:scale-105 transition duration-500">
                        </div>

                        {{-- Secondary Image --}}
                        <div class="overflow-hidden rounded-3xl shadow-lg border-4 border-amber-50">
                            <img src="{{ asset('image-padepokan-2.png') }}" alt="image padepokan 2" class="w-full h-48 object-cover hover:scale-105 transition duration-500">
                        </div>

                        {{-- Location Box --}}
                        <div class="p-5 rounded-2xl bg-amber-50/80 border border-amber-200/80 shadow-sm flex items-start gap-3">
                            <div class="p-2.5 bg-amber-600 text-white rounded-xl shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-slate-700 leading-relaxed">
                                Jl. H. Mursali No.99 B, RT.8/RW.1, Balekambang, Kec. Kramat Jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13530
                            </p>
                        </div>
                    </div>

                    {{-- Right Column: Paragraph & Feature Cards --}}
                    <div class="lg:col-span-7 space-y-6">

                        {{-- Introduction Paragraph --}}
                        <div class="p-6 rounded-3xl bg-amber-50/40 border border-amber-100">
                            <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                                Padepokan Ciliwung Condet merupakan pusat pelestarian budaya Betawi sekaligus
                                kawasan wisata berbasis alam, seni, dan pendidikan yang berada di kawasan Condet, Jakarta
                                Timur. Padepokan ini didirikan sebagai wadah untuk menjaga kelestarian budaya Betawi serta
                                meningkatkan kepedulian masyarakat terhadap lingkungan, khususnya Sungai Ciliwung.
                            </p>
                        </div>

                        {{-- Feature Card 1: Gamifikasi --}}
                        <div class="p-6 sm:p-7 rounded-3xl bg-amber-50/60 border border-amber-100/80 shadow-sm hover:shadow-md transition duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-2xl">🎯</span>
                                <h3 class="text-lg font-bold text-slate-900">Kegiatan yang Diselenggarakan</h3>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Peserta diajak menyelesaikan <span class="font-semibold text-amber-700">mission card</span>, mengumpulkan poin, serta menjawab kuis interaktif seputar sejarah Ciliwung dan seni Betawi.
                            </p>
                        </div>

                        {{-- Feature Card 2: Konservasi --}}
                        <div class="p-6 sm:p-7 rounded-3xl bg-amber-50/60 border border-amber-100/80 shadow-sm hover:shadow-md transition duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-2xl">🌱</span>
                                <h3 class="text-lg font-bold text-slate-900">Dampak Positif bagi Warga</h3>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Edukasi pelestarian keanekaragaman hayati bantaran sungai, penanaman pohon, serta aksi nyata pembibitan tanaman khas Condet.
                            </p>
                        </div>

                        {{-- Highlight Banner Card: Community Tourism --}}
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-amber-600 to-orange-500 text-white shadow-lg shadow-amber-500/15 flex items-start gap-4">
                            <span class="text-2xl shrink-0">🎨</span>
                            <div>
                                <p class="text-xs sm:text-sm text-amber-50/90 leading-relaxed">
                                    Sebagai destinasi community-based tourism, pengunjung tidak hanya menikmati keindahan alam Sungai Ciliwung, tetapi juga mengenal langsung kesenian, tradisi, kerajinan, dan kearifan lokal masyarakat Betawi.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        {{-- Fun Fact Betawi Section --}}
        <section id="funfact" class="py-16 bg-gradient-to-r from-amber-600 to-orange-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    <div class="lg:col-span-1 space-y-3">
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-wider">Tahukah Kamu?</span>
                        <h2 class="text-3xl font-black">Fun Fact & Kearifan Lokal Condet</h2>
                        <p class="text-amber-100 text-sm leading-relaxed">Kawasan Condet pernah ditetapkan sebagai cagar budaya Betawi dan pusat penghasil buah Duku serta Salak Condet legendaris.</p>
                    </div>

                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
                            <div class="text-2xl mb-2">🥭</div>
                            <h4 class="font-bold text-lg mb-1">Salak & Duku Condet</h4>
                            <p class="text-xs text-amber-100">Buah khas Jakarta yang kini dilindungi dan dibudidayakan di bantaran Ciliwung Condet.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
                            <div class="text-2xl mb-2">🥋</div>
                            <h4 class="font-bold text-lg mb-1">Pencak Silat Main Pukul</h4>
                            <p class="text-xs text-amber-100">Seni beladiri tradisional Betawi yang mengedepankan kecepatan dan nilai-nilai kesopanan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Paket Wisata Edukasi Section --}}
        <section id="paket" class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Pilihan Kunjungan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Daftar Paket Wisata Edukasi</h2>
                    <p class="mt-3 text-slate-600 text-sm sm:text-base">Pilih paket terbaik sesuai jumlah rombongan sekolah atau komunitasmu.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse ($pakets as $p)
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $p->nama_paket }}</h3>
                            <p class="text-2xl font-black text-amber-600 my-3">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('booking.create', $p->id) }}"
                            class="block w-full py-3 text-center text-sm font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition mt-6">
                            Pesan Paket Ini
                        </a>
                    </div>
                    @empty
                    <p class="text-slate-500 text-center col-span-3">Belum ada paket wisata yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Galeri Section --}}
        <section id="galeri" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Dokumentasi Kegiatan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Galeri Suasana Padepokan</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($destinations as $index => $item)
                    <div class="relative group overflow-hidden rounded-2xl shadow-sm border border-slate-100 {{ $index == 0 ? 'col-span-2 row-span-2' : '' }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full min-h-[220px] object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6 text-white">
                            <span class="text-xs text-amber-300 font-bold uppercase">{{ $item['category'] }}</span>
                            <h4 class="text-lg font-bold">{{ $item['title'] }}</h4>
                            <p class="text-xs text-slate-200 mt-1">📍 {{ $item['location'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimoni Section --}}
        <section id="testimoni" class="py-20 bg-amber-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Apa Kata Mereka</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Ulasan Guru & Pengunjung</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-3xl border border-amber-100 shadow-sm space-y-4">
                        <div class="flex text-amber-500 gap-1 text-sm">★★★★★</div>
                        <p class="text-slate-600 text-sm leading-relaxed">"Siswa-siswi kami sangat antusias! Konsep gamifikasinya bikin anak-anak aktif bergerak sambil belajar sejarah Betawi dan pelestarian sungai."</p>
                        <div class="flex items-center gap-3 pt-2">
                            <div class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm">
                                IB
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Ibu Nurhasanah, S.Pd.</p>
                                <p class="text-xs text-slate-500">Guru SD Jakarta Selatan</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-amber-100 shadow-sm space-y-4">
                        <div class="flex text-amber-500 gap-1 text-sm">★★★★★</div>
                        <p class="text-slate-600 text-sm leading-relaxed">"Suasananya asri di pinggir Ciliwung Condet. Edukasi konservasinya riil, anak-anak bisa langsung praktik menanam bibit tanaman."</p>
                        <div class="flex items-center gap-3 pt-2">
                            <div class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm">
                                BP
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Bapak Hendra</p>
                                <p class="text-xs text-slate-500">Pembina Komunitas Remaja</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-amber-100 shadow-sm space-y-4">
                        <div class="flex text-amber-500 gap-1 text-sm">★★★★★</div>
                        <p class="text-slate-600 text-sm leading-relaxed">"Kulinernya mantap, pemandunya ramah dan paham betul sejarah Condet. Sangat direkomendasikan untuk studi tur sekolah."</p>
                        <div class="flex items-center gap-3 pt-2">
                            <div class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm">
                                SR
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Siti Rahma</p>
                                <p class="text-xs text-slate-500">Orang Tua Murid</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ Section (Alpine.js) --}}
        <section id="faq" class="py-20 bg-white" x-data="{ openFaq: null }">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Pertanyaan Populer</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Pertanyaan Sering Diajukan (FAQ)</h2>
                </div>

                <div class="space-y-4">
                    <div class="border border-slate-200 rounded-2xl overflow-hidden">
                        <button @click="openFaq === 1 ? openFaq = null : openFaq = 1" class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-slate-50 transition">
                            <span>Bagaimana cara melakukan pemesanan paket wisata rombongan?</span>
                            <span class="text-xl" x-text="openFaq === 1 ? '−' : '+'"></span>
                        </button>
                        <div x-show="openFaq === 1" x-cloak class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Anda dapat memilih paket di atas lalu klik tombol "Pesan Paket Ini". Tim kami akan membantu memverifikasi ketersediaan tanggal dan jadwal pemandu.
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-2xl overflow-hidden">
                        <button @click="openFaq === 2 ? openFaq = null : openFaq = 2" class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-slate-50 transition">
                            <span>Berapa minimal jumlah peserta untuk reservasi rombongan?</span>
                            <span class="text-xl" x-text="openFaq === 2 ? '−' : '+'"></span>
                        </button>
                        <div x-show="openFaq === 2" x-cloak class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Untuk paket grup sekolah atau komunitas, minimal kuota kunjungan adalah 15 orang peserta.
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-2xl overflow-hidden">
                        <button @click="openFaq === 3 ? openFaq = null : openFaq = 3" class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-slate-50 transition">
                            <span>Apakah lokasi Padepokan aman untuk anak-anak?</span>
                            <span class="text-xl" x-text="openFaq === 3 ? '−' : '+'"></span>
                        </button>
                        <div x-show="openFaq === 3" x-cloak class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Sangat aman. Area kegiatan dilengkapi pagar pengaman, instruktur terlatih, dan perlengkapan keselamatan standar saat berada di area bantaran sungai.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Floating Buttons (Scroll to Top & WhatsApp) --}}
        <div x-data="{ showTopBtn: false }"
            x-init="window.addEventListener('scroll', () => { showTopBtn = window.scrollY > 300 })"
            class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 items-center">

            {{-- Tombol Scroll to Top --}}
            <button x-show="showTopBtn"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-90"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="w-12 h-12 rounded-full bg-white text-orange-500 shadow-lg border border-slate-100 flex items-center justify-center hover:bg-slate-50 hover:scale-110 active:scale-95 transition-all duration-300"
                title="Kembali ke atas">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current stroke-[2.5]" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </button>

            {{-- Tombol Floating WhatsApp --}}
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ngider%20Betawi,%20saya%20ingin%20bertanya%20seputar%20paket%20wisata."
                target="_blank"
                rel="noopener noreferrer"
                class="w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 relative group"
                title="Chat via WhatsApp">

                <span class="absolute -inset-1 rounded-full bg-emerald-400 opacity-75 animate-ping group-hover:opacity-0"></span>

                <svg class="w-7 h-7 fill-current relative z-10" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </a>
        </div>

        {{-- Footer --}}
        <footer class="bg-slate-950 text-slate-400 py-16 border-t border-slate-800 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                    {{-- Deskripsi Brand --}}
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-2xl bg-amber-600 flex items-center justify-center text-white font-black text-lg">
                                NB
                            </div>
                            <span class="text-2xl font-black text-white">NgiderBetawi</span>
                        </div>
                        <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                            Sistem Informasi Wisata Edukasi & Gamifikasi Kebudayaan Betawi di Padepokan Ciliwung Condet.
                        </p>
                    </div>

                    {{-- Navigasi Cepat --}}
                    <div>
                        <h4 class="text-white font-bold text-sm mb-4">Navigasi Cepat</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#hero" class="hover:text-amber-400 transition">Beranda</a></li>
                            <li><a href="#konsep" class="hover:text-amber-400 transition">Konsep Wisata</a></li>
                            <li><a href="#paket" class="hover:text-amber-400 transition">Paket Edukasi</a></li>
                            <li><a href="#galeri" class="hover:text-amber-400 transition">Galeri Suasana</a></li>
                        </ul>
                    </div>

                    {{-- Lokasi & Kontak --}}
                    <div class="space-y-3">
                        <h4 class="text-white font-bold text-sm mb-4">Lokasi & Kontak</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            📍 Padepokan Ciliwung Condet, Balekambang, Kramat Jati, Jakarta Timur.
                        </p>
                        <p class="text-xs text-slate-400">
                            📞 WhatsApp Admin: +62 812-3456-7890
                        </p>

                        <div class="w-full h-36 rounded-xl overflow-hidden border border-slate-800 shadow-md mt-3">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.867702816962!2d106.8529241!3d-6.2811105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2f3cb065d6d%3A0xb3ef1ad0952d9a65!2sPadepokan%20Ciliwung%20Condet!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                class="w-full h-full border-0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-900 text-center text-xs text-slate-600">
                    &copy; {{ date('Y') }} NgiderBetawi - Padepokan Ciliwung Condet. All rights reserved.
                </div>
            </div>
        </footer>

    </div>
</x-layouts.app>