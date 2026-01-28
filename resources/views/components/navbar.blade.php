<nav class="bg-[#F7F7F2] border-b border-[#A3B18A]/20 sticky top-0 z-50 backdrop-blur-sm bg-opacity-95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    @include('components.logo', ['class' => 'h-10 w-10 group-hover:scale-110 transition-transform duration-300'])
                    <span class="text-2xl font-bold text-[#3A3A3A] font-serif">Wesclic Coffee</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-[#3A3A3A] hover:text-[#B08968] transition-colors duration-200 font-medium {{ request()->routeIs('home') ? 'text-[#B08968] border-b-2 border-[#B08968]' : '' }}">
                    Home
                </a>
                <a href="{{ route('menu') }}" class="text-[#3A3A3A] hover:text-[#B08968] transition-colors duration-200 font-medium {{ request()->routeIs('menu') ? 'text-[#B08968] border-b-2 border-[#B08968]' : '' }}">
                    Menu
                </a>
                <a href="{{ route('about') }}" class="text-[#3A3A3A] hover:text-[#B08968] transition-colors duration-200 font-medium {{ request()->routeIs('about') ? 'text-[#B08968] border-b-2 border-[#B08968]' : '' }}">
                    About
                </a>
                <a href="{{ route('contact') }}" class="text-[#3A3A3A] hover:text-[#B08968] transition-colors duration-200 font-medium {{ request()->routeIs('contact') ? 'text-[#B08968] border-b-2 border-[#B08968]' : '' }}">
                    Contact
                </a>
                <a href="{{ route('gallery') }}" class="text-[#3A3A3A] hover:text-[#B08968] transition-colors duration-200 font-medium {{ request()->routeIs('gallery') ? 'text-[#B08968] border-b-2 border-[#B08968]' : '' }}">
                    Gallery
                </a>
                <a href="{{ route('cart') }}" class="relative inline-flex items-center px-4 py-2 bg-[#A3B18A] text-white rounded-lg hover:bg-[#8FA075] transition-colors duration-200 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Cart
                    <span class="ml-2 bg-[#D4A373] text-white text-xs font-bold rounded-full px-2 py-0.5" id="cart-count">0</span>
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-[#3A3A3A] hover:text-[#B08968] focus:outline-none focus:text-[#B08968] transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#F7F7F2] border-t border-[#A3B18A]/20">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-[#3A3A3A] hover:bg-[#A3B18A]/10 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-[#A3B18A]/20 text-[#B08968]' : '' }}">
                Home
            </a>
            <a href="{{ route('menu') }}" class="block px-3 py-2 text-[#3A3A3A] hover:bg-[#A3B18A]/10 rounded-lg transition-colors {{ request()->routeIs('menu') ? 'bg-[#A3B18A]/20 text-[#B08968]' : '' }}">
                Menu
            </a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-[#3A3A3A] hover:bg-[#A3B18A]/10 rounded-lg transition-colors {{ request()->routeIs('about') ? 'bg-[#A3B18A]/20 text-[#B08968]' : '' }}">
                About
            </a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-[#3A3A3A] hover:bg-[#A3B18A]/10 rounded-lg transition-colors {{ request()->routeIs('contact') ? 'bg-[#A3B18A]/20 text-[#B08968]' : '' }}">
                Contact
            </a>
            <a href="{{ route('gallery') }}" class="block px-3 py-2 text-[#3A3A3A] hover:bg-[#A3B18A]/10 rounded-lg transition-colors {{ request()->routeIs('gallery') ? 'bg-[#A3B18A]/20 text-[#B08968]' : '' }}">
                Gallery
            </a>
            <a href="{{ route('cart') }}" class="block px-3 py-2 bg-[#A3B18A] text-white rounded-lg hover:bg-[#8FA075] transition-colors font-medium">
                Cart
            </a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush