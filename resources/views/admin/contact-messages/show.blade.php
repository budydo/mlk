@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-3xl">
    <h1 class="text-2xl font-bold mb-4">View Message</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow p-4 mb-4">
        <p><strong>From:</strong> {{ $contactMessage->name }} &lt;{{ $contactMessage->email }}&gt;</p>
        <p><strong>Phone:</strong> {{ $contactMessage->phone ?? '-' }}</p>
        <p><strong>Subject:</strong> {{ $contactMessage->subject ?? '-' }}</p>
        <hr class="my-2">
        <p>{{ $contactMessage->message }}</p>
        <p class="text-sm text-gray-500 mt-2">Received: {{ $contactMessage->created_at->toDayDateTimeString() }}</p>
    </div>

    <div class="bg-white shadow p-4">
        <h2 class="text-xl font-semibold mb-2">Reply</h2>
        <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Message</label>
                <textarea name="reply" rows="6" class="w-full border rounded p-2" required>{{ old('reply') }}</textarea>
                @error('reply')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Send Reply</button>
                <a href="{{ route('admin.contact-messages.index') }}" class="ml-3 text-gray-600">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
