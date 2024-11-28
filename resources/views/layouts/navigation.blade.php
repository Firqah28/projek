<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Side: Logo and Links -->
            <div class="flex items-center space-x-6">
                <!-- Logo and Website Name -->
                <div class="flex items-center space-x-2">
                    <!-- Logo -->
                    <div class="shrink-0">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block w-10 h-10 text-yellow-300"/>
                        </a>
                    </div>

                    <!-- Website Name -->
                    <span class="text-xl font-semibold text-white">Setia Outdoor</span>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-300 transition">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-yellow-300 transition">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sewa')" :active="request()->routeIs('sewa')" class="text-white hover:text-yellow-300 transition">
                        {{ __('Sewa') }}
                    </x-nav-link>
                    <!-- New History Link -->
                    <x-nav-link :href="route('history')" :active="request()->routeIs('history')" class="text-white hover:text-yellow-300 transition">
                        {{ __('History') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side: User Dropdown -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5 ml-1 text-gray-400 transition-transform transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Auth()->check() && Auth()->user()->role == 'admin')
                            <!-- Admin Dropdown Menu -->
                            <x-dropdown-link :href="route('admin_create')" class="text-gray-700 hover:bg-gray-100">
                                {{ __('Admin Create') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.outdoor-items')" class="text-gray-700 hover:bg-gray-100">
                                {{ __('Admin Outdoor Items') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.sewa')" class="text-gray-700 hover:bg-gray-100">
                                {{ __('Admin Sewa') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-700 hover:bg-gray-100">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" :class="{'hidden': open, 'block': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6" :class="{'block': open, 'hidden': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden bg-gray-800">
        <div class="py-2 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:bg-gray-700">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:bg-gray-700">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sewa')" :active="request()->routeIs('sewa')" class="text-white hover:bg-gray-700">
                {{ __('Sewa') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history')" :active="request()->routeIs('history')" class="text-white hover:bg-gray-700">
                {{ __('History') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="py-3 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-gray-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Auth()->check() && Auth()->user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin_create')" class="text-white hover:bg-gray-700">
                        {{ __('Admin Create') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.outdoor-items')" class="text-white hover:bg-gray-700">
                        {{ __('Admin Outdoor Items') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.sewa')" class="text-white hover:bg-gray-700">
                        {{ __('Admin Sewa') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:bg-gray-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
