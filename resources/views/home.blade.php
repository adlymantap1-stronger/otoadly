@extends('layouts.app')

@section('content')

<div class="bg-navy-950 py-2 text-sm text-slate-300 border-b border-white/5 overflow-hidden">
    <div class="flex whitespace-nowrap animate-marquee">
        <span class="mx-16">Otoadly - Marketplace Jual Beli Mobil Bekas &nbsp;&bull;&nbsp; Ribuan pilihan mobil terverifikasi, aman, dan terpercaya.</span>
        <span class="mx-16">Otoadly - Marketplace Jual Beli Mobil Bekas &nbsp;&bull;&nbsp; Ribuan pilihan mobil terverifikasi, aman, dan terpercaya.</span>
    </div>
</div>
<nav class="bg-navy-950 px-6 md:px-12 py-5 flex items-center border-b border-white/5">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
        <svg viewBox="0 0 60 30" width="48" height="24" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="10" width="56" height="16" rx="4" fill="#0B1220" stroke="#F5A623" stroke-width="1.5"/>
            <path d="M10 10 C13 3, 18 1, 24 1 L36 1 C42 1, 47 3, 50 10 Z" fill="#F5A623"/>
            <line x1="30" y1="1" x2="30" y2="10" stroke="#0B1220" stroke-width="1.2"/>
            <circle cx="14" cy="26" r="5" fill="#0B1220" stroke="#F5A623" stroke-width="1.2"/>
            <circle cx="14" cy="26" r="2" fill="#F5A623"/>
            <circle cx="46" cy="26" r="5" fill="#0B1220" stroke="#F5A623" stroke-width="1.2"/>
            <circle cx="46" cy="26" r="2" fill="#F5A623"/>
            <rect x="2" y="13" width="5" height="3" rx="1" fill="#F5A623"/>
            <rect x="53" y="13" width="5" height="3" rx="1" fill="#F5A623"/>
        </svg>
        <span class="font-display text-xl font-bold text-white">Oto<span class="text-amber-400">adly</span></span>
    </a>

    {{-- Menu tengah --}}
    <div class="hidden md:flex flex-1 items-center justify-center gap-8 text-sm">
        <a href="#mobil-pilihan" class="text-slate-300 hover:text-white transition">Beli Mobil</a>
        <a href="{{ route('cars.create') }}" class="text-slate-300 hover:text-white transition">Jual Mobil</a>
        <a href="{{ route('simulasi-kredit') }}" class="text-slate-300 hover:text-white transition">Simulasi Kredit</a>
        <a href="#bantuan" class="text-slate-300 hover:text-white transition">Bantuan</a>
    </div>

    {{-- User / Auth --}}
    @auth
        <div class="flex items-center gap-3 relative flex-shrink-0" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 text-slate-300 hover:text-white text-sm transition">
                <span>{{ auth()->user()->name }}</span>
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="bg-amber-400 text-navy-950 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.outside="open = false"
                 class="absolute right-0 top-10 bg-navy-800 border border-white/10 rounded-xl shadow-xl w-48 py-2 z-50">
                <a href="{{ route('orders.notifications') }}" class="flex items-center justify-between px-4 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition">
                    Notifikasi
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="bg-amber-400 text-navy-950 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('orders.my') }}" class="block px-4 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition">
                    Pesanan Saya
                </a>
                <div class="border-t border-white/10 my-1"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-white/5 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="flex items-center gap-3 flex-shrink-0">
            <a href="{{ route('login') }}" class="text-slate-300 text-sm hover:text-white transition">Masuk</a>
            <a href="{{ route('cars.create') }}" class="bg-amber-400 text-navy-950 text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
                + Jual Mobil Anda
            </a>
        </div>
    @endauth
</nav>

