<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#3A3A3A] text-[#F7F7F2] transform -translate-x-full transition-transform duration-300 ease-in-out md:static md:translate-x-0 md:transform-none" id="sidebar">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-6 border-b border-[#F7F7F2]/10">
            <div class="flex items-center space-x-3">
                @include('components.logo', ['class' => 'h-8 w-8'])
                <span class="text-lg font-bold font-serif">Admin Panel</span>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden text-[#F7F7F2]/70 hover:text-[#F7F7F2]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span class="font-medium">Categories</span>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.menus.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="font-medium">Menus</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H2v-2a4 4 0 014-4h7m0 6v-2a4 4 0 00-4-4H6m7-4a4 4 0 11-8 0 4 4 0 018 0zm8 2a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-medium">Users</span>
            </a>

            <a href="{{ route('admin.customers.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.customers.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                </svg>
                <span class="font-medium">Customers</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="font-medium">Orders</span>
            </a>

            <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.profile.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-medium">Profile</span>
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#A3B18A] text-white' : 'text-[#F7F7F2]/70 hover:bg-[#F7F7F2]/10 hover:text-[#F7F7F2]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.983 13.95a1.5 1.5 0 002.034 0l.122-.122a1.5 1.5 0 012.121 0l.122.122a1.5 1.5 0 002.034 0 1.5 1.5 0 000-2.034l-.122-.122a1.5 1.5 0 010-2.121l.122-.122a1.5 1.5 0 000-2.034 1.5 1.5 0 00-2.034 0l-.122.122a1.5 1.5 0 01-2.121 0l-.122-.122a1.5 1.5 0 00-2.034 0 1.5 1.5 0 000 2.034l.122.122a1.5 1.5 0 010 2.121l-.122.122a1.5 1.5 0 000 2.034z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
                <span class="font-medium">Settings</span>
            </a>
        </nav>
    </div>
</aside>

@push('scripts')
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        sidebar.classList.toggle('-translate-x-full');

        // Backdrop only for mobile
        if (backdrop) {
            backdrop.classList.toggle('hidden');
        }
    }
</script>
@endpush