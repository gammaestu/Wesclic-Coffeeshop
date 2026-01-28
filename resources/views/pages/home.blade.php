@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Welcome to Wesclic Coffee Shop - Premium coffee and artisanal pastries')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-[#A3B18A] via-[#B08968] to-[#D4A373] text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 font-serif leading-tight">
                        Welcome to<br>
                        <span class="text-[#F7F7F2]">Wesclic Coffee</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                        Experience the perfect blend of tradition and innovation. 
                        Every cup tells a story, every sip is a journey.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('menu') }}" class="bg-[#3A3A3A] hover:bg-[#2A2A2A] text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200 text-center">
                            View Menu
                        </a>
                        <a href="{{ route('about') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200 text-center border-2 border-white/30">
                            Our Story
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    @include('components.logo', ['class' => 'w-64 h-64 mx-auto animate-pulse'])
                </div>
            </div>
        </div>
    </section>
    
    {{-- Features Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-[#A3B18A] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-[#3A3A3A]">Premium Quality</h3>
                    <p class="text-[#3A3A3A]/70">Sourced from the finest coffee beans around the world, roasted to perfection.</p>
                </div>
                
                <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-[#B08968] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-[#3A3A3A]">Fresh Daily</h3>
                    <p class="text-[#3A3A3A]/70">Our pastries and coffee are prepared fresh every morning for the best taste.</p>
                </div>
                
                <div class="text-center p-8 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-[#D4A373] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-[#3A3A3A]">Made with Love</h3>
                    <p class="text-[#3A3A3A]/70">Every item is crafted with passion and attention to detail.</p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Popular Items Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Popular Items</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($popularItems as $item)
                    @include('components.product-card', [
                        'id' => $item->id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'description' => $item->description,
                        'category' => $item->category->name,
                        'image' => $item->image ? asset($item->image) : null,
                        'badge' => $loop->first ? 'Popular' : null,
                    ])
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-[#3A3A3A]/70">No items available at the moment.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('menu') }}" class="inline-block bg-[#A3B18A] hover:bg-[#8FA075] text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-200">
                    View Full Menu
                </a>
            </div>
        </div>
    </section>
    
    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6 font-serif">Visit Us Today</h2>
            <p class="text-xl mb-8 text-white/90">
                Come experience the warmth and aroma of freshly brewed coffee in our cozy atmosphere.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-[#3A3A3A] hover:bg-[#F7F7F2] px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200">
                Get Directions
            </a>
        </div>
    </section>
@endsection