@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen">

    {{-- Header --}}
    <div class="bg-navy-950 px-6 md:px-12 py-8">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-10">
           <a href="{{ route('home') }}" class="text-slate-300 hover:text-white text-sm font-semibold px-4 py-2 rounded-lg border border-white/20 hover:border-white/40 transition">
                 ← Beranda
            </a>
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
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
                    <p class="text-slate-300 text-sm mt-0.5">Semua Mobil</p>
                </div>
            </div>
            <a href="{{ route('cars.create') }}"
            class="bg-amber-400 text-navy-950 text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
                + Jual Mobil
            </a>
        </div>
    </div>
    {{-- Flash message --}}
    @if (session('success'))
        <div class="max-w-6xl mx-auto px-6 pt-6">
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Grid mobil --}}
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($cars as $car)
                <a href="{{ route('cars.show', $car) }}"
                   class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:-translate-y-1 hover:shadow-xl transition block">
                    <div class="h-40 bg-linear-to-br from-navy-800 to-navy-950 flex items-center justify-center">
             @if ($car->image)
            <<img src="{{ $car->image }}"
                alt="{{ $car->brand }} {{ $car->model }}"
              class="w-full h-full object-contain p-2">
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
                        <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full
                            {{ $car->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $car->status === 'available' ? 'Tersedia' : 'Terjual' }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-4 text-center text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-xl">
                    Belum ada mobil. <a href="{{ route('cars.create') }}" class="text-amber-500 font-semibold">Tambah sekarang →</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $cars->links() }}
        </div>
    </div>

</div>

@endsection