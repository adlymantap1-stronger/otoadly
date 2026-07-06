@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-4xl mx-auto">

        {{-- Kembali --}}
        <a href="{{ route('cars.index') }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
            ← Kembali ke daftar mobil
        </a>

        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden mt-6">

            {{-- Foto --}}
            <div class="h-72 bg-linear-to-br from-navy-800 to-navy-950 flex items-center justify-center">
                @if ($car->image)
                    <img src="{{ $car->image }}"
                         alt="{{ $car->brand }} {{ $car->model }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-white/20 text-sm">Tidak ada foto</span>
                @endif
            </div>

            <div class="p-6 md:p-8">

                {{-- Status --}}
                <span class="inline-block text-xs px-3 py-1 rounded-full font-semibold
                    {{ $car->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $car->status === 'available' ? 'Tersedia' : 'Terjual' }}
                </span>

                {{-- Nama & Harga --}}
                <h1 class="font-display text-2xl md:text-3xl font-bold text-navy-950 mt-3">
                    {{ $car->brand }} {{ $car->model }}
                </h1>
                <div class="font-display text-2xl font-bold text-amber-400 mt-1">
                    Rp {{ number_format($car->price, 0, ',', '.') }}
                </div>

                {{-- Spesifikasi --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <div class="bg-paper rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-500">Tahun</div>
                        <div class="font-semibold text-navy-950 mt-1">{{ $car->year }}</div>
                    </div>
                    <div class="bg-paper rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-500">Jarak Tempuh</div>
                        <div class="font-semibold text-navy-950 mt-1">{{ number_format($car->mileage) }} km</div>
                    </div>
                    <div class="bg-paper rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-500">Transmisi</div>
                        <div class="font-semibold text-navy-950 mt-1">{{ ucfirst($car->transmission) }}</div>
                    </div>
                    <div class="bg-paper rounded-xl p-4 text-center">
                        <div class="text-xs text-gray-500">Bahan Bakar</div>
                        <div class="font-semibold text-navy-950 mt-1">{{ ucfirst($car->fuel_type) }}</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if ($car->description)
                    <div class="mt-6">
                        <h2 class="font-semibold text-navy-950 mb-2">Deskripsi</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $car->description }}</p>
                    </div>
                @endif

                {{-- Penjual --}}
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="text-xs text-gray-500 mb-1">Dijual oleh</div>
                    <div class="font-semibold text-navy-950">{{ $car->user->name ?? 'Admin' }}</div>
                </div>

                {{-- Tombol WhatsApp --}}
@if ($car->status === 'available')
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $car->user->phone ?? '') }}?text={{ urlencode('Halo, saya tertarik dengan ' . $car->brand . ' ' . $car->model . ' ' . $car->year . ' seharga Rp ' . number_format($car->price, 0, ',', '.') . ' yang Anda iklankan di Otoadly. Apakah masih tersedia?') }}"
       target="_blank"
       class="flex items-center gap-2 bg-green-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.121 1.529 5.849L.057 23.535a.75.75 0 00.908.908l5.686-1.472A11.955 11.955 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.716 9.716 0 01-4.964-1.363l-.355-.212-3.679.952.972-3.578-.232-.368A9.716 9.716 0 012.25 12C2.25 6.615 6.615 2.25 12 2.25S21.75 6.615 21.75 12 17.385 21.75 12 21.75z"/>
            </svg>
            Hubungi Penjual via WhatsApp
        </a>
@endif


        @auth
    @if ($car->status === 'available' && auth()->id() !== $car->user_id)
        <a href="{{ route('orders.create', $car) }}"
           class="flex items-center gap-2 bg-amber-400 text-navy-950 text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition mt-3">
            🛒 Beli Sekarang (Checkout)
        </a>
    @endif
@endauth

                {{-- Tombol aksi --}}
@auth
    @if (auth()->id() === $car->user_id)
        <div class="flex gap-3 mt-6">
            <a href="{{ route('cars.edit', $car) }}"
               class="bg-navy-950 text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 transition">
                Edit Mobil
            </a>
            <form action="{{ route('cars.destroy', $car) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus mobil ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:-translate-y-0.5 transition">
                    Hapus
                </button>
            </form>
        </div>
    @endif
@endauth

            </div>
        </div>

    </div>
</div>

@endsection