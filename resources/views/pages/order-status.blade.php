@extends('layouts.app')

@section('title', 'Order Status')
@section('description', 'Track your order status')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Order Status</h1>
            <p class="text-xl text-white/90">Order code: <span class="font-bold">{{ $order->order_code }}</span></p>
        </div>
    </section>

    <section class="py-16 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="text-sm text-[#3A3A3A]/60">Customer</div>
                        <div class="text-xl font-bold text-[#3A3A3A]">{{ $order->customer?->name ?? '-' }}</div>
                        <div class="text-[#3A3A3A]/70">{{ $order->customer?->phone ?? '' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-[#3A3A3A]/60">Status</div>
                        <div class="text-2xl font-bold text-[#B08968]">{{ strtoupper($order->status) }}</div>
                        <div class="text-sm text-[#3A3A3A]/60">Payment: {{ strtoupper($order->payment_status) }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-4">Items</h2>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                            <div>
                                <div class="font-semibold text-[#3A3A3A]">{{ $item->menu?->name ?? 'Menu item' }}</div>
                                <div class="text-sm text-[#3A3A3A]/70">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</div>
                            </div>
                            <div class="font-bold text-[#B08968]">${{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-[#A3B18A]/20 pt-4 mt-4 flex items-center justify-between">
                    <span class="text-lg font-semibold text-[#3A3A3A]">Total</span>
                    <span class="text-2xl font-bold text-[#B08968]">${{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-4">Timeline</h2>
                <div class="space-y-3">
                    @forelse($order->statusLogs->sortBy('created_at') as $log)
                        <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                            <div class="font-semibold text-[#3A3A3A]">{{ strtoupper($log->status) }}</div>
                            <div class="text-sm text-[#3A3A3A]/70">{{ $log->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                    @empty
                        <div class="text-[#3A3A3A]/70">No status logs yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('orders.status') }}" class="flex-1 text-center bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold py-3 px-6 rounded-lg transition-colors">
                    Track Another Order
                </a>
                <a href="{{ route('menu') }}" class="flex-1 text-center bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Order More
                </a>
            </div>
        </div>
    </section>
@endsection

