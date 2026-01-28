@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Categories</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_categories'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#A3B18A]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#A3B18A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Menus</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_menus'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#B08968]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#B08968]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Available Menus</p>
                    <p class="text-3xl font-bold text-[#A3B18A]">{{ $stats['available_menus'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#A3B18A]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#A3B18A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Out of Stock</p>
                    <p class="text-3xl font-bold text-red-500">{{ $stats['out_of_stock'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Orders</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#D4A373]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Today's Orders</p>
                    <p class="text-3xl font-bold text-[#B08968]">{{ $stats['today_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#B08968]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#B08968]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Menus -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#3A3A3A]">Recent Menus</h2>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-[#B08968] hover:text-[#D4A373] transition-colors">
                View All →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#A3B18A]/20">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Name</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Category</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Price</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Stock</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Status</th>
                        <th class="text-right py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMenus as $menu)
                        <tr class="border-b border-[#A3B18A]/10 hover:bg-[#F7F7F2] transition-colors">
                            <td class="py-3 px-4 text-[#3A3A3A]">{{ $menu->name }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-[#A3B18A]/20 text-[#A3B18A] rounded-full text-xs font-medium">
                                    {{ $menu->category->name }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-[#3A3A3A] font-semibold">${{ number_format($menu->price, 2) }}</td>
                            <td class="py-3 px-4 text-[#3A3A3A]">{{ $menu->stock }}</td>
                            <td class="py-3 px-4">
                                @if($menu->status === 'tersedia')
                                    <span class="px-2 py-1 bg-green-500/20 text-green-600 rounded-full text-xs font-medium">Available</span>
                                @else
                                    <span class="px-2 py-1 bg-red-500/20 text-red-600 rounded-full text-xs font-medium">Out of Stock</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-[#B08968] hover:text-[#D4A373] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#3A3A3A]/70">No menus found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection