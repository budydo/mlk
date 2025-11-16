@extends('layouts.app')

@section('title','Kelola Pengguna')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-extrabold">Kelola Pengguna</h1>
      <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">
        + Tambah Pengguna
      </a>
    </div>

    @if ($message = Session::get('success'))
      <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">{{ $message }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse ($users as $user)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                  @if($user->role === 'admin') bg-red-100 text-red-800
                  @elseif($user->role === 'editor') bg-blue-100 text-blue-800
                  @else bg-gray-100 text-gray-800
                  @endif
                ">
                  {{ ucfirst($user->role) }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ $user->created_at->format('d M Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus pengguna ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-4 text-center text-gray-600">Tidak ada pengguna.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $users->links() }}
    </div>
  </div>
</section>
@endsection
