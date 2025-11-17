@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-4xl">
    <h1 class="text-2xl font-bold mb-6">Editor - Lihat Pesan Masuk</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600 text-sm">Nama Pengirim</p>
                <p class="font-semibold">{{ $contactMessage->name }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Email</p>
                <p class="font-semibold">{{ $contactMessage->email }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Nomor Telepon (WhatsApp)</p>
                <p class="font-semibold">{{ $contactMessage->phone ?? 'Tidak ada' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Subject</p>
                <p class="font-semibold">{{ $contactMessage->subject ?? 'Tanpa subject' }}</p>
            </div>
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <p class="text-gray-600 text-sm mb-2">Pesan</p>
            <div class="bg-gray-50 p-4 rounded whitespace-pre-wrap">
                {{ $contactMessage->message }}
            </div>
        </div>

        <div class="text-sm text-gray-500">
            Diterima: {{ $contactMessage->created_at->format('d/m/Y H:i:s') }}
            | Status: 
            @if($contactMessage->is_handled)
                <span class="text-green-600 font-semibold">✓ Sudah Ditangani</span>
            @else
                <span class="text-yellow-600 font-semibold">⧗ Menunggu Ditangani</span>
            @endif
        </div>
    </div>

    @if($contactMessage->replies->count() > 0)
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Riwayat Balasan</h2>
            
            <div class="space-y-4">
                @foreach($contactMessage->replies as $reply)
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold text-sm">{{ $reply->user?->name ?? 'Sistem' }}</p>
                                <p class="text-gray-500 text-xs">{{ $reply->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="text-right text-xs">
                                <p>
                                    Email: <span class="font-semibold {{ $reply->email_status === 'sent' ? 'text-green-600' : 'text-red-600' }}">{{ $reply->email_status }}</span>
                                </p>
                                <p>
                                    WhatsApp: <span class="font-semibold {{ in_array($reply->whatsapp_status, ['sent', 'queued']) ? 'text-green-600' : 'text-red-600' }}">{{ $reply->whatsapp_status }}</span>
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $reply->reply_text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Kirim Balasan</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('editor.contact-messages.reply', $contactMessage) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">Pesan Balasan</label>
                <textarea id="reply" name="reply" rows="6" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis pesan balasan Anda di sini..." required>{{ old('reply') }}</textarea>
                @error('reply')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Pesan ini akan dikirim ke: <strong>{{ $contactMessage->email }}</strong>
                    @if($contactMessage->phone) dan WhatsApp <strong>{{ $contactMessage->phone }}</strong>@endif
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">📤 Kirim Balasan</button>
                <a href="{{ route('editor.contact-messages.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">← Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
