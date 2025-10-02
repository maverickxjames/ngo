<nav x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left side: Logo + Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('assets/img/logo-main.jpg') }}" alt="NGO Logo" class="h-10 mx-auto">
                    <span class="font-bold text-green-700 text-lg">अक्षरदान सोशल <span class="text-orange-600">सेवा फाउंडेशन</span> </span>
                </a>

                <!-- Desktop Links -->
                <div class="hidden sm:flex sm:space-x-6 sm:ml-10">
                    <a href="{{ route('dashboard') }}"
                       class="text-gray-600 hover:text-green-700 font-medium {{ request()->routeIs('dashboard') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Dashboard
                    </a>
                    <a href="#"
                       class="text-gray-600 hover:text-green-700 font-medium">
                        Members
                    </a>
                    <a href="#"
                       class="text-gray-600 hover:text-green-700 font-medium">
                        Payments
                    </a>
                </div>
            </div>

            <!-- Right side: Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-green-700 focus:outline-none">
                        <span class="mr-2">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="dropdownOpen" 
                         @click.away="dropdownOpen = false"
                         class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-2 z-20">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" 
                              class="inline-flex" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" 
                              class="hidden" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden">
        <div class="px-4 pt-4 pb-3 space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-gray-700 font-medium hover:text-green-700">
                Dashboard
            </a>
            <a href="#" class="block text-gray-700 font-medium hover:text-green-700">
                Members
            </a>
            <a href="#" class="block text-gray-700 font-medium hover:text-green-700">
                Payments
            </a>
        </div>

        <!-- Mobile Profile -->
        <div class="border-t border-gray-200 px-4 py-3">
            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            <div class="mt-3">
                <a href="{{ route('profile.edit') }}" class="block px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
