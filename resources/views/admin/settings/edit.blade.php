@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Shop Name</label>
                <input type="text" name="shop_name" value="{{ old('shop_name', $settings->shop_name) }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Shop Address</label>
                <textarea name="shop_address" rows="3" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">{{ old('shop_address', $settings->shop_address) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Shop Phone</label>
                    <input type="text" name="shop_phone" value="{{ old('shop_phone', $settings->shop_phone) }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Tax (%)</label>
                    <input type="number" step="0.01" name="tax" value="{{ old('tax', $settings->tax) }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
            </div>

            <div class="border-t border-[#A3B18A]/20 pt-6 mt-6">
                <h3 class="text-lg font-semibold text-[#3A3A3A] mb-3">Peta (Lokasi Tepat)</h3>
                <p class="text-sm text-[#3A3A3A]/70 mb-4">Isi koordinat atau nama tempat agar peta di halaman Contact menunjuk ke lokasi yang benar.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Latitude (contoh: -7.829123)</label>
                        <input type="text" name="map_lat" value="{{ old('map_lat', $settings->map_lat) }}" placeholder="-7.829123" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Longitude (contoh: 110.350456)</label>
                        <input type="text" name="map_lng" value="{{ old('map_lng', $settings->map_lng) }}" placeholder="110.350456" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Atau: Nama tempat / alamat untuk pencarian (jika tidak isi lat/lng)</label>
                    <input type="text" name="map_place_query" value="{{ old('map_place_query', $settings->map_place_query) }}" placeholder="Wesclic Coffee Shop, Cobongan Bantul" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection

