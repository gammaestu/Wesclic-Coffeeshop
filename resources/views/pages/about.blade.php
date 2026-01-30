@extends('layouts.app')

@section('title', 'Tentang Kami')
@section('description', 'Pelajari tentang Wesclic Coffee Shop dan passion kami untuk kopi premium')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Cerita Kami</h1>
            <p class="text-xl text-white/90">Perjalanan passion, kualitas, dan komunitas</p>
        </div>
    </section>
    
    {{-- Story Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
                <h2 class="text-3xl font-bold mb-6 text-[#3A3A3A] font-serif">Selamat Datang di Wesclic Coffee</h2>
                <div class="prose prose-lg max-w-none text-[#3A3A3A]/80">
                    <p class="mb-4 text-lg leading-relaxed">
                        Didirikan dengan misi sederhana: membawa pengalaman kopi yang luar biasa ke komunitas kami. 
                        Apa yang dimulai sebagai mimpi kecil telah berkembang menjadi kedai kopi lokal yang dicintai di mana setiap cangkir 
                        dibuat dengan penuh perhatian dan setiap pelanggan diperlakukan seperti keluarga.
                    </p>
                    <p class="mb-4 text-lg leading-relaxed">
                        Kami mengambil biji kopi dari perkebunan berkelanjutan di seluruh dunia, memastikan tidak hanya kualitas terbaik 
                        tetapi juga mendukung praktik pertanian yang etis. Master roaster kami dengan hati-hati menyangrai 
                        setiap batch untuk mengeluarkan rasa dan aroma unik yang membuat kopi kami istimewa.
                    </p>
                    <p class="mb-4 text-lg leading-relaxed">
                        Selain kopi, kami bangga dengan pilihan pastry artisan kami, dipanggang segar setiap hari oleh 
                        pastry chef berbakat kami. Setiap item di menu kami dibuat dengan bahan terbaik dan 
                        penuh cinta.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Values Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#A3B18A] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Kualitas Utama</h3>
                    <p class="text-[#3A3A3A]/70">
                        Kami tidak pernah berkompromi pada kualitas. Setiap bahan dipilih dengan hati-hati, 
                        dan setiap produk dibuat hingga sempurna.
                    </p>
                </div>
                
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#B08968] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Komunitas</h3>
                    <p class="text-[#3A3A3A]/70">
                        Kami lebih dari sekadar kedai kopi—kami adalah tempat berkumpul untuk teman, 
                        keluarga, dan tetangga untuk terhubung dan menciptakan kenangan.
                    </p>
                </div>
                
                <div class="text-center p-8 bg-[#F7F7F2] rounded-xl">
                    <div class="w-20 h-20 bg-[#D4A373] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 002 2h2.945M3.055 11H1m2.055 0c.024.297.05.592.088.886A12 12 0 005.281 17.5c.46.474.971.9 1.528 1.27M3.055 11a12 12 0 0118.89 0M15 11a3 3 0 11-6 0 3 3 0 016 0zm-3 8a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#3A3A3A]">Keberlanjutan</h3>
                    <p class="text-[#3A3A3A]/70">
                        Kami berkomitmen pada praktik berkelanjutan, dari sumber biji kopi yang etis 
                        hingga menggunakan kemasan ramah lingkungan dan mengurangi limbah.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Team Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3A3A] font-serif">Kenali Tim Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $team = [
                        ['name' => 'Alpha Pratama Wijaya', 'role' => 'Head Barista', 'description' => 'Lebih dari 10 tahun pengalaman membuat cangkir yang sempurna'],
                        ['name' => 'Gamma Estu Mahardika', 'role' => 'Master Roaster', 'description' => 'Ahli dalam mengeluarkan rasa terbaik dari setiap biji kopi'],
                        ['name' => 'Beta Santoso Kusuma', 'role' => 'Pastry Chef', 'description' => 'Menciptakan hidangan lezat dengan passion dan kreativitas'],
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
            <h2 class="text-4xl font-bold mb-6 font-serif">Bergabung dengan Komunitas Kami</h2>
            <p class="text-xl mb-8 text-white/90">
                Kunjungi kami hari ini dan rasakan kehangatan, kualitas, dan komunitas yang membuat Wesclic Coffee istimewa.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('menu') }}" class="bg-white text-[#3A3A3A] hover:bg-[#F7F7F2] px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200">
                    Lihat Menu
                </a>
                <a href="{{ route('contact') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors duration-200 border-2 border-white/30">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection