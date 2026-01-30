@extends('layouts.app')

@section('title', 'Menu')
@section('description', 'Jelajahi menu lengkap kami yang berisi kopi premium, teh, dan pastry')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Menu Kami</h1>
            <p class="text-xl text-white/90">Temukan pilihan minuman premium dan pastry kami</p>
        </div>
    </section>
    
    {{-- Menu Filter --}}
    <section class="py-8 bg-[#F7F7F2] sticky top-20 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('menu') }}" class="menu-filter {{ !$selectedCategory ? 'active' : '' }} px-6 py-2 {{ !$selectedCategory ? 'bg-[#A3B18A] text-white' : 'bg-white text-[#3A3A3A] hover:bg-[#A3B18A] hover:text-white' }} rounded-lg font-semibold transition-colors">
                    Semua Item
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('menu', ['category' => strtolower($category->name)]) }}" 
                       class="menu-filter {{ $selectedCategory === strtolower($category->name) ? 'active' : '' }} px-6 py-2 {{ $selectedCategory === strtolower($category->name) ? 'bg-[#A3B18A] text-white' : 'bg-white text-[#3A3A3A] hover:bg-[#A3B18A] hover:text-white' }} rounded-lg font-semibold transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- Menu Items --}}
    <section class="py-16 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="menu-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-children">
                @forelse($menus as $menu)
                    <div class="menu-item hover-lift" data-category="{{ strtolower($menu->category->name) }}">
                        @include('components.product-card', [
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'price' => $menu->price,
                            'description' => $menu->description,
                            'category' => $menu->category->name,
                            'image' => $menu->image_url,
                            'badge' => $menu->stock < 10 ? 'Terbatas' : null,
                        ])
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-xl text-[#3A3A3A]/70">Tidak ada item yang tersedia di kategori ini.</p>
                        <a href="{{ route('menu') }}" class="inline-block mt-4 bg-[#A3B18A] hover:bg-[#8FA075] text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            Lihat Semua Item
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Use global cart manager
    function updateCartCount() {
        if (!window.cartManager) return;
        const count = window.cartManager.getTotalItems();
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl) cartCountEl.textContent = count;
    }
    
    // Initialize cart count
    document.addEventListener('DOMContentLoaded', function () {
        // In some setups Vite module may not have executed yet when this runs.
        let tries = 100;
        (function waitForCartManager() {
            if (window.cartManager) return updateCartCount();
            if (--tries <= 0) return;
            setTimeout(waitForCartManager, 50);
        })();
    });
</script>
@endpush