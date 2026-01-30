@extends('layouts.app')

@section('title', 'Gallery')
@section('description', 'Suasana kopi & momen ngopi — Wesclic Coffee Shop')

@section('content')
    {{-- Hero --}}
    <section class="bg-gradient-to-r from-[#A3B18A] via-[#B08968] to-[#D4A373] text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 rounded-full border-4 border-white/30"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 rounded-full border-4 border-white/20"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <h1 class="text-5xl font-bold mb-4 font-serif">Gallery</h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">Suasana kopi & momen ngopi — bukan menu, tapi pengalaman.</p>
        </div>
    </section>

    {{-- Grid rapi: ukuran seragam, jarak konsisten --}}
    <section class="py-16 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($items->isEmpty())
                <div class="text-center py-20">
                    <p class="text-[#3A3A3A]/70 text-lg">Belum ada gambar di gallery. Tambah di <code class="bg-[#A3B18A]/20 px-2 py-1 rounded">config/gallery.php</code>.</p>
                </div>
            @else
                <div class="gallery-grid grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5" id="gallery-grid">
                    @foreach($items as $item)
                        @php
                            $placeholderUrl = 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800';
                        @endphp
                        <div class="gallery-item group rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer border border-[#A3B18A]/10 bg-[#e8e8e2] aspect-[4/3]" data-caption="{{ e($item['caption']) }}">
                            <div class="h-full w-full overflow-hidden relative">
                                <img
                                    src="{{ $item['image_url'] }}"
                                    alt="{{ $item['caption'] }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    onerror="this.onerror=null; this.src='{{ $placeholderUrl }}'; this.alt='{{ addslashes($item['caption']) }}';"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <span class="text-white font-semibold drop-shadow-lg text-sm">{{ $item['caption'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="gallery-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4" aria-hidden="true">
        <button type="button" id="lightbox-close" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors z-10" aria-label="Tutup">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl">
        <p id="lightbox-caption" class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-center text-sm bg-black/50 px-4 py-2 rounded-full"></p>
    </div>
@endsection

@push('styles')
<style>
    .gallery-grid .gallery-item { min-height: 0; }
    #gallery-lightbox.flex { display: flex !important; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const grid = document.getElementById('gallery-grid');
    if (!grid) return;

    const items = grid.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');

    items.forEach(function (el) {
        el.addEventListener('click', function () {
            const img = this.querySelector('img');
            const caption = this.getAttribute('data-caption') || '';
            if (img && lightbox && lightboxImg) {
                lightboxImg.src = img.src;
                lightboxImg.alt = caption;
                if (lightboxCaption) lightboxCaption.textContent = caption;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    function closeLightbox() {
        if (lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightbox) lightbox.addEventListener('click', function (e) { if (e.target === lightbox) closeLightbox(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeLightbox(); });
})();
</script>
@endpush
