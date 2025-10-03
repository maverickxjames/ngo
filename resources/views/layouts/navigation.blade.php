<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + Links -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('assets/img/logo-main.png') }}" alt="NGO Logo" class="h-10">
                    <span class="font-bold text-green-700 text-lg">
                        अक्षरदान सेवा <span class="text-orange-600">सोशल फाउंडेशन</span>
                    </span>
                </a>

                <!-- Desktop Links -->
                <div class="hidden sm:flex sm:space-x-6 ml-8">
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-md font-medium transition {{ request()->routeIs('dashboard') ? 'bg-white text-green-700 shadow' : 'hover:bg-white hover:text-green-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('referrals.index') }}" class="px-3 py-2 rounded-md font-medium transition hover:bg-white hover:text-green-700">Members</a>
                    <a href="#" class="px-3 py-2 rounded-md font-medium transition hover:bg-white hover:text-green-700">Payments</a>
                    <a href="#" class="px-3 py-2 rounded-md font-medium transition hover:bg-white hover:text-green-700">Bank</a>
                    <a href="#" class="px-3 py-2 rounded-md font-medium transition hover:bg-white hover:text-green-700">Support</a>
                </div>
            </div>

            <!-- Right: Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center relative">
                <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center px-3 py-2 text-sm font-medium bg-white text-green-700 rounded-md shadow hover:bg-green-50 focus:outline-none">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': dropdownOpen }"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                     class="absolute right-0 mt-2 w-56 bg-white text-gray-800 rounded-lg shadow-lg py-2 z-20 border">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">Privacy Policy</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">Terms & Conditions</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">About Us</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">Share</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-red-50 hover:text-red-600">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" 
                              class="inline-flex" 
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" 
                              class="hidden" 
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden border-t border-green-500 bg-white shadow-lg">
        <div class="px-4 pt-4 pb-3 space-y-2 text-gray-800">
            <a href="{{ route('dashboard') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Dashboard</a>
            <a href="{{ route('referrals.index') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Direct Members</a>
            <a href="{{ route('referrals.tree') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Team Member</a>
            <a href="{{ route('user.payouts') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Payout</a>
            <a href="{{ route('bank.edit') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Bank</a>
            <a href="{{ route('user.support') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Support</a>
            <a href="{{ route('user.privacypolicy') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Privacy Policy</a>
            <a href="{{ route('user.terms') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Terms & Conditions</a>
            <a href="{{ route('user.about') }}" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">About Us</a>
            {{-- <a href="#" class="block px-2 py-2 rounded hover:bg-green-50 hover:text-green-700">Share</a> --}}
        </div>

        <!-- Mobile Profile -->
        <div class="border-t border-gray-200 px-4 py-3">
            <div class="text-base font-medium">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
            <div class="mt-3">
                <a href="{{ route('profile.edit') }}" class="block px-2 py-2 text-sm hover:bg-green-50 hover:text-green-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-2 py-2 text-sm hover:bg-red-50 hover:text-red-600">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
