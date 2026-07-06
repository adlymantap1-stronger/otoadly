@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-2xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
                ← Beranda
            </a>
            <h1 class="font-display text-2xl font-bold text-navy-950 mt-2">Simulasi Kredit</h1>
            <p class="text-gray-500 text-sm mt-1">Hitung estimasi cicilan mobil kamu</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">

            <div>
                <label class="text-sm font-semibold text-navy-950">Harga Mobil (Rp)</label>
                <input type="number" id="harga" placeholder="150000000"
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                       oninput="hitung()">
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Uang Muka / DP (Rp)</label>
                <input type="number" id="dp" placeholder="30000000"
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                       oninput="hitung()">
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Tenor (bulan)</label>
                <select id="tenor" class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400" onchange="hitung()">
                    <option value="12">12 bulan (1 tahun)</option>
                    <option value="24">24 bulan (2 tahun)</option>
                    <option value="36" selected>36 bulan (3 tahun)</option>
                    <option value="48">48 bulan (4 tahun)</option>
                    <option value="60">60 bulan (5 tahun)</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Bunga per Tahun (%)</label>
                <input type="number" id="bunga" value="10" step="0.1"
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                       oninput="hitung()">
            </div>

            {{-- Hasil --}}
            <div id="hasil" class="hidden bg-navy-950 rounded-xl p-5 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-slate-300 text-sm">Pokok Pinjaman</span>
                    <span class="text-white font-semibold" id="pokok">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-300 text-sm">Total Bunga</span>
                    <span class="text-white font-semibold" id="totalBunga">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-300 text-sm">Total Bayar</span>
                    <span class="text-white font-semibold" id="totalBayar">-</span>
                </div>
                <div class="border-t border-white/10 pt-3 flex justify-between items-center">
                    <span class="text-amber-400 font-semibold">Cicilan per Bulan</span>
                    <span class="text-amber-400 font-display text-xl font-bold" id="cicilan">-</span>
                </div>
            </div>

            <p class="text-xs text-gray-400">* Simulasi ini bersifat estimasi. Bunga dan cicilan aktual dapat berbeda tergantung kebijakan leasing.</p>

        </div>
    </div>
</div>

<script>
function hitung() {
    const harga = parseFloat(document.getElementById('harga').value) || 0;
    const dp = parseFloat(document.getElementById('dp').value) || 0;
    const tenor = parseInt(document.getElementById('tenor').value);
    const bunga = parseFloat(document.getElementById('bunga').value) || 0;

    if (harga <= 0 || harga <= dp) return;

    const pokok = harga - dp;
    const bungaPerBulan = bunga / 100 / 12;
    const totalBunga = pokok * (bunga / 100) * (tenor / 12);
    const totalBayar = pokok + totalBunga;
    const cicilan = totalBayar / tenor;

    const fmt = n => 'Rp ' + Math.round(n).toLocaleString('id-ID');

    document.getElementById('pokok').textContent = fmt(pokok);
    document.getElementById('totalBunga').textContent = fmt(totalBunga);
    document.getElementById('totalBayar').textContent = fmt(totalBayar);
    document.getElementById('cicilan').textContent = fmt(cicilan);
    document.getElementById('hasil').classList.remove('hidden');
}
</script>

@endsection