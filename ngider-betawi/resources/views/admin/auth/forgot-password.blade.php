<x-app-layout title="Lupa Password Admin - Ngider Betawi">
    <div class="min-h-screen flex items-center justify-center bg-[var(--color-brand-60)] p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" data-aos="fade-up">
            <div class="p-6 sm:p-8 space-y-5">
                <div>
                    <h1 class="text-xl font-bold font-heading text-slate-800">Lupa Password Admin?</h1>
                    <p class="text-xs text-slate-500 mt-1">Masukkan email terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang password Anda.</p>
                </div>

                @if (session('status'))
                <div class="p-3.5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-xs rounded">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold uppercase text-slate-700 mb-1.5">Email Admin</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-[var(--color-brand-30)] outline-none text-sm @error('email') border-red-500 @enderror"
                            placeholder="admin@ngiderbetawi.com">
                        @error('email')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-[var(--color-brand-30)] hover:bg-[var(--color-brand-30-hover)] text-white font-semibold rounded-lg text-sm transition">
                        Kirim Link Reset Password
                    </button>
                </form>

                <div class="text-center pt-2">
                    <a href="{{ route('admin.login') }}" class="text-xs text-slate-500 hover:text-slate-800 font-medium">← Kembali ke Halaman Login</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>