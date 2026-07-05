@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen flex items-center justify-center px-6">
    <div class="max-w-md w-full text-center">

        {{-- Icon sukses --}}
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="font-display text-2xl font-bold text-navy-950">Pesanan Terkirim!</h1>
        <p class="text-gray-500 text-sm mt-3 leading-relaxed">
            Pesanan kamu sudah diterima dan penjual akan segera menghubungi kamu.
            Pantau terus notifikasi untuk update selanjutnya.
        </p>

        {{-- Steps --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mt-8 text-left space-y-4">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-amber-400 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-navy-950 text-xs font-bold">1</span>
                </div>
                <div>
                    <div class="font-semibold text-navy-950 text-sm">Pesanan dikirim</div>
                    <div class="text-gray-500 text-xs mt-0.5">Penjual mendapat notifikasi pesananmu</div>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-gray-400 text-xs font-bold">2</span>
                </div>
                <div>
                    <div class="font-semibold text-gray-400 text-sm">Penjual konfirmasi</div>
                    <div class="text-gray-400 text-xs mt-0.5">Penjual akan mengkonfirmasi pesananmu</div>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-gray-400 text-xs font-bold">3</span>
                </div>
                <div>
                    <div class="font-semibold text-gray-400 text-sm">Deal & transaksi</div>
                    <div class="text-gray-400 text-xs mt-0.5">Penjual menghubungi kamu untuk proses selanjutnya</div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-8">
            <a href="{{ route('welcome') }}"
               class="flex-1 border border-navy-950 text-navy-950 font-semibold py-3 rounded-lg text-sm hover:bg-navy-950 hover:text-white transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('cars.index') }}"
               class="flex-1 bg-amber-400 text-navy-950 font-semibold py-3 rounded-lg text-sm hover:-translate-y-0.5 transition">
                Cari Mobil Lain
            </a>
        </div>

    </div>
</div>

@endsection