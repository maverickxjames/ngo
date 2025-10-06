@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-200 flex">

    @include('admin.sidebar')

    <!-- 🌟 Main Content -->
    <main class="flex-1 p-8 bg-gray-900 text-gray-100 min-h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-wide">Admin Dashboard</h1>
            <span class="text-sm text-gray-400">Welcome, {{ Auth::user()->name }}</span>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-6 rounded-xl shadow-lg text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium">Total Users</h3>
                        <p class="text-3xl font-bold mt-1">{{ $userCount }}</p>
                    </div>
                    <i class="ri-group-line text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-600 to-emerald-400 p-6 rounded-xl shadow-lg text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium">Active Users</h3>
                        <p class="text-3xl font-bold mt-1">{{ $activeUsers }}</p>
                    </div>
                    <i class="ri-user-follow-line text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-yellow-600 to-amber-400 p-6 rounded-xl shadow-lg text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium">Pending Users</h3>
                        <p class="text-3xl font-bold mt-1">{{ $pendingUsers }}</p>
                    </div>
                    <i class="ri-time-line text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-600 to-yellow-500 p-6 rounded-xl shadow-lg text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium">Total Donations</h3>
                        <p class="text-3xl font-bold mt-1">₹{{ number_format($totalDonations, 2) }}</p>
                    </div>
                    <i class="ri-hand-heart-line text-3xl opacity-80"></i>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-10 border-t border-gray-700"></div>

        <!-- Recent Users -->
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-bold text-white mb-4">Recent User Activity</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($recentUsers as $user)
                        <tr class="hover:bg-gray-700 transition">
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 text-xs rounded-full font-semibold 
                                    {{ $user->status === 'active' ? 'bg-green-700 text-green-100' :
                                       ($user->status === 'pending' ? 'bg-yellow-700 text-yellow-100' : 'bg-red-700 text-red-100') }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>
@endsection