<section class="relative overflow-hidden pt-20 pb-28 px-6 text-center bg-navy-950">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=1200&q=80" 
             alt="Background Mobil" 
             class="w-full h-full object-cover opacity-25 mix-blend-luminosity">
        
        <div class="absolute inset-0 bg-linear-to-b from-navy-950 via-navy-950/85 to-navy-900"></div>
        
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_900px_500px_at_80%_-10%,rgba(245,166,35,0.15),transparent_60%)] pointer-events-none"></div>
    </div>
    
    <div class="relative z-10 max-w-3xl mx-auto">
        <h1 class="font-display text-4xl md:text-6xl font-bold text-white leading-[1.1]">
            Cari Mobil Bekas.<br>
            <span class="text-amber-400">Tanpa Drama.</span>
        </h1>
        <p class="text-slate-300 mt-6 text-base md:text-lg max-w-xl mx-auto">
            Ribuan mobil dari penjual yang sudah diverifikasi identitas dan dokumennya.
            Cek riwayat, harga pasar, dan langsung hubungi penjualnya.
        </p>
    </div>

    <div class="relative z-10 max-w-2xl mx-auto mt-10 rounded-2xl p-3 md:p-4 bg-white/5 border border-white/10 backdrop-blur-md">
    <div class="flex gap-2 mb-3">
        <a href="{{ route('cars.index') }}" class="text-sm font-semibold px-4 py-2 rounded-lg bg-amber-400 text-navy-950">
            Beli
        </a>
        <a href="{{ route('cars.create') }}" class="text-sm font-semibold px-4 py-2 rounded-lg text-slate-300 hover:text-white transition">
            Jual
        </a>
    </div>
        <form action="{{ route('cars.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
    <input
        type="text"
        name="q"
        placeholder="Merk, model, atau kata kunci — misal 'Avanza 2019'"
        class="flex-1 bg-white/95 rounded-lg px-4 py-3 text-sm text-navy-950 placeholder:text-gray-400 focus:outline-none"
    >
    <button type="submit" class="bg-amber-400 text-navy-950 font-semibold px-6 py-3 rounded-lg text-sm whitespace-nowrap hover:-translate-y-0.5 transition">
        Cari Mobil &rarr;
    </button>
</form>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-0.5 opacity-50 z-10"
         style="background: repeating-linear-gradient(90deg, #F5A623 0 28px, transparent 28px 52px);">
    </div>
</section>

<section class="bg-navy-900 py-8">
    <div class="max-w-4xl mx-auto flex items-center justify-center gap-6 md:gap-12 px-6 text-center">
        <div>
            <div class="font-display text-2xl md:text-3xl font-bold text-white">2.400+</div>
            <div class="text-xs text-slate-300 mt-1">Unit aktif</div>
        </div>
        <div class="w-px h-10 bg-white/15"></div>
        <div>
            <div class="font-display text-2xl md:text-3xl font-bold text-white">850+</div>
            <div class="text-xs text-slate-300 mt-1">Penjual terverifikasi</div>
        </div>
        <div class="w-px h-10 bg-white/15"></div>
        <div>
            <div class="font-display text-2xl md:text-3xl font-bold text-white">34</div>
            <div class="text-xs text-slate-300 mt-1">Kota terjangkau</div>
        </div>
    </div>
</section>

