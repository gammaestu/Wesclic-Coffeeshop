@extends('layouts.app')

@section('title', 'Gallery')
@section('description', 'Coffee gallery')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Gallery</h1>
            <p class="text-xl text-white/90">Coffee moments & our favorites.</p>
        </div>
    </section>

    <section class="py-20 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($images as $src)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="h-40 bg-gradient-to-br from-[#A3B18A] to-[#B08968] flex items-center justify-center">
                            <img src="{{ $src }}" alt="Gallery item" class="w-24 h-24 object-contain">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

