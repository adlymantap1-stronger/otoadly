@extends('layouts.app')

@section('content')

<div class="bg-paper min-h-screen py-10 px-6">
    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-navy-950 transition">
                ← Kembali
            </a>
            <h1 class="font-display text-2xl font-bold text-navy-950 mt-2">Tambah Mobil</h1>
        </div>

        {{-- Form --}}
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-navy-950">Merk</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                           class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                           placeholder="Toyota, Honda, dll">
                    @error('brand') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-navy-950">Model</label>
                    <input type="text" name="model" value="{{ old('model') }}"
                           class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                           placeholder="Avanza, Brio, dll">
                    @error('model') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-navy-950">Tahun</label>
                    <input type="number" name="year" value="{{ old('year') }}"
                           class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                           placeholder="2020">
                    @error('year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-navy-950">Jarak Tempuh (km)</label>
                    <input type="number" name="mileage" value="{{ old('mileage') }}"
                           class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                           placeholder="50000">
                    @error('mileage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}"
                       class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                       placeholder="150000000">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-navy-950">Transmisi</label>
                    <select name="transmission"
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400">
                        <option value="">Pilih transmisi</option>
                        <option value="manual" {{ old('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="matic" {{ old('transmission') === 'matic' ? 'selected' : '' }}>Matic</option>
                    </select>
                    @error('transmission') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-navy-950">Bahan Bakar</label>
                    <select name="fuel_type"
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400">
                        <option value="">Pilih bahan bakar</option>
                        <option value="bensin" {{ old('fuel_type') === 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ old('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="listrik" {{ old('fuel_type') === 'listrik' ? 'selected' : '' }}>Listrik</option>
                        <option value="hybrid" {{ old('fuel_type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    @error('fuel_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-navy-950">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
                          placeholder="Kondisi mobil, kelengkapan surat, dll">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
             <label class="text-sm font-semibold text-navy-950">URL Foto Mobil</label>
            <input type="text" name="image" value="{{ old('image') }}"
           class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-amber-400"
           placeholder="https://contoh.com/foto-mobil.jpg">
            <p class="text-xs text-gray-400 mt-1">Masukkan URL foto mobil dari internet.</p>
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="w-full bg-amber-400 text-navy-950 font-semibold py-3 rounded-lg hover:-translate-y-0.5 hover:shadow-lg transition">
                Simpan Mobil
            </button>
        </form>

    </div>
</div>

@endsection