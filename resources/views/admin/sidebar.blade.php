<div class="w-64 bg-gray-800 min-h-screen text-gray-200 p-4 space-y-6">
    <div class="flex items-center space-x-3 mb-8">
        <img src="{{ asset('assets/img/logo-main.png') }}" class="h-10 rounded-full">
        <span class="text-lg font-bold">Admin Panel</span>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : '' }}">
            <i class="ri-dashboard-line mr-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.users.index') ? 'bg-green-600 text-white' : '' }}">
            <i class="ri-user-3-line mr-2"></i> Manage Users
        </a>
        <a href="{{ route('admin.payouts') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
            <i class="ri-wallet-3-line mr-2"></i> Payouts
        </a>
        <a href="#0" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
            <i class="ri-settings-3-line mr-2"></i> Settings
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="pt-6 border-t border-gray-700">
        @csrf
        <button class="flex items-center w-full px-3 py-2 text-red-400 hover:bg-red-600 hover:text-white rounded-md">
            <i class="ri-logout-box-line mr-2"></i> Logout
        </button>
    </form>
</div>
