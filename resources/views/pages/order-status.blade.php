@extends('layouts.app')

@section('title', 'Status Pesanan')
@section('description', 'Lacak status pesanan Anda')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Status Pesanan</h1>
            <p class="text-xl text-white/90">Kode pesanan: <span class="font-bold">{{ $order->order_code }}</span></p>
        </div>
    </section>

    <section class="py-16 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 stagger-children">
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl">{{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-xl">{{ session('info') }}</div>
            @endif
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="text-sm text-[#3A3A3A]/60">Pelanggan</div>
                        <div class="text-xl font-bold text-[#3A3A3A]">{{ $order->customer?->name ?? '-' }}</div>
                        <div class="text-[#3A3A3A]/70">{{ $order->customer?->phone ?? '' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-[#3A3A3A]/60">Status</div>
                        <div class="text-2xl font-bold text-[#B08968]">{{ strtoupper($order->status) }}</div>
                        <div class="text-sm text-[#3A3A3A]/60">Pembayaran: {{ $order->payment_status === 'paid' ? 'Lunas' : 'Belum bayar' }} ({{ $order->payment_method === 'transfer' ? 'Transfer/Online' : ($order->payment_method === 'cash' ? 'Bayar di tempat' : '–') }})</div>
                    </div>
                </div>
            </div>

            @if($order->payment_status === 'unpaid' && $order->payment_method === 'transfer')
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <p class="text-amber-800 font-medium mb-2">Pesanan ini belum dibayar (Transfer/QRIS/E-wallet).</p>
                    <a href="{{ route('orders.pay', $order->order_code) }}" class="inline-flex items-center gap-2 bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Bayar Sekarang
                    </a>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-4">Item Pesanan</h2>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                            <div>
                                <div class="font-semibold text-[#3A3A3A]">{{ $item->menu?->name ?? 'Item menu' }}</div>
                                <div class="text-sm text-[#3A3A3A]/70">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="font-bold text-[#B08968]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-[#A3B18A]/20 pt-4 mt-4 flex items-center justify-between">
                    <span class="text-lg font-semibold text-[#3A3A3A]">Total</span>
                    <span class="text-2xl font-bold text-[#B08968]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-4">Riwayat Status</h2>
                <div class="space-y-3">
                    @forelse($order->statusLogs->sortBy('created_at') as $log)
                        <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                            <div class="font-semibold text-[#3A3A3A]">{{ strtoupper($log->status) }}</div>
                            <div class="text-sm text-[#3A3A3A]/70">{{ $log->created_at->format('d-m-Y H:i') }}</div>
                        </div>
                    @empty
                        <div class="text-[#3A3A3A]/70">Belum ada riwayat status.</div>
                    @endforelse
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('orders.status') }}" class="flex-1 text-center bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold py-3 px-6 rounded-lg transition-all duration-300 hover:scale-[1.02]">
                    Lacak Pesanan Lain
                </a>
                <a href="{{ route('menu') }}" class="flex-1 text-center bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 hover:scale-[1.02]">
                    Pesan Lagi
                </a>
            </div>
        </div>
    </section>
@endsection

