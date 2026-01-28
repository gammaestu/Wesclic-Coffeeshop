@extends('layouts.app')

@section('title', 'Track Order')
@section('description', 'Track your order by code')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Track Order</h1>
            <p class="text-xl text-white/90">Enter your order code to see status.</p>
        </div>
    </section>

    <section class="py-20 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                @if(!empty($error))
                    <div class="mb-4 bg-red-500 text-white px-4 py-3 rounded-lg">
                        {{ $error }}
                    </div>
                @endif

                @if(!empty($lastOrderCode))
                    <div class="mb-6 p-4 rounded-lg bg-[#A3B18A]/10 border border-[#A3B18A]/20">
                        <div class="text-sm text-[#3A3A3A]/70">Last order code</div>
                        <div class="text-lg font-bold text-[#3A3A3A]">{{ $lastOrderCode }}</div>
                        <a href="{{ route('orders.show', ['order' => $lastOrderCode]) }}" class="inline-block mt-2 text-[#B08968] hover:text-[#D4A373] font-semibold">
                            View last order →
                        </a>
                    </div>
                @endif

                <form method="GET" action="{{ route('orders.status') }}" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Order Code</label>
                        <input name="order_code" placeholder="e.g. ORD202601280001" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                    </div>
                    <button type="submit" class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        Check Status
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

