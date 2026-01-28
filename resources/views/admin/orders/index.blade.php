@extends('admin.layouts.app')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
            <h2 class="text-xl font-bold text-[#3A3A3A]">All Orders</h2>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.exports.orders.excel') }}" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                    Export Excel
                </a>
                <a href="{{ route('admin.exports.orders.pdf') }}" class="bg-[#B08968] hover:bg-[#D4A373] text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                    Export PDF
                </a>
            </div>
            <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-2">
                <select name="status" class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <select name="payment_status" class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm">
                    <option value="">All Payment</option>
                    <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Order code / customer..." class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm">
                <button type="submit" class="bg-[#B08968] hover:bg-[#D4A373] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['status', 'payment_status', 'search']))
                    <a href="{{ route('admin.orders.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#A3B18A]/20">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Order Code</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Customer</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Total</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Payment</th>
                        <th class="text-right py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b border-[#A3B18A]/10 hover:bg-[#F7F7F2] transition-colors">
                            <td class="py-3 px-4 text-[#3A3A3A] font-medium">{{ $order->order_code }}</td>
                            <td class="py-3 px-4 text-[#3A3A3A]/80">{{ $order->customer?->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-[#3A3A3A] font-semibold">${{ number_format($order->total_price, 2) }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-[#A3B18A]/20 text-[#A3B18A] rounded-full text-xs font-medium">{{ $order->status }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-[#B08968]/20 text-[#B08968] rounded-full text-xs font-medium">{{ $order->payment_status }}</span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-[#B08968] hover:text-[#D4A373] transition-colors font-semibold">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#3A3A3A]/70">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection

