@extends('layouts.app')

@section('title', 'Bayar Pesanan')
@section('description', 'Selesaikan pembayaran pesanan')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-2 font-serif">Bayar Pesanan</h1>
            <p class="text-white/90">Kode: <span class="font-mono font-bold">{{ $order->order_code }}</span> — Total Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>
    </section>

    <section class="py-16 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <p class="text-[#3A3A3A]/80 mb-6">Pilih metode pembayaran di bawah (transfer bank, QRIS, GoPay, dll.). Setelah bayar, status pesanan akan otomatis terupdate.</p>
                <button id="pay-button" type="button" class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Buka Halaman Pembayaran
                </button>
                <a href="{{ route('orders.show', $order->order_code) }}" class="mt-4 block text-center text-[#A3B18A] hover:underline font-medium">Kembali ke status pesanan</a>
            </div>
        </div>
    </section>

    <script src="{{ $snapScriptUrl }}" data-client-key="{{ $clientKey }}"></script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = '{{ route('payment.finish') }}?order_id={{ $order->order_code }}';
                },
                onPending: function (result) {
                    window.location.href = '{{ route('orders.show', $order->order_code) }}?pending=1';
                },
                onError: function (result) {
                    window.location.href = '{{ route('payment.error') }}?order_id={{ $order->order_code }}';
                },
                onClose: function () {
                    // User menutup popup tanpa bayar — tetap di halaman ini
                }
            });
        };
    </script>
@endsection