<section id="mobil-pilihan" class="bg-paper py-20 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-end justify-between mb-8">
            <div>
                <div class="text-xs font-semibold text-amber-400 uppercase tracking-wide mb-1">Baru ditambahkan</div>
                <h2 class="font-display text-2xl md:text-3xl font-bold text-navy-950">Mobil pilihan hari ini</h2>
            </div>
            <a href="{{ route('cars.index') }}" class="text-sm font-semibold text-navy-950 hidden md:block">Lihat semua &rarr;</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
    @forelse ($cars as $car)
        <a href="{{ route('cars.show', $car) }}"
           class="block bg-white rounded-xl overflow-hidden border border-gray-100 hover:-translate-y-1 hover:shadow-xl transition">
            <div class="h-40 bg-white flex items-center justify-center">
               @if ($car->image)
             <img src="{{ $car->image }}"
            alt="{{ $car->brand }} {{ $car->model }}"
            class="w-full h-full object-cover">
            @else
                    <span class="text-white/20 text-xs">Tidak ada foto</span>
                @endif
            </div>
                <div class="p-4">
                    <div class="font-semibold text-navy-950">{{ $car->brand }} {{ $car->model }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">
                        {{ $car->year }} &middot; {{ number_format($car->mileage) }} km &middot; {{ ucfirst($car->transmission) }}
                    </div>
                    <div class="font-display font-bold text-navy-950 mt-3">
                        Rp {{ number_format($car->price, 0, ',', '.') }}
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-12 border-2 border-dashed border-gray-200 rounded-xl">
                Belum ada mobil. <a href="{{ route('cars.create') }}" class="text-amber-500 font-semibold">Tambah sekarang →</a>
            </div>
        @endforelse
    </div>
    </div>
</section>

{{-- Section Bantuan / FAQ --}}
<section id="bantuan" class="bg-navy-950 py-20 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <div class="text-xs font-semibold text-amber-400 uppercase tracking-wide mb-2">Bantuan</div>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-white">Pertanyaan yang Sering Ditanyakan</h2>
        </div>

        <div class="space-y-4">
            <details class="bg-navy-800 rounded-xl border border-white/10 p-5 group">
                <summary class="font-semibold text-white cursor-pointer list-none flex justify-between items-center">
                    Bagaimana cara menjual mobil di Otoadly?
                    <span class="text-amber-400 text-lg">+</span>
                </summary>
                <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                    Daftar akun, lalu klik tombol "+ Jual Mobil". Isi data mobil lengkap beserta foto, dan iklan kamu langsung tampil di marketplace.
                </p>
            </details>

            <details class="bg-navy-800 rounded-xl border border-white/10 p-5 group">
                <summary class="font-semibold text-white cursor-pointer list-none flex justify-between items-center">
                    Apakah gratis untuk memasang iklan?
                    <span class="text-amber-400 text-lg">+</span>
                </summary>
                <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                    Ya, memasang iklan di Otoadly sepenuhnya gratis. Tidak ada biaya apapun untuk mendaftar dan memasang iklan mobil.
                </p>
            </details>

            <details class="bg-navy-800 rounded-xl border border-white/10 p-5 group">
                <summary class="font-semibold text-white cursor-pointer list-none flex justify-between items-center">
                    Bagaimana cara membeli mobil?
                    <span class="text-amber-400 text-lg">+</span>
                </summary>
                <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                    Cari mobil yang kamu inginkan, buka halaman detailnya, lalu klik "Beli Sekarang". Isi form checkout dan penjual akan segera menghubungi kamu.
                </p>
            </details>

            <details class="bg-navy-800 rounded-xl border border-white/10 p-5 group">
                <summary class="font-semibold text-white cursor-pointer list-none flex justify-between items-center">
                    Apakah mobil yang dijual sudah terverifikasi?
                    <span class="text-amber-400 text-lg">+</span>
                </summary>
                <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                    Kami melakukan verifikasi identitas penjual saat pendaftaran. Namun tetap disarankan untuk melakukan pengecekan fisik dan dokumen sebelum transaksi.
                </p>
            </details>

            <details class="bg-navy-800 rounded-xl border border-white/10 p-5 group">
                <summary class="font-semibold text-white cursor-pointer list-none flex justify-between items-center">
                    Bagaimana jika ada masalah dengan transaksi?
                    <span class="text-amber-400 text-lg">+</span>
                </summary>
                <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                    Hubungi tim Otoadly melalui WhatsApp atau email yang tertera di footer. Kami siap membantu menyelesaikan masalah kamu.
                </p>
            </details>
        </div>
    </div>
</section>

{{-- Peta Lokasi --}}
<section class="bg-navy-900 py-16 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-8">
            <div class="text-xs font-semibold text-amber-400 uppercase tracking-wide mb-2">Lokasi Kami</div>
            <h2 class="font-display text-2xl font-bold text-white">Kantor Otoadly</h2>
        </div>
        <div class="rounded-2xl overflow-hidden border border-white/10 h-72">
            {{-- Ganti koordinat di bawah ini sesuai lokasi kamu --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2!2d106.9606146!3d-6.2708122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d8d9493bf01%3A0xbfa0103d503d4894!2sJl.%20H.%20Abas%2C%20Jakamulya%2C%20Kec.%20Bekasi%20Sel.%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017146!5e0!3m2!1sid!2sid!4v1234567890"
              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="bg-navy-950 border-t border-white/10 py-12 px-6">
    <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-10">

        {{-- Brand --}}
        <div>
            <div class="font-display text-2xl font-bold text-white mb-3">
                Oto<span class="text-amber-400">adly</span>
            </div>
            <p class="text-slate-300 text-sm leading-relaxed">
                Marketplace jual beli mobil bekas terpercaya. Ribuan pilihan dari penjual terverifikasi di seluruh Indonesia.
            </p>
        </div>

        {{-- Navigasi --}}
        <div>
            <div class="font-semibold text-white mb-4">Navigasi</div>
            <ul class="space-y-2 text-sm text-slate-300">
                <li><a href="{{ route('cars.index') }}" class="hover:text-amber-400 transition">Beli Mobil</a></li>
                <li><a href="{{ route('cars.create') }}" class="hover:text-amber-400 transition">Jual Mobil</a></li>
                <li><a href="{{ route('simulasi-kredit') }}" class="hover:text-amber-400 transition">Simulasi Kredit</a></li>
                <li><a href="#bantuan" class="hover:text-amber-400 transition">Bantuan & FAQ</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <div class="font-semibold text-white mb-4">Kontak & Info</div>
            <ul class="space-y-2 text-sm text-slate-300">
                <li class="flex items-center gap-2">
                <span>📍</span> Jl. Cikunir Raya, H. Abas RT.001/RW.002, Jakamulya, Bekasi Selatan 17146
                </li>
                <li class="flex items-center gap-2">
                    <span>📱</span> +62 812 3456 7890
                </li>
                <li class="flex items-center gap-2">
                    <span>✉️</span> admin@otoadly.com
                </li>
            </ul>
        </div>

    </div>

    <div class="max-w-5xl mx-auto border-t border-white/10 mt-10 pt-6 text-center text-xs text-slate-300">
        © {{ date('Y') }} Otoadly. All Rights Reserved.
    </div>
</footer>

@endsection`