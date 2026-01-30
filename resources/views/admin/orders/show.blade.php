@extends('admin.layouts.app')

@section('title', 'Order Detail')
@section('page-title', 'Order Detail')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="text-sm text-[#3A3A3A]/70">Order Code</div>
                    <div class="text-2xl font-bold text-[#3A3A3A]">{{ $order->order_code }}</div>
                    <div class="text-[#3A3A3A]/70">{{ $order->created_at->format('Y-m-d H:i') }}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-[#3A3A3A]/70">Total</div>
                    <div class="text-2xl font-bold text-[#B08968]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#3A3A3A] mb-4">Customer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-[#3A3A3A]/80">
                <div><span class="font-semibold">Name:</span> {{ $order->customer?->name ?? '-' }}</div>
                <div><span class="font-semibold">Phone:</span> {{ $order->customer?->phone ?? '-' }}</div>
                <div><span class="font-semibold">Email:</span> {{ $order->customer?->email ?? '-' }}</div>
                <div><span class="font-semibold">Type:</span> {{ $order->customer?->type ?? '-' }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#3A3A3A] mb-4">Items</h2>
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                        <div>
                            <div class="font-semibold text-[#3A3A3A]">{{ $item->menu?->name ?? 'Menu item' }}</div>
                            <div class="text-sm text-[#3A3A3A]/70">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="font-bold text-[#B08968]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#3A3A3A] mb-4">Update Status</h2>
            <form method="POST" action="{{ route('admin.orders.status.update', $order) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                        @foreach(['pending','diproses','selesai','dibatalkan'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Payment Status</label>
                    <select name="payment_status" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                        @foreach(['unpaid','paid','failed','refunded'] as $ps)
                            <option value="{{ $ps }}" {{ $order->payment_status === $ps ? 'selected' : '' }}>{{ $ps }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                    Save
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#3A3A3A] mb-4">Status Logs</h2>
            <div class="space-y-3">
                @forelse($order->statusLogs->sortByDesc('created_at') as $log)
                    <div class="flex items-center justify-between p-4 border border-[#A3B18A]/20 rounded-lg">
                        <div class="font-semibold text-[#3A3A3A]">{{ strtoupper($log->status) }}</div>
                        <div class="text-sm text-[#3A3A3A]/70">{{ $log->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                @empty
                    <div class="text-[#3A3A3A]/70">No logs.</div>
                @endforelse
            </div>
        </div>

        <div>
            <a href="{{ route('admin.orders.index') }}" class="inline-block bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] px-5 py-2 rounded-lg font-semibold transition-colors">
                Back
            </a>
        </div>
    </div>
@endsection

