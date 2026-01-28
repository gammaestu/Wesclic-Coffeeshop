@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="category_id" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Category <span class="text-red-500">*</span></label>
                <select 
                    id="category_id" 
                    name="category_id" 
                    required
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('category_id') border-red-500 @enderror"
                >
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Name <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $menu->name) }}"
                    required 
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Menu name"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('description') border-red-500 @enderror"
                    placeholder="Menu description"
                >{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Price <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-[#3A3A3A]/70">$</span>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            value="{{ old('price', $menu->price) }}"
                            step="0.01"
                            min="0"
                            required 
                            class="w-full pl-8 pr-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('price') border-red-500 @enderror"
                            placeholder="0.00"
                        >
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Stock <span class="text-red-500">*</span></label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        value="{{ old('stock', $menu->stock) }}"
                        min="0"
                        required 
                        class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('stock') border-red-500 @enderror"
                        placeholder="0"
                    >
                    @error('stock')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Image Path</label>
                <input 
                    type="text" 
                    id="image" 
                    name="image" 
                    value="{{ old('image', $menu->image) }}"
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('image') border-red-500 @enderror"
                    placeholder="images/logos/menu-espresso.svg"
                >
                <p class="mt-1 text-xs text-[#3A3A3A]/70">Path to image file (e.g., images/logos/menu-espresso.svg)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Status <span class="text-red-500">*</span></label>
                <select 
                    id="status" 
                    name="status" 
                    required
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('status') border-red-500 @enderror"
                >
                    <option value="tersedia" {{ old('status', $menu->status) === 'tersedia' ? 'selected' : '' }}>Available</option>
                    <option value="habis" {{ old('status', $menu->status) === 'habis' ? 'selected' : '' }}>Out of Stock</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button 
                    type="submit" 
                    class="bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold px-6 py-3 rounded-lg transition-colors"
                >
                    Update Menu
                </button>
                <a href="{{ route('admin.menus.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold px-6 py-3 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection