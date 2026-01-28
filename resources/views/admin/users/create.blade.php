@extends('admin.layouts.app')

@section('title', 'Create User')
@section('page-title', 'Create User')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                <p class="text-xs text-[#3A3A3A]/60 mt-1">Min 6 characters.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Role</label>
                    <select name="role" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                        <option value="kasir" {{ old('role', 'kasir') === 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="owner" {{ old('role') === 'owner' ? 'selected' : '' }}>Owner</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Active</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Phone (optional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]">
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.users.index') }}" class="bg-[#F7F7F2] hover:bg-[#A3B18A]/10 text-[#3A3A3A] px-5 py-2 rounded-lg font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-[#A3B18A] hover:bg-[#8FA075] text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection

