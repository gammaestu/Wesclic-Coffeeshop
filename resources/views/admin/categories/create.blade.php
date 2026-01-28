@extends('admin.layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Name <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required 
                    class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Category name"
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
                    placeholder="Category description"
                >{{ old('description') }}</textarea>
                @error('description')
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
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Active</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Inactive</option>
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
                    Create Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] font-semibold px-6 py-3 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection