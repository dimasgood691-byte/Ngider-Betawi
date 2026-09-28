<x-layouts.app title="Login Admin - Ngider Betawi">
    <div class="min-h-screen flex items-center justify-center bg-slate-50/80 p-4 relative overflow-hidden font-sans">
        
        {{-- Background Decorative Glow (Soft Amber & Emerald) --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Top Navigation Back Button --}}
        <div class="absolute top-6 left-6 z-20">
            <a href="{{ route('home') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold text-amber-800 bg-white/80 hover:bg-white backdrop-blur-md px-4 py-2 rounded-2xl border border-amber-200/80 shadow-xs hover:shadow-md transition-all duration-300 hover:-translate-x-0.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-amber-600"></i>
                <span>Kembali ke Situs</span>
            </a>
        </div>

        <div class="w-full max-w-md bg-gradient-to-b from-white via-amber-50/20 to-white backdrop-blur-md rounded-3xl shadow-xl hover:shadow-2xl shadow-amber-500/10 border border-amber-200/60 overflow-hidden relative z-10 transition-all duration-500" data-aos="fade-up">
            
            {{-- Decorative Gradient Bar Top Accent --}}
            <div class="h-1.5 bg-gradient-to-r from-amber-500 via-orange-500 to-emerald-600"></div>

            {{-- Header Card --}}
            <div class="bg-amber-50/70 px-6 py-8 text-center border-b border-amber-100/80 relative">
                <div class="inline-flex p-3 bg-white rounded-2xl mb-3 shadow-md shadow-amber-500/10 border border-amber-100 group hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('logo-ngiderbetawi.png') }}" alt="Logo Ngider Betawi" class="w-10 h-10 object-contain">
                </div>
                <h1 class="text-2xl font-black text-slate-800 tracking-wide">Login <span class="text-orange-500">Admin</span></h1>
                <p class="text-xs text-slate-500 mt-1 font-medium">Sistem Pengelolaan Wisata Edukasi Ngider Betawi</p>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.login.post') }}" method="POST" class="p-6 sm:p-8 space-y-5">
                @csrf

                @if(session('error'))
                    <div class="p-3.5 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs sm:text-sm rounded-xl font-medium flex items-center gap-2 shadow-2xs" data-aos="fade-in">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-red-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="p-3.5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 text-xs sm:text-sm rounded-xl font-medium flex items-center gap-2 shadow-2xs" data-aos="fade-in">
                        <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0 text-emerald-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Email Input --}}
                <div class="group">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Admin</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 hover:border-slate-300 focus:bg-white focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 outline-none transition-all duration-200 text-sm text-slate-800 @error('email') border-red-500 @enderror"
                            placeholder="admin@ngiderbetawi.com">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 group-focus-within:text-orange-500 absolute left-3.5 top-1/2 -translate-y-1/2 transition-colors"></i>
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div x-data="{ show: false }" class="group">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 hover:border-slate-300 focus:bg-white focus:ring-4 focus:ring-orange-500/15 focus:border-orange-500 outline-none transition-all duration-200 text-sm text-slate-800 @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        <i data-lucide="lock" class="w-4 h-4 text-slate-400 group-focus-within:text-orange-500 absolute left-3.5 top-1/2 -translate-y-1/2 transition-colors"></i>
                        
                        <button type="button" @click="show = !show" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors">
                            <i data-lucide="eye" x-show="!show" class="w-4 h-4"></i>
                            <i data-lucide="eye-off" x-show="show" x-cloak class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer select-none group/check">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-orange-500 border-slate-300 rounded focus:ring-orange-500 cursor-pointer">
                        <span class="ml-2 text-xs font-medium text-slate-600 group-hover/check:text-slate-900 transition-colors">Ingat Saya di Perangkat Ini</span>
                    </label>
                </div>

                {{-- Submit CTA Button --}}
                <button type="submit" 
                    class="relative overflow-hidden w-full py-3 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/25 hover:shadow-xl hover:shadow-orange-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 text-sm flex items-center justify-center gap-2 group/btn">
                    <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-200"></i>
                    </span>
                </button>

                {{-- Security Note Footer --}}
                <div class="pt-2 text-center">
                    <p class="text-[11px] text-slate-400 font-medium flex items-center justify-center gap-1.5">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500"></i>
                        <span>Terenkripsi & Akses Terproteksi</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>