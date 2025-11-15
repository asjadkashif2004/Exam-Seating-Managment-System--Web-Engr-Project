<nav x-data="{ open: false }"
     class="backdrop-blur bg-white/80 dark:bg-gray-800/80 border-b border-gray-200 dark:border-gray-700 shadow-sm transition duration-300">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Section -->
            <div class="flex items-center gap-6">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center hover:scale-[1.02] transition">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-900 dark:text-gray-200" />
                </a>

                <!-- Dashboard Link -->
                <div class="hidden sm:flex space-x-8">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="font-semibold hover:text-blue-600 dark:hover:text-blue-400 transition">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Section: User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <!-- Trigger Button -->
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-transparent 
                                bg-white/70 dark:bg-gray-800/70
                                text-gray-700 dark:text-gray-300
                                hover:bg-gray-100 dark:hover:bg-gray-900 
                                shadow-sm hover:shadow-md transition-all duration-200">

                            <span class="font-semibold">{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M5.8 7l4.2 4 4.2-4 1.8 1.7-6 5.3-6-5.3z" />
                            </svg>
                        </button>

                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person-circle text-blue-500 me-1"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right text-red-500 me-1"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden transition-all duration-200">

        <!-- Links -->
        <div class="pt-2 pb-3 space-y-1 bg-white dark:bg-gray-800 shadow-inner">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- User Info + Logout -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800">

            <div class="px-4 pb-2">
                <div class="font-semibold text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>

    </div>
</nav>
