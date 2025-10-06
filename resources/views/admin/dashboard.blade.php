@extends('layouts.admin')

@section('content')
<div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-900 text-gray-200 flex">

    <!-- 🌙 Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-gray-800 to-gray-900 shadow-lg transform transition-transform duration-300 ease-in-out sm:translate-x-0 z-50">

        <!-- Logo -->
        <div class="flex items-center space-x-2 px-6 py-5 border-b border-gray-700">
            <img src="{{ asset('assets/img/logo-main.png') }}" alt="Logo" class="h-10 w-10 rounded-full">
            <h1 class="text-lg font-bold text-white leading-tight">Admin Panel</h1>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-green-400' : '' }}">
                <i class="ri-dashboard-line mr-3 text-lg"></i> Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
               class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.users') ? 'bg-gray-700 text-green-400' : '' }}">
                <i class="ri-user-3-line mr-3 text-lg"></i> Manage Users
            </a>

            <a href="{{ route('admin.payments') }}"
               class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.payments') ? 'bg-gray-700 text-green-400' : '' }}">
                <i class="ri-bank-card-line mr-3 text-lg"></i> Donations
            </a>

            <a href="{{ route('admin.payouts') }}"
               class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.payouts') ? 'bg-gray-700 text-green-400' : '' }}">
                <i class="ri-wallet-3-line mr-3 text-lg"></i> Payouts
            </a>

            <a href="#0"
               class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.settings') ? 'bg-gray-700 text-green-400' : '' }}">
                <i class="ri-settings-3-line mr-3 text-lg"></i> Settings
            </a>
        </nav>

        <!-- Logout -->
        <div class="border-t border-gray-700 mt-auto px-4 py-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center w-full px-4 py-2 rounded-lg text-red-400 hover:bg-red-800 hover:text-red-100 transition">
                    <i class="ri-logout-box-line mr-3 text-lg"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- 🌗 Overlay (for mobile) -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black bg-opacity-50 sm:hidden z-40"></div>

    <!-- 📱 Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen"
            class="sm:hidden fixed top-4 left-4 bg-green-600 text-white p-2 rounded-md z-50 focus:outline-none">
        <i class="ri-menu-2-line text-xl"></i>
    </button>

    <!-- 🌟 Main Content -->
    <main class="flex-1 sm:ml-64 p-8 bg-gray-900 text-gray-100 min-h-screen">

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
