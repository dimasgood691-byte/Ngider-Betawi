<x-layouts.app title="Login Admin - Ngider Betawi">
    <div class="min-h-screen flex items-center justify-center bg-[var(--color-brand-60)] p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" data-aos="fade-up">
            
            <!-- Header Card -->
            <div class="bg-[var(--color-brand-30)] px-6 py-8 text-center text-white">
                <div class="inline-flex p-3 bg-white/10 rounded-full mb-3 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[var(--color-brand-10)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold font-heading">Portal Admin</h1>
                <p class="text-xs text-sky-100 mt-1">Sistem Pengelolaan Wisata Edukasi Ngider Betawi</p>
            </div>

            <!-- Form Body -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="p-6 sm:p-8 space-y-5">
                @csrf

                @if(session('error'))
                    <div class="p-3.5 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="p-3.5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Email Input -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">Email Admin</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-[var(--color-brand-30)] focus:border-transparent outline-none transition text-sm @error('email') border-red-500 @enderror"
                        placeholder="admin@ngiderbetawi.com">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input dengan Toggle Show/Hide -->
                <div x-data="{ show: false }">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700">Password</label>
                        <a href="{{ route('admin.password.request') }}" class="text-xs text-[var(--color-brand-30)] hover:underline font-medium">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-[var(--color-brand-30)] focus:border-transparent outline-none transition text-sm pr-10 @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <span x-show="!show" class="text-xs font-semibold">Lihat</span>
                            <span x-show="show" x-cloak class="text-xs font-semibold">Sembunyi</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[var(--color-brand-30)] border-slate-300 rounded focus:ring-[var(--color-brand-30)]">
                    <label for="remember" class="ml-2 text-xs text-slate-600">Ingat Saya di Perangkat Ini</label>
                </div>

                <!-- Submit CTA Button -->
                <button type="submit" 
                    class="w-full py-3 bg-[var(--color-brand-10)] hover:bg-[var(--color-brand-10-hover)] text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-sm">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>