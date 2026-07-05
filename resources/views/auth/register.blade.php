<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Otoadly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-950 min-h-screen flex items-center justify-center px-4 relative overflow-hidden">

    {{-- Background foto --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=1200&q=80"
             alt="Background Mobil"
             class="w-full h-full object-cover opacity-25 mix-blend-luminosity">
        <div class="absolute inset-0 bg-linear-to-b from-navy-950 via-navy-950/85 to-navy-900"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_900px_500px_at_80%_-10%,rgba(245,166,35,0.15),transparent_60%)] pointer-events-none"></div>
    </div>

    <div class="w-full max-w-md relative z-10">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="font-display text-3xl font-bold text-white">
                Oto<span class="text-amber-400">adly</span>
            </a>
            <p class="text-slate-300 text-sm mt-2">Buat akun penjual baru</p>
        </div>

        {{-- Card --}}
        <div class="bg-navy-800 rounded-2xl border border-white/10 p-8">

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="text-sm font-semibold text-white">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full mt-1 px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white text-sm placeholder:text-slate-300/50 focus:outline-none focus:border-amber-400">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-sm font-semibold text-white">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full mt-1 px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white text-sm placeholder:text-slate-300/50 focus:outline-none focus:border-amber-400">
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Nomor WA --}}
                <div>
                    <label class="text-sm font-semibold text-white">Nomor WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           placeholder="628xxxxxxxxxx"
                           class="w-full mt-1 px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white text-sm placeholder:text-slate-300/50 focus:outline-none focus:border-amber-400">
                    <p class="text-xs text-slate-300/60 mt-1">Format: 628xxxxxxxxxx (tanpa + atau spasi)</p>
                    @error('phone') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-sm font-semibold text-white">Password</label>
                    <input type="password" name="password" required
                           class="w-full mt-1 px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white text-sm placeholder:text-slate-300/50 focus:outline-none focus:border-amber-400">
                    @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="text-sm font-semibold text-white">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full mt-1 px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white text-sm placeholder:text-slate-300/50 focus:outline-none focus:border-amber-400">
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-amber-400 text-navy-950 font-semibold py-3 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
                    Buat Akun
                </button>
            </form>

            <p class="text-center text-sm text-slate-300 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-amber-400 font-semibold hover:text-amber-300 transition">
                    Masuk sekarang
                </a>
            </p>

        </div>
    </div>

</body>
</html>