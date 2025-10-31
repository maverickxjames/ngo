<div x-data="{ sidebarOpen: false }" class=" flex">

    <!-- 📱 Mobile Toggle Button -->
    <button @click="sidebarOpen = true"
        class="sm:hidden fixed top-4 left-4 z-50 bg-green-600 hover:bg-green-700 text-white p-2 rounded-md focus:outline-none">
        <i class="ri-menu-2-line text-xl"></i>
    </button>

    <!-- 🌙 Sidebar -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed sm:relative inset-y-0 left-0 w-64 bg-gray-800 text-gray-200 p-4 space-y-6 transform transition-transform duration-300 ease-in-out sm:translate-x-0 sm:transform-none z-40 shadow-lg flex flex-col justify-between">

        <div>
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logo-main.png') }}" class="h-10 rounded-full">
                    <span class="text-lg font-bold">Admin Panel</span>
                </div>

                <!-- Close Button (Mobile Only) -->
                <button @click="sidebarOpen = false" class="sm:hidden text-gray-400 hover:text-gray-100">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-dashboard-line mr-2"></i> Dashboard
                </a>

                <a href="{{ route('admin.users') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.users*') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-user-3-line mr-2"></i> Manage Users
                </a>
                <a href="{{ route('admin.pins') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.pins*') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-shield-keyhole-line mr-2"></i> Generate Pin
                </a>

                <a href="{{ route('admin.payments') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.payments*') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-bank-card-line mr-2"></i> Payments
                </a>

                <a href="{{ route('admin.payouts') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.payouts*') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-wallet-3-line mr-2"></i> Payouts
                </a>

                <a href="{{ route('admin.earnings') }}"
                   class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition {{ request()->routeIs('admin.earnings*') ? 'bg-green-600 text-white' : '' }}">
                    <i class="ri-money-dollar-circle-line mr-2"></i> Earnings
                </a>

                <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <i class="ri-settings-3-line mr-2"></i> Settings
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-700 pt-6 mt-6">
            @csrf
            <button class="flex items-center w-full px-3 py-2 text-red-400 hover:bg-red-600 hover:text-white rounded-md">
                <i class="ri-logout-box-line mr-2"></i> Logout
            </button>
        </form>
    </aside>

    <!-- 🌗 Overlay (for mobile) -->
    <div x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 sm:hidden z-30">
    </div>
</div>
