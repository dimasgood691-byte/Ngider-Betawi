<x-layouts.app>
    {{-- Wrapper utama dengan state Alpine.js --}}
    <div x-data="{
        mobileMenuOpen: false,
        bookingModalOpen: false,
        selectedPaketId: '',
        scrolled: false,
        scrollProgress: 0
    }" x-init="window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 20;
        let totalHeight = document.documentElement.scrollHeight - window.innerHeight;
        scrollProgress = totalHeight > 0 ? (window.scrollY / totalHeight) * 100 : 0;
    })" class="relative font-sans antialiased text-slate-800">

        {{-- Scroll Progress Bar --}}
        <div class="fixed top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 z-50 transition-all duration-150 ease-out"
            :style="'width: ' + scrollProgress + '%'"></div>

        {{-- Header / Navbar --}}
        <header
            :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md border-amber-200/80 py-0' :
                'bg-white/90 backdrop-blur-md shadow-xs border-amber-200'"
            class="sticky top-0 z-40 border-b transition-all duration-300" data-aos="fade-down" data-aos-duration="600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    {{-- Logo --}}
                    <a href="#" class="flex items-center space-x-3 group" data-aos="fade-right"
                        data-aos-delay="100">
                        {{-- Gambar Logo dari public/assets --}}
                        <div
                            class="relative overflow-hidden rounded-2xl p-0.5 group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo Ngider Betawi"
                                class="w-11 h-11 object-contain rounded-2xl">
                        </div>
                        <div>
                            <span
                                class="text-1.9xl font-black tracking-tight text-slate-900 block leading-none">
                                Ngider<span class="text-amber-600">Betawi</span>
                            </span>
                            <span class="text-[9px] font-semibold tracking-wider text-slate-600 uppercase">
                                Padepokan Ciliwung Condet
                            </span>
                        </div>
                    </a>

                    {{-- Desktop Menu --}}
                    <nav class="hidden lg:flex items-center space-x-1 p-1.5 rounded-2xl bg-slate-100/70 border border-slate-200/60 backdrop-blur-md text-sm font-semibold text-slate-700 shadow-inner"
                        data-aos="fade-down" data-aos-delay="150">
                        <a href="#beranda"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Beranda</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#padepokan"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Padepokan</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#ngider-betawi"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Ngider Betawi</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#funfact"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Fun Fact</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#paket"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Paket Wisata</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#galeri"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Galeri</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#testimoni"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>Testimoni</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                        <a href="#faq"
                            class="relative px-3.5 py-2 rounded-xl hover:text-amber-600 hover:bg-white hover:shadow-xs transition-all duration-300 group">
                            <span>FAQ</span>
                            <span
                                class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-amber-600 rounded-full group-hover:w-1/2 transition-all duration-300"></span>
                        </a>
                    </nav>

                    {{-- Action CTA & Tracking Button --}}
                    <div class="hidden lg:flex items-center gap-3" data-aos="fade-left" data-aos-delay="100">
                        <a href="{{ route('booking.track') }}"
                            class="group relative inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition-all duration-300 shadow-xs hover:shadow-md hover:-translate-y-0.5 active:translate-y-0">
                            <i data-lucide="ticket"
                                class="w-4 h-4 text-amber-600 group-hover:rotate-12 transition-transform duration-300"></i>
                            <span>Cek Status Tiket</span>
                        </a>
                    </div>

                    {{-- Mobile Menu Hamburger Button --}}
                    <div class="flex lg:hidden items-center" data-aos="fade-left" data-aos-delay="100">
                        <button @click="mobileMenuOpen = true" type="button"
                            class="p-2.5 rounded-xl text-slate-700 hover:text-amber-600 hover:bg-amber-50 focus:outline-none transition-all duration-200 active:scale-95">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        {{-- Backdrop Overlay Mobile --}}
        <div x-show="mobileMenuOpen" style="display: none;"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 lg:hidden"></div>

        {{-- Mobile Sidebar Drawer --}}
        <div x-show="mobileMenuOpen" style="display: none;"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 z-50 w-full max-w-xs bg-white shadow-2xl p-6 flex flex-col justify-between overflow-y-auto lg:hidden">

            <div>
                <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-base">
                            <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo Ngider Betawi"
                                class="w-11 h-11 object-contain rounded-2xl">
                        </div>
                        <span class="text-xl font-black text-slate-900">
                            Ngider<span class="text-amber-600">Betawi</span>
                        </span>
                    </div>
                    <button @click="mobileMenuOpen = false"
                        class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 flex flex-col space-y-1">
                    <a href="#beranda" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Beranda</a>
                    <a href="#padepokan" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Padepokan</a>
                    <a href="#ngider-betawi" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Ngider
                        Betawi</a>
                    <a href="#funfact" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Fun
                        Fact Betawi</a>
                    <a href="#paket" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Paket
                        Edukasi</a>
                    <a href="#galeri" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Galeri</a>
                    <a href="#testimoni" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">Testimoni</a>
                    <a href="#faq" @click="mobileMenuOpen = false"
                        class="px-4 py-3 rounded-xl font-semibold text-slate-700 hover:text-amber-600 hover:bg-amber-50 transition">FAQ</a>
                    <div class="pt-4 space-y-2 border-t border-slate-100">
                        <a href="{{ route('booking.track') }}"
                            class="flex items-center justify-center gap-2 w-full py-3 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-xl">
                            <i data-lucide="ticket" class="w-4 h-4"></i> Cek Status Tiket
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        {{-- Hero Section --}}
        <section id="beranda"
            class="relative bg-gradient-to-b from-amber-50 via-orange-50/50 to-white py-16 lg:py-24 overflow-hidden">
            {{-- Ambient Glowing Background Orbs --}}
            <div
                class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-amber-300/20 to-orange-300/20 rounded-full blur-3xl pointer-events-none animate-pulse">
            </div>
            <div
                class="absolute top-1/3 -right-32 w-80 h-80 bg-amber-400/15 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="fade-up"
                data-aos-delay="100">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Left Text Content --}}
                    <div class="space-y-6 text-center lg:text-left" data-aos="fade-right">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight"
                            data-aos="fade-up" data-aos-delay="100">
                            Jelajahi Warisan <span
                                class="text-amber-600 decoration-amber-300 transition-all duration-300 hover:decoration-amber-500">Budaya
                                Betawi</span>
                        </h1>
                        <h3 data-aos="fade-up" data-aos-delay="150"><b><span
                                    class="text-lg sm:text-xl text-emerald-700 leading-relaxed max-w-xl mx-auto lg:mx-0">Mengenal,
                                    Melestarikan, dan Merayakan Budaya Betawi Bersama</span></b></h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0"
                            data-aos="fade-up" data-aos-delay="200">
                            Ngider Betawi menghadirkan pengalaman wisata edukasi budaya yang autentik dari Ondel-Ondel,
                            kuliner legendaris, hingga sejarah Jakarta dikemas untuk sekolah, keluarga, dan komunitas.
                        </p>
                        <div class="pt-2 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start"
                            data-aos="fade-up" data-aos-delay="250">
                            {{-- Primary CTA Button --}}
                            <a href="#paket"
                                class="relative overflow-hidden inline-flex items-center justify-center px-7 py-3.5 text-sm sm:text-base font-bold text-white bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 rounded-2xl shadow-lg shadow-amber-600/30 hover:shadow-xl hover:shadow-amber-600/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 text-center group">
                                <span
                                    class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                <span class="relative z-10">Pesan Paket Wisata</span>
                            </a>

                            {{-- Secondary CTA Button --}}
                            <a href="#padepokan"
                                class="inline-flex items-center justify-center px-7 py-3.5 text-sm sm:text-base font-semibold text-emerald-700 bg-emerald-50/80 hover:bg-emerald-100/80 border border-emerald-200/80 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-center group">
                                <span>Jelajahi Padepokan</span>
                                <svg class="w-4 h-4 ml-2 text-emerald-600 group-hover:translate-y-1 transition-transform duration-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                </svg>
                            </a>
                        </div>
                        {{-- Quick Highlights (Card Style Statis - Responsif 3 Kolom) --}}
                        <div class="pt-6 grid grid-cols-3 gap-2 sm:gap-3.5 max-w-lg mx-auto lg:mx-0"
                            data-aos="fade-up" data-aos-delay="300">
                            {{-- Card 1: Pengunjung --}}
                            <div class="p-2.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-amber-50/80 backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-lg hover:border-amber-300 hover:ring-2 hover:ring-amber-400/40 hover:-translate-y-1 transition-all duration-300 group text-center sm:text-left"
                                data-aos="zoom-in" data-aos-delay="350">
                                <div class="flex items-center justify-center sm:justify-start gap-1">
                                    <i data-lucide="users"
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-600 shrink-0 group-hover:rotate-6 transition-transform duration-300"></i>
                                    <p
                                        class="text-base sm:text-2xl md:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300">
                                        5.000+
                                    </p>
                                </div>
                                <p class="text-[10px] sm:text-xs text-slate-600 font-semibold mt-0.5 sm:mt-1 truncate">
                                    Pengunjung</p>
                            </div>
                            {{-- Card 2: Aktivitas --}}
                            <div class="p-2.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-amber-50/80 backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-lg hover:border-amber-300 hover:ring-2 hover:ring-amber-400/40 hover:-translate-y-1 transition-all duration-300 group text-center sm:text-left"
                                data-aos="zoom-in" data-aos-delay="450">
                                <div class="flex items-center justify-center sm:justify-start gap-1">
                                    <i data-lucide="sparkles"
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-600 shrink-0 group-hover:rotate-12 transition-transform duration-300"></i>
                                    <p
                                        class="text-base sm:text-2xl md:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300">
                                        10+
                                    </p>
                                </div>
                                <p class="text-[10px] sm:text-xs text-slate-600 font-semibold mt-0.5 sm:mt-1 truncate">
                                    Aktivitas Seru</p>
                            </div>
                            {{-- Card 3: Rating --}}
                            <div class="p-2.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-amber-50/80 backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-lg hover:border-amber-300 hover:ring-2 hover:ring-amber-400/40 hover:-translate-y-1 transition-all duration-300 group text-center sm:text-left"
                                data-aos="zoom-in" data-aos-delay="550">
                                <div class="flex items-center justify-center sm:justify-start gap-1">
                                    <i data-lucide="star"
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-600 fill-amber-500 shrink-0 group-hover:scale-125 transition-transform duration-300"></i>
                                    <p
                                        class="text-base sm:text-2xl md:text-3xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform duration-300">
                                        4.9/5
                                    </p>
                                </div>
                                <p class="text-[10px] sm:text-xs text-slate-600 font-semibold mt-0.5 sm:mt-1 truncate">
                                    Kepuasan</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right Hero Image Grid --}}
                    <div class="relative group/grid" data-aos="fade-left" data-aos-delay="150">
                        {{-- Decorative Background Blur --}}
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-amber-400/20 to-orange-400/20 rounded-full blur-2xl opacity-50 group-hover/grid:opacity-80 transition-opacity duration-500">
                        </div>

                        <div class="relative grid grid-cols-2 gap-4" data-aos="zoom-in" data-aos-delay="250">
                            {{-- Image 1 --}}
                            <div class="relative w-full h-full min-h-[256px] overflow-hidden rounded-3xl shadow-xl border-4 border-white transform -rotate-2 hover:rotate-0 hover:scale-105 transition-all duration-500 group/img1"
                                data-aos="fade-right" data-aos-delay="300">
                                <img src="{{ asset('image-beranda-1.png') }}" alt="Wisata Edukasi Ngider Betawi 1"
                                    class="w-full h-full object-cover block group-hover/img1:scale-110 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-0 group-hover/img1:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            {{-- Image 2 --}}
                            <div class="relative overflow-hidden rounded-3xl shadow-xl border-4 border-white transform rotate-2 hover:rotate-0 hover:scale-105 transition-all duration-500 mt-8 group/img2"
                                data-aos="fade-left" data-aos-delay="400">
                                <img src="{{ asset('image-beranda-2.png') }}" alt="Wisata Edukasi Ngider Betawi 2"
                                    class="h-64 sm:h-72 w-full object-cover group-hover/img2:scale-110 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-0 group-hover/img2:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                        </div>

                        {{-- Floating Glassmorphism Badge --}}
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white/90 backdrop-blur-md px-5 py-3 rounded-2xl shadow-xl border border-amber-200/80 flex items-center gap-3.5 w-max hover:scale-105 transition-all duration-300 cursor-default group/badge hover:shadow-2xl hover:border-amber-300"
                            data-aos="fade-up" data-aos-delay="500">
                            <div
                                class="p-1 rounded-xl bg-amber-50 group-hover/badge:bg-amber-100 transition-colors duration-300 shrink-0 relative">
                                <img src="{{ asset('logo-ondel-ondel.png') }}" alt="Logo ondel-ondel"
                                    class="w-12 h-12 object-contain rounded-lg">
                            </div>
                            <div class="text-left">
                                <div class="flex items-center gap-1.5">
                                    <p class="text-xs font-extrabold text-slate-900 tracking-tight">Edukasi &
                                        Konservasi</p>
                                </div>
                                <p class="text-[11px] font-medium text-slate-500">Cocok untuk Siswa SD, SMP & Komunitas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Betawi Section Divider: Wave & Gigi Balang Accent --}}
        <div class="relative w-full overflow-hidden leading-none py-4 my-6 group/divider">
            {{-- Decorative Background Line --}}
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-dashed border-amber-300/80"></div>
            </div>

            {{-- Center Badge with Gigi Balang Pattern --}}
            <div class="relative flex justify-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-700 text-amber-300 border-2 border-amber-400 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                    {{-- Gigi Balang Pattern SVG --}}
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                    <i data-lucide="flower-2"
                        class="w-4 h-4 text-rose-400 shrink-0 group-hover/divider:rotate-180 transition-transform duration-700 ease-in-out"></i>
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tentang Padepokan Section --}}
        <section id="padepokan" class="py-20 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Section Header --}}
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Tentang
                        Padepokan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight">
                        Mari Kita Kenal Padepokan Ciliwung Condet
                    </h2>
                </div>

                {{-- Main Layout: Left Media & Right Cards --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left Column: Images & Location Badge --}}
                    <div class="lg:col-span-5 space-y-4" data-aos="fade-right">
                        {{-- Main Image --}}
                        <div class="relative overflow-hidden rounded-3xl shadow-md border-4 border-amber-50 group">
                            <img src="{{ asset('image-padepokan-1.png') }}" alt="Padepokan Ciliwung Condet 1"
                                class="w-full h-72 sm:h-80 object-cover group-hover:scale-108 transition-transform duration-700 ease-out">
                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            {{-- Glassmorphism Badge dengan Lucide Icon --}}
                            <div
                                class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-white opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <div
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/20 backdrop-blur-md text-xs font-semibold border border-white/30">
                                    <i data-lucide="waves"
                                        class="w-4 h-4 text-amber-300 group-hover:animate-bounce"></i>
                                    <span>Aktifitas Sungai Ciliwung</span>
                                </div>
                            </div>
                        </div>

                        {{-- Secondary Image --}}
                        <div class="relative overflow-hidden rounded-3xl shadow-md border-4 border-amber-50 group">
                            <img src="{{ asset('image-padepokan-2.png') }}" alt="Padepokan Ciliwung Condet 2"
                                class="w-full h-48 object-cover group-hover:scale-108 transition-transform duration-700 ease-out">
                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            {{-- Glassmorphism Badge dengan Lucide Icon --}}
                            <div
                                class="absolute bottom-3 left-3 text-white opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <div
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/20 backdrop-blur-md text-[11px] font-semibold border border-white/30">
                                    <i data-lucide="trees" class="w-3.5 h-3.5 text-amber-300"></i>
                                    <span>Suasana Padepokan</span>
                                </div>
                            </div>
                        </div>

                        {{-- Location Box Interaktif --}}
                        <div
                            class="p-5 rounded-2xl bg-gradient-to-br from-amber-50/90 to-orange-50/50 border border-amber-200/80 shadow-xs hover:shadow-lg hover:border-amber-300 transition-all duration-300 group">
                            <div class="flex items-start gap-3.5">
                                {{-- Animated Icon Pin --}}
                                <div
                                    class="p-3 bg-amber-600 text-white rounded-xl shrink-0 shadow-md shadow-amber-600/20 group-hover:scale-110 group-hover:bg-amber-500 transition-all duration-300">
                                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>

                                {{-- Content Area --}}
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Lokasi
                                            Padepokan</span>
                                    </div>
                                    <p
                                        class="text-xs font-medium text-slate-700 leading-relaxed group-hover:text-slate-900 transition-colors">
                                        Jl. H. Mursali No.99 B, RT.8/RW.1, Balekambang, Kec. Kramat Jati, Kota Jakarta
                                        Timur, Daerah Khusus Ibukota Jakarta 13530
                                    </p>
                                    {{-- Interactive Link to Google Maps --}}
                                    <a href="https://maps.google.com/?q=Padepokan+Ciliwung+Condet" target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-xs font-bold text-amber-600 hover:text-amber-700 pt-1 transition-colors group/link">
                                        <span>Buka di Google Maps</span>
                                        <svg class="w-3.5 h-3.5 ml-1 group-hover/link:translate-x-1 transition-transform duration-200"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Paragraph & Feature Cards --}}
                    <div class="lg:col-span-7 space-y-6" data-aos="fade-left">
                        {{-- Introduction Card --}}
                        <div
                            class="p-6 sm:p-7 rounded-3xl bg-amber-50/40 border border-amber-200/60 shadow-xs hover:shadow-md hover:border-amber-300/80 transition-all duration-300">
                            <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                                <span class="font-bold text-amber-700">Padepokan Ciliwung Condet</span> merupakan pusat
                                pelestarian budaya Betawi sekaligus kawasan wisata berbasis alam, seni, dan pendidikan
                                yang berada di kawasan Condet, Jakarta Timur. Padepokan ini didirikan sebagai wadah
                                untuk menjaga kelestarian budaya Betawi serta meningkatkan kepedulian masyarakat
                                terhadap lingkungan, khususnya Sungai Ciliwung.
                            </p>
                        </div>

                        {{-- Feature Card 1: Kegiatan yang Diselenggarakan --}}
                        <div
                            class="p-6 sm:p-7 rounded-3xl bg-gradient-to-br from-white via-amber-50/30 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="p-2.5 rounded-2xl bg-amber-500/20 backdrop-blur-sm text-amber-700 group-hover:bg-amber-500/30 group-hover:scale-110 transition-all duration-300 shrink-0 border border-transparent group-hover:border-amber-300/40">
                                    <i data-lucide="sparkles"
                                        class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">Kegiatan yang Diselenggarakan</h3>
                            </div>

                            <p class="text-slate-600 text-sm leading-relaxed mb-4">
                                Berbagai kegiatan edukatif & kreatif diselenggarakan secara rutin sebagai tempat
                                pembelajaran seni, budaya, serta ruang berkumpul masyarakat:
                            </p>

                            {{-- Interactive Tags --}}
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl hover:bg-amber-100 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer">
                                    <i data-lucide="palette" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Pelatihan Seni Betawi</span>
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl hover:bg-amber-100 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer">
                                    <i data-lucide="brush" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Membatik & Melukis</span>
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl hover:bg-amber-100 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer">
                                    <i data-lucide="waves" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Susur Sungai Ciliwung</span>
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl hover:bg-amber-100 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer">
                                    <i data-lucide="sprout" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Pertanian & Edukasi Lingkungan</span>
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl hover:bg-amber-100 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer">
                                    <i data-lucide="party-popper" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Festival Budaya</span>
                                </span>
                            </div>
                        </div>

                        {{-- Feature Card 2: Dampak Positif --}}
                        <div
                            class="p-6 sm:p-7 rounded-3xl bg-gradient-to-br from-white via-emerald-50/20 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-emerald-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="p-2.5 rounded-2xl bg-emerald-500/20 backdrop-blur-sm text-emerald-700 group-hover:bg-emerald-500/30 group-hover:scale-110 transition-all duration-300 shrink-0 border border-transparent group-hover:border-emerald-300/40">
                                    <i data-lucide="trending-up"
                                        class="w-5 h-5 group-hover:rotate-6 transition-transform duration-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">Dampak Positif bagi Warga</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs font-medium text-slate-700">
                                <div
                                    class="flex items-start gap-2 p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/50 hover:border-emerald-200 transition-colors duration-200">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Meningkatkan pelestarian seni & budaya Betawi</span>
                                </div>
                                <div
                                    class="flex items-start gap-2 p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/50 hover:border-emerald-200 transition-colors duration-200">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Peluang ekonomi sektor wisata & usaha kreatif</span>
                                </div>
                                <div
                                    class="flex items-start gap-2 p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/50 hover:border-emerald-200 transition-colors duration-200">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Penanaman pohon & mitigasi banjir</span>
                                </div>
                                <div
                                    class="flex items-start gap-2 p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/50 hover:border-emerald-200 transition-colors duration-200">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Memperkuat hubungan sosial masyarakat</span>
                                </div>
                            </div>
                        </div>

                        {{-- Highlight Banner Card: Community Tourism --}}
                        <div
                            class="p-6 rounded-3xl bg-gradient-to-br from-amber-600 via-orange-500 to-amber-700 text-white shadow-xl shadow-amber-600/20 hover:scale-[1.01] hover:shadow-2xl transition-all duration-300 flex items-center gap-4 group">
                            <div
                                class="p-3 bg-white/20 backdrop-blur-md rounded-2xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="sprout" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] uppercase font-extrabold tracking-wider bg-white/20 px-2.5 py-1 rounded-full mb-1.5 inline-block border border-white/20">Community-Based
                                    Tourism</span>
                                <p class="text-xs sm:text-sm text-amber-50 leading-relaxed font-medium">
                                    Pengunjung tidak hanya menikmati keindahan alam Sungai Ciliwung, tetapi juga
                                    mengenal langsung kesenian, tradisi, kerajinan, dan kearifan lokal masyarakat
                                    Betawi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Betawi Section Divider: Wave & Gigi Balang Accent --}}
        <div class="relative w-full overflow-hidden leading-none py-4 my-6">
            {{-- Decorative Background Line --}}
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-dashed border-amber-300/80"></div>
            </div>

            {{-- Center Badge with Gigi Balang Pattern --}}
            <div class="relative flex justify-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-700 text-amber-300 border-2 border-amber-400 shadow-md">
                    {{-- Gigi Balang Pattern SVG --}}
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                    <i data-lucide="flower-2" class="w-4 h-4 text-rose-400 shrink-0"></i>
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tentang Ngider Betawi Section --}}
        <section id="ngider-betawi"
            class="relative py-16 bg-gradient-to-b from-amber-50/50 via-white to-amber-50/30 overflow-hidden">
            {{-- Background Decorative Glows --}}
            <div class="absolute top-1/4 -left-32 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-1/3 -right-32 w-96 h-96 bg-orange-300/20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20 relative z-10">

                {{-- SECTION HERO / HEADER --}}
                <div class="text-center max-w-2xl mx-auto space-y-3" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Tentang Ngider
                        Betawi</span>
                    <h2
                        class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug">
                        NYOK MENGENAL <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 via-orange-500 to-amber-700">NGIDER
                            BETAWI</span>
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm font-medium leading-relaxed max-w-xl mx-auto">
                        Petualangan edukatif lintas pos seni, budaya, dan konservasi alam Ciliwung dalam format quest
                        interaktif yang seru dan membanggakan.
                    </p>
                </div>


                {{-- I. LATAR BELAKANG NGIDER BETAWI --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {{-- Quote & Challenge Card --}}
                    <div class="lg:col-span-5 flex flex-col justify-between p-8 rounded-3xl bg-gradient-to-br from-amber-600 via-orange-600 to-amber-700 text-white shadow-xl shadow-amber-600/20 relative overflow-hidden group"
                        data-aos="fade-right">
                        <div class="w-fit animate-bounce">
                            <img src="{{ asset('ondel-cewe.png') }}" alt="ondel-ondel cewe"
                                class="w-15 h-15 sm:w-20 sm:h-20 object-contain">
                        </div>
                        <div class="space-y-6 relative z-10">
                            <blockquote class="text-xl sm:text-2xl font-black leading-snug tracking-tight">
                                "Ngaku orang Jakarta, tapi udah kenal bener sama budaya Betawi belum?"
                            </blockquote>
                            <p class="text-amber-100 text-sm leading-relaxed font-normal">
                                Bukan sekadar Ondel-Ondel atau Kerak Telor. Ada nilai kehidupan, kesenian, dan kearifan
                                <span class="font-bold text-white">Kembar Aer</span> antara masyarakat Betawi dengan
                                Sungai Ciliwung yang diwariskan turun-temurun.
                            </p>
                        </div>
                        <div class="pt-8 border-t border-white/20 mt-6 relative z-10">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-xl bg-white/20 backdrop-blur-md">
                                    <i data-lucide="trees" class="w-5 h-5 text-amber-200"></i>
                                </div>
                                <span class="text-xs font-semibold text-amber-50">Berlokasi di Padepokan Ciliwung
                                    Condet</span>
                            </div>
                        </div>
                    </div>
                    {{-- Narrative Content Card --}}
                    <div class="lg:col-span-7 p-6 sm:p-8 rounded-3xl bg-white border border-amber-200/80 shadow-xs hover:shadow-xl transition-all duration-300 space-y-5"
                        data-aos="fade-left">
                        {{-- Header & Text Group --}}
                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-2 text-amber-700 font-extrabold text-xs tracking-wider uppercase">
                                <i data-lucide="book-open-check" class="w-4 h-4"></i>
                                <span>Mengapa Ngider Betawi Hadir?</span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 leading-snug">
                                Belajar Budaya yang Seru, Interaktif, dan Berkesan
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Makin banyak anak muda lebih akrab dengan budaya populer dibanding budaya daerahnya.
                                Bukan karena tidak peduli, melainkan belum menemukan wadah pembelajaran yang interaktif
                                dan relevan.
                            </p>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Di <span class="font-bold text-amber-700">Ngider Betawi</span>, kamu tidak duduk manis
                                mendengarkan ceramah. Kamu akan berpindah dari pos ke pos menabuh marawis, melukis
                                topeng Betawi, hingga menyusuri Sungai Ciliwung.
                            </p>
                        </div>

                        {{-- Key Value Pill Badges --}}
                        <div class="pt-4 border-t border-slate-100 space-y-2">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nilai Utama Kegiatan
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl">
                                    <i data-lucide="users" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Gotong Royong</span>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl">
                                    <i data-lucide="heart-handshake" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Kebersamaan</span>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 rounded-xl">
                                    <i data-lucide="waves" class="w-3.5 h-3.5 text-amber-600"></i>
                                    <span>Filosofi Kembar Aer</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- II. KEGIATAN NGIDER BETAWI (THE CULTURAL QUEST) --}}
                <div class="space-y-10">
                    <div class="text-center max-w-2xl mx-auto space-y-2" data-aos="fade-up">
                        <div
                            class="inline-flex items-center gap-2 text-amber-700 font-extrabold text-xs tracking-wider uppercase">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span>Rangkaian Misi 5 Jam</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900">Jelajah Pos Cultural Quest</h2>
                        <p class="text-slate-600 text-sm">Kumpulkan cap pada Kartu Misi dan raih predikat Agen
                            Pelestari Budaya Betawi!</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Pembukaan Misi --}}
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-white via-amber-50/25 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
                            data-aos="fade-up">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200 rounded-full">
                                        Titik Awal
                                    </span>
                                </div>
                                {{-- Image Dokumentasi Pembukaan --}}
                                <div
                                    class="relative overflow-hidden rounded-2xl aspect-video bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('image-misi-pembukaan.png') }}" alt="Pembukaan Misi & Nyahi"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-1">Pembukaan & Misi dimulai
                                    </h3>
                                    <p class="text-xs font-medium text-amber-700">Padepokan Ciliwung Condet</p>
                                </div>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Petualangan dimulai di Padepokan Ciliwung Condet. Di sini, kamu bukan sekadar
                                    peserta wisata,
                                    melainkan Agen Pelestari Budaya Betawi yang memiliki misi untuk diselesaikan. Setiap
                                    peserta akan
                                    menerima Kartu Misi yang akan menemani perjalanan dari awal hingga akhir. Sebelum
                                    memulai petualangan,
                                    kamu juga akan mengikuti tradisi Nyahi, yaitu sarapan bersama menggunakan hidangan
                                    khas Betawi seperti kue
                                    cucur atau uli bakar.
                                </p>
                            </div>
                            <div
                                class="pt-4 border-t border-slate-100 mt-4 flex items-center gap-2 text-xs font-bold text-slate-500">
                                <i data-lucide="coffee" class="w-4 h-4 text-amber-600"></i>
                                <span>Tradisi Kuliner & Briefing</span>
                            </div>
                        </div>

                        {{-- Pos 1 --}}
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-white via-amber-50/25 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-200 rounded-full">
                                        Pos 1
                                    </span>
                                </div>
                                {{-- Image Dokumentasi Pos 1 --}}
                                <div
                                    class="relative overflow-hidden rounded-2xl aspect-video bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('image-misi-marawis.png') }}" alt="Menabuh Harmoni Marawis"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-1">Menabuh Harmoni lewat
                                        Marawis</h3>
                                    <p class="text-xs font-medium text-amber-700">Akulturasi & Kerja Sama</p>
                                </div>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Bersama seniman dari Padepokan Ciliwung Condet, kamu akan mengenal sejarah, fungsi
                                    sosial,
                                    dan filosofi marawis sebagai kesenian yang lahir dari pertemuan budaya Arab, Melayu,
                                    dan Betawi.
                                    Setelah memahami ceritanya, saatnya mencoba memainkan marawis secara langsung. Irama
                                    demi irama dimainkan
                                    bersama hingga tercipta harmoni yang hanya bisa dibangun melalui kerja sama.
                                </p>
                            </div>
                            <div
                                class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs font-bold">
                                <span class="text-slate-500 flex items-center gap-1.5">
                                    <i data-lucide="award" class="w-4 h-4 text-amber-600"></i>
                                    Tantangan Kartu Misi
                                </span>
                                <span class="text-amber-700">Cap #1</span>
                            </div>
                        </div>

                        {{-- Pos 2 --}}
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-white via-amber-50/25 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
                            data-aos="fade-up" data-aos-delay="200">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-200 rounded-full">
                                        Pos 2
                                    </span>
                                </div>
                                {{-- Image Dokumentasi Pos 2 --}}
                                <div
                                    class="relative overflow-hidden rounded-2xl aspect-video bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('image-misi-topeng.png') }}" alt="Makna Dibalik Topeng Betawi"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-1">Makna dibalik Topeng Betawi
                                    </h3>
                                    <p class="text-xs font-medium text-amber-700">Filosofi Warna & Karya Seni</p>
                                </div>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Di pos ini, peserta diajak memahami filosofi warna dan karakter Topeng Betawi, mulai
                                    dari merah yang melambangkan keberanian, putih yang mencerminkan kesucian, hingga
                                    warna-warna
                                    lain yang menggambarkan berbagai sifat manusia. Setelah memahami maknanya, kamu akan
                                    melukis topeng
                                    kosong sesuai kreativitasmu — menjadi suvenir yang membawa pulang cerita tentang
                                    budaya Betawi.
                                </p>
                            </div>
                            <div
                                class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs font-bold">
                                <span class="text-slate-500 flex items-center gap-1.5">
                                    <i data-lucide="award" class="w-4 h-4 text-amber-600"></i>
                                    Tantangan Kartu Misi
                                </span>
                                <span class="text-amber-700">Cap #2</span>
                            </div>
                        </div>

                        {{-- Pos 3 --}}
                        <div
                            class="p-6 rounded-3xl bg-gradient-to-br from-white via-emerald-50/25 to-white backdrop-blur-md border border-amber-200/70 shadow-xs hover:shadow-xl hover:shadow-emerald-500/10 hover:border-amber-300 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group md:col-span-2 lg:col-span-2 relative overflow-hidden">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider bg-emerald-100 text-emerald-900 border border-emerald-200 rounded-full">
                                        Pos 3 (Puncak Misi)
                                    </span>
                                </div>
                                {{-- Image Dokumentasi Pos 3 (Aksi Konservasi) --}}
                                <div
                                    class="relative overflow-hidden rounded-2xl aspect-video sm:aspect-[21/9] bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('image-misi-kaliciliwung.png') }}"
                                        alt="Aksi Konservasi Ciliwung"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-1">Menjaga Ciliwung & Warisan
                                        Betawi</h3>
                                    <p class="text-xs font-medium text-emerald-700">Aksi Konservasi & Kembar Aer</p>
                                </div>
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs font-medium text-slate-700 pt-2">
                                    <div
                                        class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-100 flex items-start gap-2">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                        <span>Aksi bersih sampah area bantaran</span>
                                    </div>
                                    <div
                                        class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-100 flex items-start gap-2">
                                        <i data-lucide="sprout" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                        <span>Tanam pohon endemik (Loa/Melinjo)</span>
                                    </div>
                                    <div
                                        class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-100 flex items-start gap-2">
                                        <i data-lucide="messages-square"
                                            class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                        <span>Sesi refleksi filosofi alam & budaya</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs font-bold">
                                <span class="text-slate-500 flex items-center gap-1.5">
                                    <i data-lucide="award" class="w-4 h-4 text-emerald-600"></i>
                                    Tantangan Kartu Misi Akhir
                                </span>
                                <span class="text-emerald-700">Cap #3 (Selesai)</span>
                            </div>
                        </div>

                        {{-- Penutupan --}}
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-amber-50/80 backdrop-blur-md border border-amber-200 shadow-xs hover:shadow-xl hover:shadow-amber-500/15 hover:border-amber-300 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
                            data-aos="fade-up" data-aos-delay="300">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider bg-amber-200 text-amber-900 rounded-full">
                                        Selebrasi
                                    </span>
                                </div>
                                {{-- Image Dokumentasi Penutupan --}}
                                <div
                                    class="relative overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('image-misi-sertifikat.png') }}" alt="Penobatan & Sertifikat"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 mb-1">Penobatan & Sertifikat</h3>
                                    <p class="text-xs font-medium text-amber-700">Agen Pelestari Budaya</p>
                                </div>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Seluruh peserta berkumpul untuk berbagi cerita dan merefleksikan pengalaman.
                                    Perjalanan ditutup dengan pembuatan konten foto atau video kreatif sebagai kampanye
                                    digital. Setelah seluruh cap dikumpulkan, panitia menentukan Pemenang Ngider Betawi,
                                    dan
                                    seluruh peserta menerima Sertifikat Agen Pelestari Budaya.
                                </p>
                            </div>
                            <div
                                class="pt-4 border-t border-amber-200/60 mt-4 flex items-center gap-2 text-xs font-bold text-amber-800">
                                <i data-lucide="camera" class="w-4 h-4 text-amber-600"></i>
                                <span>Kampanye Digital & Award</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Betawi Section Divider: Wave & Gigi Balang Accent --}}
        <div class="relative w-full overflow-hidden leading-none py-4 my-6">
            {{-- Decorative Background Line --}}
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-dashed border-amber-300/80"></div>
            </div>

            {{-- Center Badge with Gigi Balang Pattern --}}
            <div class="relative flex justify-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-700 text-amber-300 border-2 border-amber-400 shadow-md">
                    {{-- Gigi Balang Pattern SVG --}}
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                    <i data-lucide="flower-2" class="w-4 h-4 text-rose-400 shrink-0"></i>
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Section Materi & Fun Fact Budaya Betawi --}}
        <section id="funfact" class="py-16 bg-white text-slate-800" x-data="{ tab: 'kembar-aer' }">
            <div class="max-w-4xl mx-auto px-4 sm:px-6">
                {{-- Header Section --}}
                <div class="text-center mb-8" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Fun Fact
                        Betawi</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">Materi Budaya Betawi</h2>
                </div>
                {{-- Tab Navigation --}}
                <div class="bg-amber-50/60 p-1 rounded-xl flex items-center justify-start sm:justify-between gap-1 mb-6 border border-amber-100/80 overflow-x-auto no-scrollbar"
                    data-aos="fade-up" data-aos-delay="100">
                    <button @click="tab = 'kembar-aer'"
                        :class="tab === 'kembar-aer' ? 'bg-orange-500 text-white shadow-sm' :
                            'text-slate-600 hover:text-slate-900'"
                        class="flex-1 shrink-0 py-2 px-3 sm:py-2.5 sm:px-4 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 text-center whitespace-nowrap active:scale-95"
                        data-aos="zoom-in" data-aos-delay="150">
                        Kembar Aer
                    </button>
                    <button @click="tab = 'marawis'"
                        :class="tab === 'marawis' ? 'bg-orange-500 text-white shadow-sm' :
                            'text-slate-600 hover:text-slate-900'"
                        class="flex-1 shrink-0 py-2 px-3 sm:py-2.5 sm:px-4 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 text-center whitespace-nowrap active:scale-95"
                        data-aos="zoom-in" data-aos-delay="200">
                        Marawis
                    </button>
                    <button @click="tab = 'topeng'"
                        :class="tab === 'topeng' ? 'bg-orange-500 text-white shadow-sm' :
                            'text-slate-600 hover:text-slate-900'"
                        class="flex-1 shrink-0 py-2 px-3 sm:py-2.5 sm:px-4 rounded-lg text-xs sm:text-sm font-bold transition-all duration-200 text-center whitespace-nowrap active:scale-95"
                        data-aos="zoom-in" data-aos-delay="250">
                        Topeng Betawi
                    </button>
                </div>
                {{-- TAB CONTENT: KEMBAR AER --}}
                <div x-show="tab === 'kembar-aer'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-3 scale-98"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="space-y-6" x-cloak
                    data-aos="fade-up" data-aos-delay="150">
                    <div class="p-6 rounded-2xl bg-amber-50/50 border border-amber-100/60 space-y-2 hover:shadow-md transition-shadow duration-300"
                        data-aos="fade-right">
                        <h4 class="font-bold text-slate-900 text-base">Apa itu Kembar Aer?</h4>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                            "Aer dijage, hidup pun terjage." Pernah dengar istilah Kembar Aer? Bagi masyarakat Betawi,
                            manusia dan Kali Ciliwung
                            ibarat saudara kembar yang saling menjaga. Dari sungailah kehidupan tumbuh, budaya
                            berkembang, dan cerita Betawi terus
                            mengalir hingga hari ini.
                        </p>
                    </div>
                    <div class="overflow-hidden rounded-2xl aspect-video bg-slate-100 shadow-sm border border-slate-100 group"
                        data-aos="zoom-in" data-aos-delay="150">
                        <img src="{{ asset('image-funfact-kembar aer.png') }}" alt="Kembar Aer"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                {{-- TAB CONTENT: MARAWIS --}}
                <div x-show="tab === 'marawis'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-3 scale-98"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="space-y-6" x-cloak
                    data-aos="fade-up" data-aos-delay="150">
                    {{-- Grid Gambar Marawis --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" data-aos="fade-up">
                        <div class="overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 shadow-sm border border-slate-100 group"
                            data-aos="fade-right">
                            <img src="{{ asset('image-funfact-marawis-1.png') }}" alt="Materi Marawis 1"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 shadow-sm border border-slate-100 group"
                            data-aos="fade-left" data-aos-delay="100">
                            <img src="{{ asset('image-funfact-marawis-2.png') }}" alt="Materi Marawis 2"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                    {{-- Box Tujuan Belajar --}}
                    <div class="p-6 rounded-2xl bg-amber-50/50 border border-amber-100/60 space-y-2 hover:shadow-md transition-shadow duration-300"
                        data-aos="fade-up">
                        <h4 class="font-bold text-slate-900 text-base">Tujuan Belajar</h4>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Setelah mempelajari materi ini, kamu diharapkan dapat menjelaskan asal-usul Marawis,
                            mengenal bagian-bagian alatnya, memahami cara memainkannya, serta menyadari pentingnya
                            melestarikan kesenian ini sebagai warisan budaya Betawi.
                        </p>
                    </div>
                    {{-- Detail & Fun Fact --}}
                    <div class="space-y-4 pt-2" data-aos="fade-up">
                        <div class="flex items-center justify-between">
                            <h3 class="font-extrabold text-slate-900 text-lg">1. Pengertian & Asal-Usul Marawis</h3>
                            <i data-lucide="chevron-up" class="w-5 h-5 text-orange-500"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Marawas (sering juga ditulis marwas) adalah alat musik pukul (perkusi) berbentuk gendang
                            kecil yang menjadi 'bintang utama' dalam kesenian musik Marawis. Karena alat inilah yang
                            paling banyak dipakai dan paling menonjol suaranya, seluruh kesenian musiknya pun akhirnya
                            dikenal dengan nama Marawis yang merupakan bentuk jamak dari kata Marwas.
                        </p>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Marawis adalah hasil perpaduan budaya, yaitu kolaborasi antara kesenian Timur Tengah dan
                            budaya Betawi. Musik ini sangat kental dengan nuansa keagamaan (Islami), karena syair-syair
                            yang dinyanyikan umumnya berisi pujian dan rasa cinta kepada Sang Pencipta serta shalawat
                            kepada Nabi Muhammad SAW.
                        </p>
                        {{-- Highlight Fun Fact Box --}}
                        <div class="p-6 rounded-2xl bg-amber-50/60 border-l-4 border-orange-500 border-y border-r border-amber-100/80 space-y-2"
                            data-aos="fade-up" data-aos-delay="150">
                            <h5 class="font-extrabold text-slate-900 text-sm sm:text-base">Fun Fact: Asal-Usul yang
                                Masih Diperdebatkan!</h5>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Ternyata, asal-usul pasti kesenian Marawis masih menjadi perbincangan para ahli budaya.
                                Sebagian meyakini alat ini berasal dari Yaman (Hadramaut) dan dibawa masuk ke Nusantara
                                oleh para ulama penyebar Islam sekitar akhir abad ke-19. Ada juga catatan yang
                                menghubungkannya dengan masuknya tari Zapin Arab sejak abad ke-13, dibawa oleh pedagang
                                Arab, Persia, dan India. Karena itu, sampai sekarang tidak ada satu jawaban tunggal yang
                                pasti!
                            </p>
                        </div>
                    </div>
                </div>
                {{-- TAB CONTENT: TOPENG BETAWI --}}
                <div x-show="tab === 'topeng'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-3 scale-98"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="space-y-6" x-cloak
                    data-aos="fade-up" data-aos-delay="150">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" data-aos="fade-up">
                        <div class="overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 shadow-sm border border-slate-100 group"
                            data-aos="fade-right">
                            <img src="{{ asset('image-funfact-topeng-1.png') }}" alt="Topeng Betawi 1"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 shadow-sm border border-slate-100 group"
                            data-aos="fade-left" data-aos-delay="100">
                            <img src="{{ asset('image-funfact-topeng-2.png') }}" alt="Topeng Betawi 2"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                    <div class="p-6 rounded-2xl bg-amber-50/50 border border-amber-100/60 space-y-2 hover:shadow-md transition-shadow duration-300"
                        data-aos="fade-up">
                        <h4 class="font-bold text-slate-900 text-base">1. Pengertian & Ragam Fungsi Topeng Betawi</h4>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Topeng Betawi adalah topeng tradisional khas masyarakat Betawi yang berasal dari daerah
                            Jakarta dan sekitarnya...
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Betawi Section Divider: Wave & Gigi Balang Accent --}}
        <div class="relative w-full overflow-hidden leading-none py-4 my-6 group/divider">
            {{-- Decorative Background Line --}}
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-dashed border-amber-300/80"></div>
            </div>

            {{-- Center Badge with Gigi Balang Pattern --}}
            <div class="relative flex justify-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-700 text-amber-300 border-2 border-amber-400 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                    {{-- Gigi Balang Pattern SVG --}}
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                    <i data-lucide="flower-2"
                        class="w-4 h-4 text-rose-400 shrink-0 group-hover/divider:rotate-180 transition-transform duration-700 ease-in-out"></i>
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Paket Wisata Edukasi Section --}}
        <section id="paket" class="py-20 bg-slate-50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Pilihan
                        Kunjungan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Daftar Paket Wisata Edukasi</h2>
                    <p class="mt-3 text-slate-600 text-sm sm:text-base">Pilih paket terbaik sesuai kebutuhan rombongan
                        sekolah, keluarga, atau komunitasmu.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($pakets as $p)
                        <div class="bg-gradient-to-br from-white via-amber-50/20 to-white backdrop-blur-md p-7 rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-3 py-1 text-[11px] font-bold text-amber-800 bg-amber-100 rounded-full border border-amber-200/60">
                                        Paket Edukasi
                                    </span>
                                    <span class="text-xs text-slate-400 font-medium">Min. 20 Peserta</span>
                                </div>

                                {{-- Gambar Sampul Paket jika ada --}}
                                @if ($p->gambar)
                                    <div
                                        class="relative overflow-hidden rounded-2xl aspect-video bg-slate-100 shadow-xs border border-slate-200/60">
                                        <img src="{{ Str::startsWith($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar) }}"
                                            alt="{{ $p->nama_paket }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endif

                                <div>
                                    <h3
                                        class="text-xl font-black text-slate-900 group-hover:text-amber-600 transition duration-300">
                                        {{ $p->nama_paket }}</h3>
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                        {{ $p->deskripsi ?? 'Paket petualangan budaya dan pelestarian lingkungan Ciliwung Condet.' }}
                                    </p>
                                </div>

                                <div class="pt-2 border-t border-slate-100">
                                    <span class="text-xs text-slate-400 block font-medium">Investasi Edukasi</span>
                                    <p
                                        class="text-2xl sm:text-3xl font-black text-amber-600 group-hover:scale-105 transition-transform duration-300 origin-left">
                                        Rp {{ number_format($p->harga, 0, ',', '.') }} <span
                                            class="text-xs font-semibold text-slate-400">/orang</span></p>
                                </div>

                                @if ($p->posKegiatan && $p->posKegiatan->count() > 0)
                                    <div class="pt-3 border-t border-slate-100 space-y-2">
                                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                            Aktivitas Termasuk:</p>
                                        <ul class="space-y-1.5 text-xs text-slate-600">
                                            @foreach ($p->posKegiatan as $pos)
                                                <li class="flex items-center gap-2">
                                                    <i data-lucide="check-circle-2"
                                                        class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                                                    <span>{{ $pos->nama_pos }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-6 mt-6 border-t border-slate-100">
                                <a href="{{ route('booking.create', $p->id) }}"
                                    class="relative overflow-hidden flex items-center justify-center gap-2 w-full py-3.5 text-center text-sm font-bold text-white bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 rounded-2xl shadow-md shadow-amber-600/20 hover:shadow-xl hover:shadow-amber-600/30 transition-all duration-300 group/btn">
                                    <span
                                        class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                                    <span class="relative z-10 flex items-center gap-2">
                                        <span>Pesan Paket Ini</span>
                                        <i data-lucide="arrow-right"
                                            class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-200"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-8 text-center bg-white rounded-3xl border border-slate-200">
                            <p class="text-slate-500 text-sm">Belum ada paket wisata yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Betawi Section Divider: Wave & Gigi Balang Accent --}}
        <div class="relative w-full overflow-hidden leading-none py-4 my-6">
            {{-- Decorative Background Line --}}
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-dashed border-amber-300/80"></div>
            </div>

            {{-- Center Badge with Gigi Balang Pattern --}}
            <div class="relative flex justify-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-700 text-amber-300 border-2 border-amber-400 shadow-md">
                    {{-- Gigi Balang Pattern SVG --}}
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                    <i data-lucide="flower-2" class="w-4 h-4 text-rose-400 shrink-0"></i>
                    <svg class="w-12 h-3 text-amber-300 fill-current" viewBox="0 0 120 20">
                        <polygon points="0,0 20,0 10,20" />
                        <polygon points="25,0 45,0 35,20" />
                        <polygon points="50,0 70,0 60,20" />
                        <polygon points="75,0 95,0 85,20" />
                        <polygon points="100,0 120,0 110,20" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Galeri Section --}}
        <section id="galeri" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Dokumentasi
                        Kegiatan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Galeri Suasana Padepokan</h2>
                    <p class="mt-3 text-slate-600 text-sm">Momen keseruan belajar, bermain gamelan, melukis topeng, dan
                        susur sungai Ciliwung.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $defaultGaleri = [
                            [
                                'title' => 'Suasana Padepokan & Ciliwung',
                                'category' => 'Lingkungan',
                                'image' => asset('image-padepokan-1.png'),
                                'location' => 'Padepokan Ciliwung Condet',
                            ],
                            [
                                'title' => 'Praktik Melukis Topeng Betawi',
                                'category' => 'Seni Budaya',
                                'image' => asset('image-misi-topeng.png'),
                                'location' => 'Bale Kesenian',
                            ],
                            [
                                'title' => 'Harmoni Musik Marawis',
                                'category' => 'Musik Tradisional',
                                'image' => asset('image-misi-marawis.png'),
                                'location' => 'Pendopo Utama',
                            ],
                            [
                                'title' => 'Aksi Susur Sungai & Konservasi',
                                'category' => 'Konservasi',
                                'image' => asset('image-misi-kaliciliwung.png'),
                                'location' => 'Bantaran Ciliwung',
                            ],
                            [
                                'title' => 'Penganugerahan Agen Budaya',
                                'category' => 'Selebrasi',
                                'image' => asset('image-misi-sertifikat.png'),
                                'location' => 'Bale Budaya',
                            ],
                        ];
                    @endphp

                    @if (isset($galeris) && $galeris->count() > 0)
                        @foreach ($galeris as $index => $item)
                            <div class="relative group overflow-hidden rounded-2xl shadow-sm border border-slate-100/80 hover:shadow-xl hover:border-amber-300/80 transition-all duration-500 {{ $index == 0 ? 'col-span-2 row-span-2' : '' }}"
                                data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                <img src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->judul }}"
                                    class="w-full h-full min-h-[220px] object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-white">
                                    <span
                                        class="text-xs text-amber-300 font-bold uppercase tracking-wider">Dokumentasi</span>
                                    <h4
                                        class="text-lg font-bold group-hover:translate-x-1 transition-transform duration-300">
                                        {{ $item->judul }}</h4>
                                    <p class="text-xs text-slate-200 mt-1 flex items-center gap-1">📍 Padepokan
                                        Ciliwung Condet</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($defaultGaleri as $index => $item)
                            <div class="relative group overflow-hidden rounded-2xl shadow-sm border border-slate-100/80 hover:shadow-xl hover:border-amber-300/80 transition-all duration-500 {{ $index == 0 ? 'col-span-2 row-span-2' : '' }}"
                                data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                                    class="w-full h-full min-h-[220px] object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-white">
                                    <span
                                        class="text-xs text-amber-300 font-bold uppercase tracking-wider">{{ $item['category'] }}</span>
                                    <h4
                                        class="text-lg font-bold group-hover:translate-x-1 transition-transform duration-300">
                                        {{ $item['title'] }}</h4>
                                    <p class="text-xs text-slate-200 mt-1 flex items-center gap-1">📍
                                        {{ $item['location'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        {{-- Testimoni Section --}}
        <section id="testimoni" class="py-20 bg-amber-50/50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Apa Kata
                        Mereka</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Ulasan Guru & Pengunjung</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @if (isset($testimonis) && $testimonis->count() > 0)
                        @foreach ($testimonis as $t)
                            <div class="bg-gradient-to-br from-white via-amber-50/30 to-white backdrop-blur-md p-8 rounded-3xl border border-amber-200/60 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1.5 transition-all duration-300 space-y-4 group relative overflow-hidden"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div
                                    class="flex text-amber-500 gap-1 text-sm group-hover:scale-105 transition-transform origin-left">
                                    @for ($i = 0; $i < ($t->rating ?? 5); $i++)
                                        ★
                                    @endfor
                                </div>
                                <p class="text-slate-600 text-sm leading-relaxed">"{{ $t->isi }}"</p>
                                <div class="flex items-center gap-3 pt-2">
                                    <div
                                        class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm shadow-inner group-hover:scale-110 transition-transform">
                                        {{ strtoupper(substr($t->nama_sekolah, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $t->nama_sekolah }}</p>
                                        <p class="text-xs text-slate-500">Rombongan Terverifikasi</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="bg-gradient-to-br from-white via-amber-50/30 to-white backdrop-blur-md p-8 rounded-3xl border border-amber-200/60 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1.5 transition-all duration-300 space-y-4 group relative overflow-hidden">
                            <div
                                class="flex text-amber-500 gap-1 text-sm group-hover:scale-105 transition-transform origin-left">
                                ★★★★★</div>
                            <p class="text-slate-600 text-sm leading-relaxed">"Siswa-siswi kami sangat antusias! Konsep
                                gamifikasinya bikin anak-anak aktif bergerak sambil belajar sejarah Betawi dan
                                pelestarian sungai."</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm shadow-inner group-hover:scale-110 transition-transform">
                                    IB
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Ibu Nurhasanah, S.Pd.</p>
                                    <p class="text-xs text-slate-500">Guru SD Jakarta Selatan</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-br from-white via-amber-50/30 to-white backdrop-blur-md p-8 rounded-3xl border border-amber-200/60 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1.5 transition-all duration-300 space-y-4 group relative overflow-hidden">
                            <div
                                class="flex text-amber-500 gap-1 text-sm group-hover:scale-105 transition-transform origin-left">
                                ★★★★★</div>
                            <p class="text-slate-600 text-sm leading-relaxed">"Suasananya asri di pinggir Ciliwung
                                Condet. Edukasi konservasinya riil, anak-anak bisa langsung praktik menanam bibit
                                tanaman."</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm shadow-inner group-hover:scale-110 transition-transform">
                                    BP
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Bapak Hendra</p>
                                    <p class="text-xs text-slate-500">Pembina Komunitas Remaja</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-br from-white via-amber-50/30 to-white backdrop-blur-md p-8 rounded-3xl border border-amber-200/60 shadow-xs hover:shadow-xl hover:shadow-amber-500/10 hover:border-amber-300 hover:-translate-y-1.5 transition-all duration-300 space-y-4 group relative overflow-hidden">
                            <div
                                class="flex text-amber-500 gap-1 text-sm group-hover:scale-105 transition-transform origin-left">
                                ★★★★★</div>
                            <p class="text-slate-600 text-sm leading-relaxed">"Kulinernya mantap, pemandunya ramah dan
                                paham betul sejarah Condet. Sangat direkomendasikan untuk studi tur sekolah."</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-200 text-amber-900 font-bold flex items-center justify-center text-sm shadow-inner group-hover:scale-110 transition-transform">
                                    SR
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Siti Rahma</p>
                                    <p class="text-xs text-slate-500">Orang Tua Murid</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- FAQ Section (Alpine.js) --}}
        <section id="faq" class="py-20 bg-white" x-data="{ openFaq: null }">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-2">Pertanyaan
                        Populer</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Pertanyaan Sering Diajukan (FAQ)</h2>
                </div>

                <div class="space-y-4">
                    <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-300 hover:shadow-md"
                        data-aos="fade-up">
                        <button @click="openFaq === 1 ? openFaq = null : openFaq = 1"
                            class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-amber-50/50 transition duration-200">
                            <span>Bagaimana cara melakukan pemesanan paket wisata rombongan?</span>
                            <span
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-lg transition-transform duration-300"
                                :class="openFaq === 1 ? 'rotate-180 bg-amber-100 text-amber-700' : ''">+</span>
                        </button>
                        <div x-show="openFaq === 1" x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                            class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Anda dapat memilih paket di atas lalu klik tombol "Pesan Paket Ini". Tim kami akan membantu
                            memverifikasi ketersediaan tanggal dan jadwal pemandu.
                        </div>
                    </div>

                    <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-300 hover:shadow-md"
                        data-aos="fade-up" data-aos-delay="100">
                        <button @click="openFaq === 2 ? openFaq = null : openFaq = 2"
                            class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-amber-50/50 transition duration-200">
                            <span>Berapa minimal jumlah peserta untuk reservasi rombongan?</span>
                            <span
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-lg transition-transform duration-300"
                                :class="openFaq === 2 ? 'rotate-180 bg-amber-100 text-amber-700' : ''">+</span>
                        </button>
                        <div x-show="openFaq === 2" x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                            class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Untuk paket grup sekolah atau komunitas, minimal kuota kunjungan adalah 15 orang peserta.
                        </div>
                    </div>

                    <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition-all duration-300 hover:border-amber-300 hover:shadow-md"
                        data-aos="fade-up" data-aos-delay="200">
                        <button @click="openFaq === 3 ? openFaq = null : openFaq = 3"
                            class="w-full p-6 text-left font-bold text-slate-900 flex justify-between items-center hover:bg-amber-50/50 transition duration-200">
                            <span>Apakah lokasi Padepokan aman untuk anak-anak?</span>
                            <span
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-lg transition-transform duration-300"
                                :class="openFaq === 3 ? 'rotate-180 bg-amber-100 text-amber-700' : ''">+</span>
                        </button>
                        <div x-show="openFaq === 3" x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                            class="px-6 pb-6 text-sm text-slate-600 border-t border-slate-100 pt-4 leading-relaxed">
                            Sangat aman. Area kegiatan dilengkapi pagar pengaman, instruktur terlatih, dan perlengkapan
                            keselamatan standar saat berada di area bantaran sungai.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Floating Buttons (Scroll to Top & WhatsApp) --}}
        <div x-data="{ showTopBtn: false }" x-init="window.addEventListener('scroll', () => { showTopBtn = window.scrollY > 300 })"
            class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 items-center">

            {{-- Tombol Scroll to Top --}}
            <button x-show="showTopBtn" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-90"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="w-12 h-12 rounded-full bg-white text-orange-500 shadow-lg border border-slate-100 flex items-center justify-center hover:bg-slate-50 hover:scale-110 active:scale-95 transition-all duration-300"
                title="Kembali ke atas">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current stroke-[2.5]" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </button>

            {{-- Tombol Floating WhatsApp --}}
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ngider%20Betawi,%20saya%20ingin%20bertanya%20seputar%20paket%20wisata."
                target="_blank" rel="noopener noreferrer"
                class="w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 relative group"
                title="Chat via WhatsApp">

                <span
                    class="absolute -inset-1 rounded-full bg-emerald-400 opacity-75 animate-ping group-hover:opacity-0"></span>

                <svg class="w-7 h-7 fill-current relative z-10" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </a>
        </div>

        {{-- Footer --}}
        <footer
            class="bg-gradient-to-b from-emerald-950 to-stone-900 text-stone-300 py-16 border-t border-amber-600/30 relative overflow-hidden">
            {{-- Aksen Glow Halus di Background --}}
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-amber-600/5 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-600/5 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                    {{-- Deskripsi Brand --}}
                    <div class="md:col-span-1 space-y-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo Ngider Betawi"
                                class="w-10 h-10 object-contain">
                            <span class="text-xl font-black tracking-tight text-white">
                                Ngider<span class="text-amber-600">Betawi</span>
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-stone-400 leading-relaxed font-normal">
                            Sistem Informasi Wisata Edukasi & Gamifikasi Kebudayaan Betawi di Padepokan Ciliwung Condet.
                        </p>
                    </div>
                    {{-- Navigasi Cepat --}}
                    <div>
                        <h4 class="text-amber-600 font-bold text-xs mb-4 uppercase tracking-widest">Navigasi Cepat</h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-stone-400">
                            <li><a href="#hero"
                                    class="hover:text-amber-600 transition-colors duration-200">Beranda</a></li>
                            <li><a href="#konsep" class="hover:text-amber-600 transition-colors duration-200">Konsep
                                    Wisata</a></li>
                            <li><a href="#paket" class="hover:text-amber-600 transition-colors duration-200">Paket
                                    Edukasi</a></li>
                            <li><a href="#galeri" class="hover:text-amber-600 transition-colors duration-200">Galeri
                                    Suasana</a></li>
                        </ul>
                    </div>
                    {{-- Kontak & Media Sosial --}}
                    <div class="space-y-3">
                        <h4 class="text-amber-600 font-bold text-xs mb-4 uppercase tracking-widest">Hubungi Kami</h4>
                        <ul class="space-y-3 text-xs sm:text-sm text-stone-400">
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="map-pin" class="w-4 h-4 text-amber-600/80 shrink-0 mt-0.5"></i>
                                <span>Padepokan Ciliwung Condet, Balekambang, Kramat Jati, Jakarta Timur.</span>
                            </li>
                            <li>
                                <a href="https://wa.me/6281234567890" target="_blank"
                                    class="flex items-center gap-2.5 hover:text-amber-600 transition-colors duration-200">
                                    <i data-lucide="phone" class="w-4 h-4 text-amber-600/80 shrink-0"></i>
                                    <span>+62 812-3456-7890</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@ngiderbetawi.id"
                                    class="flex items-center gap-2.5 hover:text-amber-600 transition-colors duration-200">
                                    <i data-lucide="mail" class="w-4 h-4 text-amber-600/80 shrink-0"></i>
                                    <span>info@ngiderbetawi.id</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- Lokasi Peta --}}
                    <div>
                        <h4 class="text-amber-600 font-bold text-xs mb-4 uppercase tracking-widest">Lokasi Peta</h4>
                        <div
                            class="w-full h-36 rounded-xl overflow-hidden border border-stone-800 shadow-inner relative">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.867702816962!2d106.8529241!3d-6.2811105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2f3cb065d6d%3A0xb3ef1ad0952d9a65!2sPadepokan%20Ciliwung%20Condet!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                class="w-full h-full border-0 opacity-90 hover:opacity-100 transition-opacity duration-300"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
                {{-- Bottom Copyright --}}
                <div
                    class="pt-8 border-t border-stone-800/80 text-center text-xs text-stone-500 flex flex-col sm:flex-row justify-between items-center gap-2">
                    <p>&copy; {{ date('Y') }} NgiderBetawi - Padepokan Ciliwung Condet.</p>
                    <p class="text-stone-400 font-medium">Wisata Edukasi & Budaya Betawi</p>
                </div>
            </div>
        </footer>
    </div>
</x-layouts.app>
