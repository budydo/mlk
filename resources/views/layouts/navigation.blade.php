<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Wrapper dengan py-1 agar navbar memiliki padding vertikal kecil untuk efek hover yang tidak full height --}}
        <div class="flex justify-between items-center h-auto py-2">
            <div class="flex items-center">
                <!-- Logo: custom MLK with M berwarna hijau -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        {{-- Inline simple logo: M berwarna hijau, LK berwarna gelap --}}
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-emerald-50">
                            <span class="text-2xl font-extrabold" style="color:#059669;">M</span>
                        </span>
                        <span class="text-lg font-bold text-gray-800">LK</span>
                    </a>
                </div>

                <!-- Navigation Links (publik) -->
                {{-- Container untuk menu links dengan spacing yang tepat untuk hover effect --}}
                {{-- space-x-2: gap antar menu item (bukan space-x-8) untuk efek block yang lebih compact --}}
                {{-- items-center: align vertikal di tengah navbar --}}
                <div class="hidden sm:flex sm:ms-10 sm:items-center sm:space-x-2 desktop-nav">
                    {{-- Navigasi: gunakan anchor ke sections di halaman home jika user berada di halaman home --}}
                    {{-- :active=false karena scrollspy JavaScript yang mengelola highlighting saat scroll dengan class 'nav-active' --}}
                    <x-nav-link :href="request()->routeIs('home') ? '#hero' : route('home') . '#hero'" :active="false">Beranda</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#about' : route('home') . '#about'" :active="false">Tentang</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#process' : route('home') . '#process'" :active="false">Proses</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#projects' : route('home') . '#projects'" :active="false">Portofolio</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#blog' : route('home') . '#blog'" :active="false">Blog</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#services' : route('services.index')" :active="false">Layanan</x-nav-link>
                    <x-nav-link :href="request()->routeIs('home') ? '#contact' : route('contact')" :active="false">Kontak</x-nav-link>
                </div>
            </div>

            <!-- Settings / Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if (Route::has('profile.edit'))
                                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700">Daftar</a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mobile-nav">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#hero' : route('home') . '#hero'" :active="request()->routeIs('home')">Beranda</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#about' : route('home') . '#about'" :active="request()->routeIs('home')">Tentang</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#process' : route('home') . '#process'" :active="request()->routeIs('home')">Proses</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#projects' : route('home') . '#projects'" :active="request()->routeIs('portfolio.*')">Portofolio</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#blog' : route('home') . '#blog'" :active="request()->routeIs('blog.*')">Blog</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#services' : route('services.index')" :active="request()->routeIs('services.*')">Layanan</x-responsive-nav-link>
            <x-responsive-nav-link :href="request()->routeIs('home') ? '#contact' : route('contact')" :active="request()->routeIs('contact')">Kontak</x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if (Route::has('profile.edit'))
                        <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-700">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block text-sm text-gray-700 mt-1">Daftar</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
