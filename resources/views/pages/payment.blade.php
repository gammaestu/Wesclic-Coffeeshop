@extends('layouts.app')

@section('title', 'Pembayaran')
@section('description', 'Selesaikan pembayaran Anda')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Checkout</h1>
            <p class="text-xl text-white/90">Isi data pemesan dan pilih metode pembayaran</p>
        </div>
    </section>

    <section class="py-20 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-2">Checkout</h2>
                <p class="text-[#3A3A3A]/70 mb-6">Fill customer info, then “Place Order”. Payment can be added later.</p>

                <div id="payment-cart" class="space-y-3 mb-6">
                    {{-- Filled from localStorage cart --}}
                </div>

                <div class="border-t border-[#A3B18A]/20 pt-4 flex items-center justify-between">
                    <span class="text-lg font-semibold text-[#3A3A3A]">Total</span>
                    <span id="payment-total" class="text-2xl font-bold text-[#B08968]">Rp 0</span>
                </div>

                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    <input type="hidden" name="items" id="checkout-items">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Nama</label>
                            <input name="customer_name" value="{{ old('customer_name') }}" required class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Nomor Telepon</label>
                            <input name="customer_phone" value="{{ old('customer_phone') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" placeholder="62xxxxxxxxxxx">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Email</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Tipe Pelanggan</label>
                            <select name="customer_type" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                                <option value="walk-in" {{ old('customer_type', 'walk-in') === 'walk-in' ? 'selected' : '' }}>Walk-in</option>
                                <option value="member" {{ old('customer_type') === 'member' ? 'selected' : '' }}>Member</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Metode Pembayaran</label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 border border-[#A3B18A]/30 rounded-lg cursor-pointer hover:bg-[#A3B18A]/5 transition-colors">
                                <input type="radio" name="payment_method" value="cash" {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }} class="text-[#A3B18A] focus:ring-[#A3B18A]">
                                <span class="font-medium text-[#3A3A3A]">Bayar di tempat (tunai)</span>
                                <span class="text-sm text-[#3A3A3A]/60">— Bayar saat order siap / di kasir</span>
                            </label>
                            @if($canUseTransfer ?? false)
                                <label class="flex items-center gap-3 p-4 border border-[#A3B18A]/30 rounded-lg cursor-pointer hover:bg-[#A3B18A]/5 transition-colors">
                                    <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }} class="text-[#A3B18A] focus:ring-[#A3B18A]">
                                    <span class="font-medium text-[#3A3A3A]">Transfer / QRIS / E-wallet</span>
                                    <span class="text-sm text-[#3A3A3A]/60">— Bayar online via Midtrans (transfer bank, QRIS, GoPay, dll.)</span>
                                </label>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Alamat (opsional)</label>
                        <textarea name="customer_address" rows="2" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" placeholder="Alamat lengkap">{{ old('customer_address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-1">Catatan (opsional)</label>
                        <textarea name="notes" rows="2" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" placeholder="Catatan khusus untuk pesanan">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button id="place-order-btn" type="submit"
                                class="flex-1 bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            Pesan Sekarang
                        </button>
                        <a href="{{ route('cart') }}"
                           class="flex-1 text-center bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                            Kembali ke Keranjang
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function whenCartManagerReady(cb, tries = 100) {
        if (window.cartManager) return cb();
        if (tries <= 0) return;
        setTimeout(() => whenCartManagerReady(cb, tries - 1), 50);
    }

    function renderPaymentSummary() {
        const cart = window.cartManager.getCart();
        const container = document.getElementById('payment-cart');
        const totalEl = document.getElementById('payment-total');
        const checkoutItems = document.getElementById('checkout-items');
        const placeOrderBtn = document.getElementById('place-order-btn');

        if (!container || !totalEl) return;

        if (!cart.length) {
            container.innerHTML = `<p class="text-[#3A3A3A]/70">Keranjang Anda kosong. Silakan tambahkan item terlebih dahulu.</p>`;
            totalEl.textContent = 'Rp 0';
            if (placeOrderBtn) placeOrderBtn.disabled = true;
            return;
        }
        if (placeOrderBtn) placeOrderBtn.disabled = false;

        function formatRupiah(n) {
            return 'Rp ' + Math.round(Number(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        container.innerHTML = cart.map(item => {
            const qty = item.quantity || 1;
            const price = Number(item.price);
            const subtotal = qty * price;
            return `
            <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                <div>
                    <div class="font-semibold text-[#3A3A3A]">${item.name}</div>
                    <div class="text-sm text-[#3A3A3A]/70">${qty} x ${formatRupiah(price)}</div>
                </div>
                <div class="font-bold text-[#B08968]">${formatRupiah(subtotal)}</div>
            </div>
        `;
        }).join('');

        if (checkoutItems) {
            // Send minimal payload to server
            const payload = cart.map(i => ({ id: Number(i.id), quantity: Number(i.quantity || 1) }));
            checkoutItems.value = JSON.stringify(payload);
        }

        const subtotal = cart.reduce((sum, item) => sum + (Number(item.price) * (item.quantity || 1)), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        totalEl.textContent = 'Rp ' + Math.round(total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    document.addEventListener('DOMContentLoaded', function () {
        whenCartManagerReady(renderPaymentSummary);
    });

    // Convert items JSON string to array for Laravel validation
    document.getElementById('checkout-form')?.addEventListener('submit', function (e) {
        const input = document.getElementById('checkout-items');
        if (!input) return;
        // If already converted to array fields by browser, skip.
        try {
            const items = JSON.parse(input.value || '[]');
            // Replace hidden input with multiple inputs items[i][id], items[i][quantity]
            input.remove();
            items.forEach((row, idx) => {
                const idEl = document.createElement('input');
                idEl.type = 'hidden';
                idEl.name = `items[${idx}][id]`;
                idEl.value = String(row.id);
                e.target.appendChild(idEl);

                const qtyEl = document.createElement('input');
                qtyEl.type = 'hidden';
                qtyEl.name = `items[${idx}][quantity]`;
                qtyEl.value = String(row.quantity);
                e.target.appendChild(qtyEl);
            });
            // Clear cart after submit (optimistic). If request fails, user can go back and re-submit.
            window.cartManager?.clearCart();
        } catch (err) {
            // If parse fails, allow server to reject.
        }
    });
</script>
@endpush

