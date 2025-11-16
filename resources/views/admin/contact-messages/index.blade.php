@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Contact Messages</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">From</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Phone</th>
                <th class="py-2 px-4 border">Subject</th>
                <th class="py-2 px-4 border">Received</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $m)
            <tr class="odd:bg-gray-50">
                <td class="py-2 px-4 border">{{ $m->name }}</td>
                <td class="py-2 px-4 border">{{ $m->email }}</td>
                <td class="py-2 px-4 border">{{ $m->phone ?? '-' }}</td>
                <td class="py-2 px-4 border">{{ $m->subject ?? '-' }}</td>
                <td class="py-2 px-4 border">{{ $m->created_at->diffForHumans() }}</td>
                <td class="py-2 px-4 border">
                    <a href="{{ route('admin.contact-messages.show', $m) }}" class="text-blue-600 mr-2">View</a>
                    <form action="{{ route('admin.contact-messages.destroy', $m) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Delete this message?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center">No messages found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
