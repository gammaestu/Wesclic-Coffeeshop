@extends('layouts.app')

@section('title', 'Keranjang Belanja')
@section('description', 'Tinjau pesanan Anda dan lanjutkan ke checkout')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Keranjang Belanja</h1>
            <p class="text-xl text-white/90">Tinjau pesanan Anda</p>
        </div>
    </section>
    
    {{-- Cart Section --}}
    <section class="py-20 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="cart-container" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2">
                    <div id="cart-items" class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-6 text-[#3A3A3A] font-serif">Item Anda</h2>
                        <div id="cart-items-list" class="space-y-4">
                            {{-- Items will be dynamically inserted here --}}
                        </div>
                        <div id="empty-cart" class="text-center py-12 hidden">
                            <svg class="w-24 h-24 text-[#A3B18A]/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-xl text-[#3A3A3A]/70 mb-4">Keranjang Anda kosong</p>
                            <a href="{{ route('menu') }}" class="inline-block bg-[#A3B18A] hover:bg-[#8FA075] text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                Jelajahi Menu
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h2 class="text-2xl font-bold mb-6 text-[#3A3A3A] font-serif">Ringkasan Pesanan</h2>
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-[#3A3A3A]">
                                <span>Subtotal</span>
                                <span id="subtotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-[#3A3A3A]">
                                <span>Pajak (10%)</span>
                                <span id="tax">Rp 0</span>
                            </div>
                            <div class="border-t border-[#A3B18A]/20 pt-4">
                                <div class="flex justify-between text-xl font-bold text-[#3A3A3A]">
                                    <span>Total</span>
                                    <span id="total">Rp 0</span>
                                </div>
                            </div>
                        </div>
                        <button id="checkout-btn" 
                                class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            Lanjut ke Checkout
                        </button>
                        <a href="{{ route('menu') }}" class="block text-center mt-4 text-[#B08968] hover:text-[#D4A373] transition-colors">
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Wait until Vite module (`resources/js/app.js`) attaches `window.cartManager`
    function whenCartManagerReady(cb, tries = 100) {
        if (window.cartManager) return cb();
        if (tries <= 0) {
            console.error('cartManager not available. Ensure Vite assets are loaded.');
            return;
        }
        setTimeout(() => whenCartManagerReady(cb, tries - 1), 50);
    }

    function renderCart() {
        const cart = window.cartManager.getCart();
        const cartItemsList = document.getElementById('cart-items-list');
        const emptyCart = document.getElementById('empty-cart');
        const checkoutBtn = document.getElementById('checkout-btn');
        
        if (cart.length === 0) {
            cartItemsList.innerHTML = '';
            emptyCart.classList.remove('hidden');
            checkoutBtn.disabled = true;
            updateTotals();
            return;
        }
        
        emptyCart.classList.add('hidden');
        checkoutBtn.disabled = false;
        
        cartItemsList.innerHTML = cart.map((item, index) => `
            <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                <div class="flex items-center space-x-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#A3B18A] to-[#B08968] rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden relative">
                        ${item.image ? `
                            <img src="${item.image.startsWith('http') || item.image.startsWith('/') ? item.image : '/' + item.image}" 
                                 alt="${item.name}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.placeholder-icon').style.display='flex';">
                            <div class="placeholder-icon absolute inset-0 w-full h-full items-center justify-center hidden">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                        ` : `
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        `}
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-[#3A3A3A]">${item.name}</h3>
                        <p class="text-sm text-[#3A3A3A]/70">Rp ${Math.round(item.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} / item</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <button onclick="updateQuantity(${index}, -1)" class="w-8 h-8 bg-[#F7F7F2] hover:bg-[#A3B18A] hover:text-white rounded-lg transition-colors">-</button>
                        <span class="w-12 text-center font-semibold text-[#3A3A3A]">${item.quantity || 1}</span>
                        <button onclick="updateQuantity(${index}, 1)" class="w-8 h-8 bg-[#F7F7F2] hover:bg-[#A3B18A] hover:text-white rounded-lg transition-colors">+</button>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-[#B08968]">Rp ${Math.round((item.quantity || 1) * item.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</p>
                    </div>
                    <button onclick="removeItem(${index})" class="ml-4 text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');
        
        updateTotals();
    }
    
    function updateQuantity(index, change) {
        const cart = window.cartManager.getCart();
        if (!cart[index].quantity) cart[index].quantity = 1;
        cart[index].quantity += change;
        
        if (cart[index].quantity < 1) {
            window.cartManager.removeItem(cart[index].id);
        } else {
            window.cartManager.updateQuantity(cart[index].id, cart[index].quantity);
        }
        
        renderCart();
    }
    
    function removeItem(index) {
        const cart = window.cartManager.getCart();
        window.cartManager.removeItem(cart[index].id);
        renderCart();
    }
    
    function updateTotals() {
        const cart = window.cartManager.getCart();
        const subtotal = cart.reduce((sum, item) => sum + (item.price * (item.quantity || 1)), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        function formatRupiah(n) {
            return 'Rp ' + Math.round(Number(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        document.getElementById('subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('tax').textContent = formatRupiah(tax);
        document.getElementById('total').textContent = formatRupiah(total);
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
        whenCartManagerReady(renderCart);
    });
    
    // Checkout handler
    document.getElementById('checkout-btn')?.addEventListener('click', function() {
        window.location.href = "{{ route('payment') }}";
    });
</script>
@endpush