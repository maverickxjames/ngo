@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="flex">
    <!-- ✅ Sidebar -->
    @include('admin.sidebar')

    <!-- ✅ Main Content -->
    <div class="flex-1 p-8 bg-gray-900 text-gray-100 min-h-screen">
        <h1 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Manage Users</h1>

        <!-- ✅ User Table -->
        <div class="bg-gray-800 shadow-lg rounded-xl overflow-hidden">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Username</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Joined</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-700 transition">
                        <td class="px-6 py-3">{{ $user->id }}</td>
                        <td class="px-6 py-3 font-medium text-white">{{ $user->username }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $user->status == 'active' ? 'bg-green-600 text-white' :
                                   ($user->status == 'pending' ? 'bg-yellow-500 text-black' : 'bg-red-600 text-white') }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}" class="flex justify-center items-center space-x-2">
                                @csrf
                                <select name="status" class="rounded-lg bg-gray-800 border border-gray-600 text-sm px-2 py-1 focus:ring-green-500">
                                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 px-3 py-1 text-xs text-white font-semibold rounded shadow">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Pagination -->
        <div class="mt-6">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
