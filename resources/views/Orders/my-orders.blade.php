@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-3xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
                ← Beranda
            </a>
            <h1 class="font-display text-2xl font-bold text-navy-950 mt-2">Pesanan Saya</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($orders as $order)
            <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-4">
                <div class="flex gap-4 items-start">

                    {{-- Foto mobil --}}
                    <div class="w-20 h-16 rounded-lg overflow-hidden bg-navy-800 flex-shrink-0">
                        @if ($order->car->image)
                            <img src="{{ asset('storage/' . $order->car->image) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/20 text-xs">No foto</div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <div class="font-display font-bold text-navy-950">
                            {{ $order->car->brand }} {{ $order->car->model }}
                        </div>
                        <div class="text-xs text-gray-500 mt-0.5">
                            {{ $order->car->year }} &middot; {{ ucfirst($order->car->transmission) }}
                        </div>
                        <div class="text-amber-400 font-bold text-sm mt-1">
                            Rp {{ number_format($order->car->price, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-gray-400 mt-1">
                            Dipesan {{ $order->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="flex-shrink-0">
                        <span class="inline-block text-xs px-3 py-1 rounded-full font-semibold
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($order->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ $order->status === 'pending' ? '⏳ Menunggu' : ($order->status === 'confirmed' ? '✅ Dikonfirmasi' : '❌ Ditolak') }}
                        </span>
                    </div>

                </div>

                {{-- Info tambahan kalau dikonfirmasi --}}
                @if ($order->status === 'confirmed')
                    <div class="mt-4 pt-4 border-t border-gray-100 bg-green-50 rounded-lg p-3">
                        <p class="text-sm text-green-700 font-semibold">Pesanan dikonfirmasi! 🎉</p>
                        <p class="text-xs text-green-600 mt-1">
                            Penjual akan menghubungi kamu di nomor <strong>{{ $order->phone }}</strong> untuk proses selanjutnya.
                        </p>
                    </div>
                @endif

                @if ($order->status === 'rejected')
                    <div class="mt-4 pt-4 border-t border-gray-100 bg-red-50 rounded-lg p-3">
                        <p class="text-sm text-red-700 font-semibold">Pesanan ditolak.</p>
                        <p class="text-xs text-red-600 mt-1">Coba hubungi penjual langsung atau cari mobil lain.</p>
                        <a href="{{ route('cars.index') }}" class="text-xs text-amber-500 font-semibold mt-1 inline-block">
                            Cari mobil lain →
                        </a>
                    </div>
                @endif

            </div>
        @empty
            <div class="text-center text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-xl">
                Belum ada pesanan. <a href="{{ route('cars.index') }}" class="text-amber-500 font-semibold">Cari mobil sekarang →</a>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>
</div>

@endsection