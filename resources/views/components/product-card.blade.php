{{-- Product Card Component --}}
<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
    {{-- Product Image with Lazy Loading --}}
    <div class="relative h-64 bg-gradient-to-br from-[#A3B18A] to-[#B08968] overflow-hidden">
        @if(isset($image))
            <img 
                data-src="{{ $image }}" 
                src="{{ asset('images/logos/category-coffee.svg') }}" 
                alt="{{ $name }}" 
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                loading="lazy"
                decoding="async"
            >
        @else
            {{-- Placeholder with coffee icon --}}
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
        @endif
        @if(isset($badge))
            <div class="absolute top-4 right-4 bg-[#D4A373] text-white px-3 py-1 rounded-full text-sm font-semibold">
                {{ $badge }}
            </div>
        @endif
    </div>
    
    {{-- Product Info --}}
    <div class="p-6">
        <div class="flex justify-between items-start mb-2">
            <a href="{{ route('menu.show', $id ?? 0) }}" class="text-xl font-bold text-[#3A3A3A] font-serif hover:text-[#B08968] transition-colors">
                {{ $name }}
            </a>
            <span class="text-2xl font-bold text-[#B08968]">${{ number_format($price, 2) }}</span>
        </div>
        
        @if(isset($description))
            <p class="text-[#3A3A3A]/70 mb-4 line-clamp-2">{{ $description }}</p>
        @endif
        
        @if(isset($category))
            <div class="mb-4">
                <span class="inline-block px-3 py-1 bg-[#A3B18A]/20 text-[#A3B18A] rounded-full text-sm font-medium">
                    {{ $category }}
                </span>
            </div>
        @endif
        
        {{-- Add to Cart Button --}}
        <button onclick="addToCartHandler({{ json_encode(['id' => $id ?? uniqid(), 'name' => $name, 'price' => (float)$price, 'image' => $image ?? null]) }})" 
                class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span>Add to Cart</span>
        </button>
    </div>
</div>