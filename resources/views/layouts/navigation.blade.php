<nav x-data="{ open: false, dropdownOpen: false, openSidebar: false }" 
     class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + Links -->
            <div class="flex items-center space-x-6" style="margin:auto">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('assets/img/logo-main.png') }}" alt="NGO Logo" class="h-10">
                    <span class="font-bold text-green-700 text-lg">
                        अक्षरदान सेवा <span class="text-orange-600">सोशल फाउंडेशन</span>
                    </span>
                </a>

                <!-- 🌿 Desktop Links -->
                <div class="hidden sm:flex sm:space-x-6 ml-8">
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-md font-medium transition 
                       {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('referrals.index') }}" 
                       class="px-3 py-2 rounded-md font-medium transition 
                       {{ request()->routeIs('referrals.index') ? 'bg-green-50 text-green-700 shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                        Members
                    </a>

                    <a href="{{ route('user.payouts') }}" 
                       class="px-3 py-2 rounded-md font-medium transition 
                       {{ request()->routeIs('user.payouts') ? 'bg-green-50 text-green-700 shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                        Payouts
                    </a>

                    <a href="{{ route('bank.edit') }}" 
                       class="px-3 py-2 rounded-md font-medium transition 
                       {{ request()->routeIs('bank.edit') ? 'bg-green-50 text-green-700 shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                        Bank
                    </a>

                    <a href="{{ route('user.support') }}" 
                       class="px-3 py-2 rounded-md font-medium transition 
                       {{ request()->routeIs('user.support') ? 'bg-green-50 text-green-700 shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                        Support
                    </a>
                </div>
            </div>

            <!-- 🌿 Right: Profile Dropdown -->
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

                <!-- Dropdown Menu -->
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                     class="absolute right-0 mt-2 w-56 bg-white text-gray-800 rounded-lg shadow-lg py-2 z-20 border" style="margin-top:250px">
                     @if(Auth::user()->role == 'Super Admin')
                     <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">
                        Administrator
                    </a>
                     @endif
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">
                        Profile
                    </a>
                    <a href="{{ route('user.privacypolicy') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">
                        Privacy Policy
                    </a>
                    <a href="{{ route('user.terms') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">
                        Terms & Conditions
                    </a>
                    <a href="{{ route('user.about') }}" class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-700">
                        About Us
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-red-50 hover:text-red-600">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- 🌿 Mobile Sidebar Navigation -->
            <div class="sm:hidden">
                <button @click="openSidebar = true"
                        class="fixed top-3 left-3 bg-green-600 text-white p-2 rounded-md shadow-md z-50 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Overlay -->
                <div x-show="openSidebar" x-transition.opacity 
                     @click="openSidebar = false"
                     class="fixed inset-0 bg-black bg-opacity-40 z-40"></div>

                <!-- Sidebar -->
                <aside x-show="openSidebar"
                       x-transition:enter="transition ease-out duration-300"
                       x-transition:enter-start="translate-x-[-100%]" 
                       x-transition:enter-end="translate-x-0"
                       x-transition:leave="transition ease-in duration-200"
                       x-transition:leave-start="translate-x-0"
                       x-transition:leave-end="translate-x-[-100%]"
                       class="fixed top-0 left-0 w-72 h-full bg-white shadow-2xl z-50 rounded-r-2xl overflow-y-auto">

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-green-600 to-orange-500 text-white flex items-center justify-between px-5 py-4 rounded-tr-2xl">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/img/logo-main.png') }}" class="h-10 w-10 rounded-full shadow-md">
                            <div>
                                <h2 class="font-bold text-lg leading-tight">अक्षरदान सेवा</h2>
                                <p class="text-xs text-orange-100">सोशल फाउंडेशन</p>
                            </div>
                        </div>
                        <button @click="openSidebar = false" class="text-white hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar Links -->
                    <div class="px-4 py-6 space-y-2 text-gray-800 font-medium">
                        @if(Auth::user()->role == 'Super Admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-settings-line mr-3 text-lg text-green-600"></i> Administrator
                        </a>
                        @endif 
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-dashboard-line mr-3 text-lg text-green-600"></i> Dashboard
                        </a>
                        <a href="{{ route('referrals.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-user-add-line mr-3 text-lg text-green-600"></i> Direct Members
                        </a>
                        <a href="{{ route('referrals.tree') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-team-line mr-3 text-lg text-green-600"></i> Team Tree
                        </a>
                        <a href="{{ route('user.payouts') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-wallet-3-line mr-3 text-lg text-green-600"></i> Payout
                        </a>
                        <a href="{{ route('bank.edit') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-bank-line mr-3 text-lg text-green-600"></i> Bank
                        </a>
                        <a href="{{ route('user.support') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-customer-service-2-line mr-3 text-lg text-green-600"></i> Support
                        </a>
                        <a href="{{ route('user.privacypolicy') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-lock-2-line mr-3 text-lg text-green-600"></i> Privacy Policy
                        </a>
                        <a href="{{ route('user.terms') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-file-text-line mr-3 text-lg text-green-600"></i> Terms & Conditions
                        </a>
                        <a href="{{ route('user.about') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700">
                            <i class="ri-information-line mr-3 text-lg text-green-600"></i> About Us
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t pt-4">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-700">
                                <i class="ri-logout-box-line mr-3 text-lg"></i> Logout
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</nav>
