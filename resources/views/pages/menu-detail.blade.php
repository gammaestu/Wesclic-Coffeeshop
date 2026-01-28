@extends('layouts.app')

@section('title', $menu->name)
@section('description', $menu->description ?? 'Menu details')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <p class="text-white/80 mb-2">
                        <a href="{{ route('menu') }}" class="hover:underline">Menu</a>
                        <span class="mx-2">/</span>
                        <span>{{ $menu->name }}</span>
                    </p>
                    <h1 class="text-4xl md:text-5xl font-bold font-serif">{{ $menu->name }}</h1>
                    <p class="text-white/90 mt-3">{{ $menu->category?->name }}</p>
                </div>
                <div class="text-3xl font-bold">${{ number_format($menu->price, 2) }}</div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-[#F7F7F2]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="h-80 bg-gradient-to-br from-[#A3B18A] to-[#B08968] flex items-center justify-center">
                        @if($menu->image_url)
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-3">Description</h2>
                        <p class="text-[#3A3A3A]/70 leading-relaxed mb-6">
                            {{ $menu->description ?? 'No description available.' }}
                        </p>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-[#F7F7F2] border border-[#A3B18A]/20 mb-6">
                            <div>
                                <div class="text-sm text-[#3A3A3A]/60">Availability</div>
                                @if($menu->isAvailable())
                                    <div class="font-semibold text-green-700">Available (Stock: {{ $menu->stock }})</div>
                                @else
                                    <div class="font-semibold text-red-600">Out of Stock</div>
                                @endif
                            </div>
                            <div class="text-xl font-bold text-[#B08968]">${{ number_format($menu->price, 2) }}</div>
                        </div>

                        <button
                            onclick="addToCartHandler({{ json_encode(['id' => $menu->id, 'name' => $menu->name, 'price' => (float)$menu->price, 'image' => $menu->image_url]) }})"
                            class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $menu->isAvailable() ? '' : 'disabled' }}
                        >
                            Add to Cart
                        </button>

                        <div class="mt-4 flex gap-3">
                            <a href="{{ route('cart') }}" class="flex-1 text-center bg-[#B08968] hover:bg-[#D4A373] text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Go to Cart
                            </a>
                            <a href="{{ route('menu') }}" class="flex-1 text-center bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold py-3 px-6 rounded-lg transition-colors">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

