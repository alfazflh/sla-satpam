<nav x-data="{ open: false }" 
     class="fixed top-0 left-0 right-0 w-full z-50 bg-[#1f7389] shadow-md 
            font-[Plus Jakarta Sans] text-[14px] leading-tight tracking-normal 
            *:text-[14px] *:font-[Plus Jakarta Sans] *:leading-tight *:tracking-normal">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo + Menu -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="block h-10 w-auto fill-current text-white" />
                </a>

                @auth
                <div class="hidden sm:flex space-x-6">
                    {{-- Link Dashboard: tampil untuk semua --}}
                    <a href="{{ route('dashboard') }}"
                       class="text-white font-medium hover:text-gray-200 transition {{ request()->routeIs('admin.dashboard') ? 'underline underline-offset-4' : '' }}
                       ">
                       Dashboard
                    </a>
                
                    {{-- Link Form: tampil hanya kalau admin --}}
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('welcome') }}"
                           class="text-white font-medium hover:text-gray-200 transition {{ request()->routeIs('welcome') ? 'underline underline-offset-4' : '' }}">
                           Form
                        </a>
                    @endif
                </div>
                @endauth                
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}"
                       class="font-medium text-white bg-[#196275] px-3 py-1.5 rounded-md hover:opacity-90 transition">
                       Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="font-medium text-[#196275] bg-white px-3 py-1.5 rounded-md hover:bg-gray-100 transition">
                       Register
                    </a>
                @endguest

                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-1 font-medium text-white bg-[#196275] px-3 py-1.5 rounded-md hover:opacity-90 transition">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="sm:hidden">
                <button @click="open = ! open"
                    class="p-2 text-white hover:bg-[#196275] rounded-md transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-[#1f7389]">
        <div class="pt-2 pb-3 space-y-1 text-center">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="block text-white py-2 font-medium hover:bg-[#196275] transition">
                   Dashboard
                </a>
                <a href="{{ route('welcome') }}"
                   class="block text-white py-2 font-medium hover:bg-[#196275] transition">
                   Form
                </a>
                <form method="POST" action="{{ route('logout') }}" class="border-t border-[#196275] mt-2">
                    @csrf
                    <button type="submit"
                            class="w-full text-white py-2 font-medium hover:bg-[#196275] transition">
                            Log Out
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="block text-white py-2 font-medium hover:bg-[#196275] transition">
                   Login
                </a>
                <a href="{{ route('register') }}"
                   class="block text-white py-2 font-medium hover:bg-[#196275] transition">
                   Register
                </a>
            @endguest
        </div>
    </div>
</nav>
