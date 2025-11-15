<nav x-data="{ open: false }"
     class="backdrop-blur bg-white/80 dark:bg-gray-800/80 border-b border-gray-200 dark:border-gray-700 shadow-sm transition duration-300">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Section -->
            <div class="flex items-center gap-8">

                <!-- Custom ESE System Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center hover:scale-[1.02] transition">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold text-blue-600 tracking-tight">ESE</span>
                        <span class="text-xl font-semibold text-gray-800 dark:text-gray-200">System</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex space-x-6">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="font-semibold hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('admin.students.index')" 
                        :active="request()->routeIs('admin.students.*')"
                        class="font-semibold hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Students
                    </x-nav-link>

                    <x-nav-link :href="route('admin.rooms.index')" 
                        :active="request()->routeIs('admin.rooms.*')"
                        class="font-semibold hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Rooms
                    </x-nav-link>

                    <x-nav-link :href="route('admin.invigilators.index')" 
                        :active="request()->routeIs('admin.invigilators.*')"
                        class="font-semibold hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Invigilators
                    </x-nav-link>

                </div>
            </div>

            <!-- Right Section: User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

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
                            Profile
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right text-red-500 me-1"></i>
                                Log Out
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

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden transition-all duration-200">

        <!-- Links -->
        <div class="pt-2 pb-3 space-y-1 bg-white dark:bg-gray-800 shadow-inner">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                Students
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')">
                Rooms
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.invigilators.index')" :active="request()->routeIs('admin.invigilators.*')">
                Invigilators
            </x-responsive-nav-link>

        </div>

        <!-- User Info -->
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
                    Profile
                </x-responsive-nav-link>

                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>

    </div>
</nav>
