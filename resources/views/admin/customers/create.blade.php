@extends('admin.layouts.app')

@section('title', 'Create Customer')
@section('page-title', 'Create Customer')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl">
        <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Phone (optional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Email (optional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Address (optional)</label>
                <textarea name="address" rows="3" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">{{ old('address') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Type</label>
                <select name="type" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                    <option value="walk-in" {{ old('type', 'walk-in') === 'walk-in' ? 'selected' : '' }}>Walk-in</option>
                    <option value="member" {{ old('type') === 'member' ? 'selected' : '' }}>Member</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.customers.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] px-5 py-2 rounded-lg font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection

