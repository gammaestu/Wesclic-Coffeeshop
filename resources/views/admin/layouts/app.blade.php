<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Panel') - Wesclic Coffee Shop</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-[#F7F7F2] text-[#3A3A3A] antialiased">
    <div class="min-h-screen md:flex">
        <!-- Sidebar -->
        @include('admin.components.sidebar')

        <!-- Mobile backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 z-40 bg-black/40 hidden md:hidden" onclick="toggleSidebar()"></div>
        
        <!-- Main Content -->
        <div class="flex-1 min-w-0">
            <!-- Top Navigation -->
            @include('admin.components.navbar')
            
            <!-- Page Content -->
            <main class="p-6 w-full">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-4 bg-[#A3B18A] text-white px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-white hover:text-[#F7F7F2]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-500 text-white px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-white hover:text-red-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-500 text-white px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>