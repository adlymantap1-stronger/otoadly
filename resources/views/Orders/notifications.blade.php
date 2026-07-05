@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-3xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
                ← Beranda
            </a>
            <h1 class="font-display text-2xl font-bold text-navy-950 mt-2">Notifikasi Pesanan</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($notifications as $notif)
            @php $data = $notif->data; $order = \App\Models\Order::find($data['order_id']); @endphp
            <div class="bg-white rounded-2xl border {{ $notif->read_at ? 'border-gray-100' : 'border-amber-400' }} p-6 mb-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        {{-- Dot unread --}}
                        @if (!$notif->read_at)
                            <div class="w-2.5 h-2.5 bg-amber-400 rounded-full mt-1.5 flex-shrink-0"></div>
                        @else
                            <div class="w-2.5 h-2.5 bg-gray-200 rounded-full mt-1.5 flex-shrink-0"></div>
                        @endif
                        <div>
                            <div class="font-semibold text-navy-950">{{ $data['message'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                HP/WA: {{ $data['buyer_phone'] }} &middot; {{ $notif->created_at->diffForHumans() }}
                            </div>
                            @if ($order)
                                <div class="text-xs text-gray-500 mt-1">
                                    Alamat: {{ $order->address }}
                                </div>
                                @if ($order->note)
                                    <div class="text-xs text-gray-500 mt-1">
                                        Catatan: {{ $order->note }}
                                    </div>
                                @endif
                                {{-- Status badge --}}
                                <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full font-semibold
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($order->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $order->status === 'pending' ? 'Menunggu' : ($order->status === 'confirmed' ? 'Dikonfirmasi' : 'Ditolak') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol konfirmasi/tolak --}}
                    @if ($order && $order->status === 'pending')
                        <div class="flex gap-2 flex-shrink-0">
                            <form action="{{ route('orders.confirm', $order) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-green-500 text-white text-xs font-semibold px-3 py-2 rounded-lg hover:-translate-y-0.5 transition">
                                    Konfirmasi
                                </button>
                            </form>
                            <form action="{{ route('orders.reject', $order) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-red-500 text-white text-xs font-semibold px-3 py-2 rounded-lg hover:-translate-y-0.5 transition">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 py-16 border-2 border-dashed border-gray-200 rounded-xl">
                Belum ada notifikasi pesanan masuk.
            </div>
        @endforelse

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>

    </div>
</div>

@endsection