@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#3A3A3A]">Pesan Kontak</h1>
            <p class="text-sm text-[#3A3A3A]/70">Pesan yang dikirim dari halaman Hubungi Kami.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-[#A3B18A]/20">
        <div class="px-6 py-4 border-b border-[#A3B18A]/20 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-sm text-[#3A3A3A]/70">Filter status:</span>
                <a href="{{ route('admin.contact-messages.index') }}"
                   class="px-3 py-1 rounded-full text-sm {{ request('status') ? 'text-[#3A3A3A]/60' : 'bg-[#A3B18A] text-white' }}">
                    Semua
                </a>
                @foreach (['baru' => 'Baru', 'dibaca' => 'Dibaca', 'dibalas' => 'Dibalas'] as $value => $label)
                    <a href="{{ route('admin.contact-messages.index', ['status' => $value]) }}"
                       class="px-3 py-1 rounded-full text-sm {{ request('status') === $value ? 'bg-[#A3B18A] text-white' : 'text-[#3A3A3A]/60' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#A3B18A]/20">
                <thead class="bg-[#F8FAF5]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Pesan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Dibalas Oleh</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#3A3A3A]/70 uppercase tracking-wider">Tgl Kirim</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#A3B18A]/10">
                    @forelse($messages as $message)
                        <tr class="{{ $message->isNew() ? 'bg-[#FDFBF4]' : '' }}">
                            <td class="px-6 py-4 text-sm text-[#3A3A3A]">
                                <div class="font-semibold">{{ $message->name }}</div>
                                @if($message->phone)
                                    <div class="text-xs text-[#3A3A3A]/60">{{ $message->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-[#3A3A3A]">
                                <a href="mailto:{{ $message->email }}" class="text-[#B08968] hover:underline">
                                    {{ $message->email }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#3A3A3A]/80 max-w-xs">
                                {{ \Illuminate\Support\Str::limit($message->message, 60) }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $statusColors = [
                                        'baru' => 'bg-red-100 text-red-700',
                                        'dibaca' => 'bg-yellow-100 text-yellow-700',
                                        'dibalas' => 'bg-green-100 text-green-700',
                                    ];
                                @endphp
                                <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$message->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#3A3A3A]/80">
                                {{ $message->replier?->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-[#3A3A3A]/80">
                                {{ $message->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.contact-messages.show', $message) }}"
                                   class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm bg-[#A3B18A] text-white hover:bg-[#8FA075]">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-sm text-[#3A3A3A]/60">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-[#A3B18A]/20">
            {{ $messages->withQueryString()->links() }}
        </div>
    </div>
@endsection

