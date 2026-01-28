@extends('layouts.app')

@section('title', 'About Us')
@section('description', 'Learn about Wesclic Coffee Shop and our passion for premium coffee')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Our Story</h1>
            <p class="text-xl text-white/90">A journey of passion, quality, and community</p>
        </div>
    </section>
    
    {{-- Story Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
                <h2 class="text-3xl font-bold mb-6 text-[#3A3A3A] font-serif">Welcome to Wesclic Coffee</h2>
                <div class="prose prose-lg max-w-none text-[#3A3A3A]/80">
                    <p class="mb-4 text-lg leading-relaxed">
                        Founded with a simple mission: to bring exceptional coffee experiences to our community. 
                        What started as a small dream has grown into a beloved local coffee shop where every cup 
                        is crafted with care and every customer is treated like family.
                    </p>
                    <p class="mb-4 text-lg leading-relaxed">
                        We source our beans from sustainable farms around the world, ensuring not only the finest 
                        quality but also supporting ethical farming practices. Our master roasters carefully roast 
                        each batch to bring out the unique flavors and aromas that make our coffee special.
                    </p>
                    <p class="mb-4 text-lg leading-relaxed">
                        Beyond coffee, we take pride in our selection of artisanal pastries, baked fresh daily by 
                        our talented pastry chefs. Every item on our menu is made with the finest ingredients and 
                        a whole lot of love.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Values Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#A3B18A] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Quality First</h3>
                    <p class="text-[#3A3A3A]/70">
                        We never compromise on quality. Every ingredient is carefully selected, 
                        and every product is crafted to perfection.
                    </p>
                </div>
                
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#B08968] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Community</h3>
                    <p class="text-[#3A3A3A]/70">
                        We're more than a coffee shop—we're a gathering place for friends, 
                        families, and neighbors to connect and create memories.
                    </p>
                </div>
                
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#D4A373] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 002 2h2.945M3.055 11H1m2.055 0c.024.297.05.592.088.886A12 12 0 005.281 17.5c.46.474.971.9 1.528 1.27M3.055 11a12 12 0 0118.89 0M15 11a3 3 0 11-6 0 3 3 0 016 0zm-3 8a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Sustainability</h3>
                    <p class="text-[#3A3A3A]/70">
                        We're committed to sustainable practices, from sourcing ethical beans 
                        to using eco-friendly packaging and reducing waste.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Team Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Meet Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $team = [
                        ['name' => 'Sarah Johnson', 'role' => 'Head Barista', 'description' => '10+ years of experience crafting the perfect cup'],
                        ['name' => 'Michael Chen', 'role' => 'Master Roaster', 'description' => 'Expert in bringing out the best flavors from every bean'],
                        ['name' => 'Emma Rodriguez', 'role' => 'Pastry Chef', 'description' => 'Creating delicious treats with passion and creativity'],
                    ];
                @endphp
                
                @foreach($team as $member)
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#A3B18A] to-[#B08968] rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-3xl font-bold text-white">{{ substr($member['name'], 0, 1) }}</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-[#3A3A3A]">{{ $member['name'] }}</h3>
                        <p class="text-[#B08968] font-semibold mb-3">{{ $member['role'] }}</p>
                        <p class="text-[#3A3A3A]/70">{{ $member['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6 font-serif">Join Our Community</h2>
            <p class="text-xl mb-8 text-white/90">
                Visit us today and experience the warmth, quality, and community that makes Wesclic Coffee special.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('menu') }}" class="bg-white text-[#3A3A3A] hover:bg-[#F7F7F2] px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200">
                    View Menu
                </a>
                <a href="{{ route('contact') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200 border-2 border-white/30">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection