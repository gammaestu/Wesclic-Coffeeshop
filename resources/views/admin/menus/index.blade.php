@extends('admin.layouts.app')

@section('title', 'Menus')
@section('page-title', 'Menus')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
            <h2 class="text-xl font-bold text-[#3A3A3A]">All Menus</h2>
            <div class="flex items-center space-x-4">
                <!-- Filters -->
                <form method="GET" action="{{ route('admin.menus.index') }}" class="flex items-center space-x-2">
                    <select name="category" class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="status" class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm">
                        <option value="">All Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Available</option>
                        <option value="habis" {{ request('status') === 'habis' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search..." 
                        class="px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] text-sm"
                    >
                    <button type="submit" class="bg-[#B08968] hover:bg-[#D4A373] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Filter
                    </button>
                    @if(request()->hasAny(['category', 'status', 'search']))
                        <a href="{{ route('admin.menus.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
                <a href="{{ route('admin.menus.create') }}" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-4 py-2 rounded-lg font-semibold transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Menu</span>
                </a>
            </div>
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
                    @forelse($menus as $menu)
                        <tr class="border-b border-[#A3B18A]/10 hover:bg-[#F7F7F2] transition-colors">
                            <td class="py-3 px-4 text-[#3A3A3A] font-medium">{{ $menu->name }}</td>
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
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="text-[#B08968] hover:text-[#D4A373] transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
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

        <!-- Pagination -->
        @if($menus->hasPages())
            <div class="mt-6">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection