@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-2xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('cars.show', $car) }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
                ← Kembali ke detail mobil
            </a>
            <h1 class="font-display text-2xl font-bold text-navy-950 mt-2">Checkout</h1>
        </div>

        {{-- Info mobil --}}
        <div class="bg-navy-950 rounded-2xl p-5 mb-6 flex gap-4 items-center">
            <div class="w-20 h-16 rounded-lg overflow-hidden bg-navy-800 flex-shrink-0">
                @if ($car->image)
                    <img src="{{ $car->image) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-white/20 text-xs">No foto</div>
                @endif
            </div>
            <div>
                <div class="font-display font-bold text-white">{{ $car->brand }} {{ $car->model }}</div>
                <div class="text-slate-300 text-sm">{{ $car->year }} &middot; {{ ucfirst($car->transmission) }}</div>
                <div class="text-amber-400 font-bold mt-1">Rp {{ number_format($car->price, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('orders.store', $car) }}" method="POST"
              class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            @csrf

            <div>
                <label class="text-sm font-semibold text-navy-950">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Nomor HP/WA</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                       placeholder="628xxxxxxxxxx">
                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Alamat</label>
                <textarea name="address" rows="3" required
                          class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                          placeholder="Alamat lengkap kamu">{{ old('address') }}</textarea>
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Catatan (opsional)</label>
                <textarea name="note" rows="2"
                          class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                          placeholder="Misal: minta COD, minta test drive, dll">{{ old('note') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full bg-amber-400 text-navy-950 font-semibold py-3 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
                Kirim Pesanan →
            </button>
        </form>

    </div>
</div>

@endsection