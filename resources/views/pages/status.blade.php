@extends('layouts.app')

@section('title', 'Lacak Pesanan')
@section('description', 'Lacak status pesanan Anda dengan kode pesanan')

@section('content')
    <section class="bg-gradient-to-r from-[#A3B18A] to-[#B08968] text-white py-16 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 font-serif">Lacak Pesanan</h1>
            <p class="text-xl text-white/90">Masukkan kode pesanan Anda untuk melihat status.</p>
        </div>
    </section>

    <section class="py-20 bg-[#F7F7F2] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8 animate-fade-in-up hover-lift">
                @if(!empty($error))
                    <div class="mb-4 bg-red-500 text-white px-4 py-3 rounded-lg">
                        {{ $error }}
                    </div>
                @endif

                @if(!empty($recentOrderCodes))
                    <div class="mb-6 p-4 rounded-xl bg-[#A3B18A]/10 border border-[#A3B18A]/20 animate-slide-in-right">
                        <div class="text-sm font-semibold text-[#3A3A3A]/80 mb-2">Pesanan terakhir Anda</div>
                        <p class="text-xs text-[#3A3A3A]/60 mb-3">Kode pesanan tersimpan di perangkat ini (tanpa login). Klik untuk cek status.</p>
                        <ul class="space-y-2">
                            @foreach($recentOrderCodes as $code)
                                <li>
                                    <a href="{{ route('orders.show', $code) }}" class="flex items-center justify-between p-3 rounded-lg bg-white/80 hover:bg-[#A3B18A]/20 border border-[#A3B18A]/20 transition-all duration-300 group">
                                        <span class="font-mono font-bold text-[#3A3A3A]">{{ $code }}</span>
                                        <span class="text-[#B08968] group-hover:text-[#D4A373] font-semibold text-sm">Lihat status →</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="GET" action="{{ route('orders.status') }}" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#3A3A3A] mb-2">Kode Pesanan</label>
                        <input name="order_code" placeholder="Contoh: ORD202601280001" class="w-full px-4 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A]" required>
                    </div>
                    <button type="submit" class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        Cek Status
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

