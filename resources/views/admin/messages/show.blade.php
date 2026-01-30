@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-[#B08968] hover:text-[#D4A373]">
            ← Kembali ke daftar pesan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Detail pesan --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-[#A3B18A]/20 p-6 space-y-4">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-2xl font-bold text-[#3A3A3A]">Detail Pesan</h1>
                @php
                    $statusColors = [
                        'baru' => 'bg-red-100 text-red-700',
                        'dibaca' => 'bg-yellow-100 text-yellow-700',
                        'dibalas' => 'bg-green-100 text-green-700',
                    ];
                @endphp
                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$message->status] ?? 'bg-gray-100 text-gray-700' }}">
                    Status: {{ ucfirst($message->status) }}
                </span>
            </div>

            <div class="space-y-3 text-sm text-[#3A3A3A]/80">
                <div>
                    <span class="font-semibold text-[#3A3A3A]">Nama:</span>
                    <span>{{ $message->name }}</span>
                </div>
                <div>
                    <span class="font-semibold text-[#3A3A3A]">Email:</span>
                    <a href="mailto:{{ $message->email }}" class="text-[#B08968] hover:underline">
                        {{ $message->email }}
                    </a>
                </div>
                @if($message->phone)
                    <div>
                        <span class="font-semibold text-[#3A3A3A]">Telepon:</span>
                        <span>{{ $message->phone }}</span>
                    </div>
                @endif
                <div>
                    <span class="font-semibold text-[#3A3A3A]">Tanggal Kirim:</span>
                    <span>{{ $message->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-lg font-semibold text-[#3A3A3A] mb-2">Isi Pesan</h2>
                <div class="p-4 bg-[#F8FAF5] rounded-lg text-sm text-[#3A3A3A] whitespace-pre-line">
                    {{ $message->message }}
                </div>
            </div>

            @if($message->admin_reply)
                <div class="mt-6 border-t border-[#A3B18A]/20 pt-4">
                    <h2 class="text-lg font-semibold text-[#3A3A3A] mb-2">Balasan Admin</h2>
                    <p class="text-xs text-[#3A3A3A]/60 mb-2">
                        Dibalas oleh {{ $message->replier?->name ?? 'Admin' }}
                        @if($message->replied_at)
                            pada {{ $message->replied_at->format('d M Y H:i') }}
                        @endif
                    </p>
                    <div class="p-4 bg-white border border-[#A3B18A]/30 rounded-lg text-sm text-[#3A3A3A] whitespace-pre-line">
                        {{ $message->admin_reply }}
                    </div>
                </div>
            @endif
        </div>

        {{-- Form balasan --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#A3B18A]/20 p-6">
            <h2 class="text-lg font-semibold text-[#3A3A3A] mb-4">Balas via Email</h2>

            @if(session('success'))
                <div class="mb-4 bg-[#A3B18A] text-white px-4 py-2 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.contact-messages.reply', $message) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reply_message" class="block text-sm font-medium text-[#3A3A3A] mb-1">
                        Pesan Balasan
                    </label>
                    <textarea id="reply_message" name="reply_message" rows="6"
                              class="w-full px-3 py-2 border border-[#A3B18A]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A3B18A] focus:border-transparent text-sm @error('reply_message') border-red-500 @enderror"
                              placeholder="Tulis balasan Anda di sini...">{{ old('reply_message', $message->admin_reply) }}</textarea>
                    @error('reply_message')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-[#A3B18A] hover:bg-[#8FA075] text-white text-sm font-semibold py-2.5 rounded-lg transition-colors">
                    Kirim Balasan ke Email
                </button>
            </form>
        </div>
    </div>
@endsection

