@extends('admin.layouts.app')

@section('title', 'Profile')
@section('page-title', 'Profile')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl">
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
            </div>

            <div class="border-t border-[#A3B18A]/20 pt-6">
                <h3 class="text-lg font-bold text-[#3A3A3A] mb-4">Change Password</h3>

                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Current Password</label>
                    <input type="password" name="current_password" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">New Password</label>
                    <input type="password" name="new_password" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection

