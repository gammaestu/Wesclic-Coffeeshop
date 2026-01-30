@extends('layouts.app')

@section('title', 'Hubungi Kami')
@section('description', 'Hubungi Wesclic Coffee Shop')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Hubungi Kami</h1>
            <p class="text-xl text-white/90">Kami senang mendengar dari Anda</p>
        </div>
    </section>
    
    {{-- Contact Section --}}
    <section class="py-20 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Contact Form --}}
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold mb-6 text-[#3A3A3A] font-serif">Kirim Pesan</h2>
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Nama</label>
                            <input type="text" id="name" name="name" required 
                                   class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent"
                                   placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Email</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent"
                                   placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Nomor Telepon (Opsional)</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent"
                                   placeholder="62xxxxxxxxxxx">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-[#3A3A3A] mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="5" required 
                                      class="w-full px-4 py-3 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent"
                                      placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" 
                                class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
                
                {{-- Contact Info --}}
                <div class="space-y-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold mb-6 text-[#3A3A3A] font-serif">Hubungi Kami</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-[#A3B18A] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-[#3A3A3A] mb-1">Alamat</h3>
                                    <p class="text-[#3A3A3A]/70">{{ $settings->shop_address ?: '683W+6QR, Cobongan, Ngestiharjo, Kec. Kasihan, Kab. Bantul, DIY 55184' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-[#B08968] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-[#3A3A3A] mb-1">Telepon</h3>
                                    <p class="text-[#3A3A3A]/70">{{ $settings->shop_phone ?: '62xxxxxxxxxxx' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-[#D4A373] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-[#3A3A3A] mb-1">Email</h3>
                                    <p class="text-[#3A3A3A]/70">info@wescliccoffee.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Hours --}}
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold mb-6 text-[#3A3A3A] font-serif">Jam Operasional</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-[#A3B18A]/20">
                                <span class="font-semibold text-[#3A3A3A]">Senin - Jumat</span>
                                <span class="text-[#3A3A3A]/70">07:00 - 20:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#A3B18A]/20">
                                <span class="font-semibold text-[#3A3A3A]">Sabtu</span>
                                <span class="text-[#3A3A3A]/70">08:00 - 21:00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="font-semibold text-[#3A3A3A]">Minggu</span>
                                <span class="text-[#3A3A3A]/70">09:00 - 18:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Map Section (koordinat/place dari Settings agar akurat) --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-[#3A3A3A] font-serif mb-4">Lokasi Kami</h2>
            <p class="text-[#3A3A3A]/70 mb-4">{{ $settings->shop_address ?: '683W+6QR, Cobongan, Ngestiharjo, Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184' }}</p>
            <a href="{{ $settings->map_link_url }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2 mb-4 px-4 py-2 bg-[#A3B18A] hover:bg-[#8FA075] text-white rounded-lg font-semibold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Buka di Google Maps
            </a>
            <div class="rounded-xl shadow-lg overflow-hidden border border-[#A3B18A]/20">
                <iframe 
                    src="{{ $settings->map_embed_url }}" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi {{ $settings->shop_name }} - Peta">
                </iframe>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    @if(session('success'))
        // Show success message
        const notification = document.createElement('div');
        notification.className = 'fixed top-24 right-4 bg-[#A3B18A] text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    @endif
</script>
@endpush