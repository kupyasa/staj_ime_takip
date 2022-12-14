<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Anasayfa') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }} {{ Auth::user()->surname }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }} {{ Auth::user()->surname }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Hesab?? Y??net') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profil') }}
                            </x-jet-dropdown-link>

                            @ogrenci
                                <x-jet-dropdown-link href="{{ route('ogrenci.stajbasvurusuyapget') }}">
                                    {{ __('Staj Ba??vurusu Yap') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('ogrenci.stajlarget') }}">
                                    {{ __('Stajlar') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('ogrenci.imebasvurusuyapget') }}">
                                    {{ __('??ME Ba??vurusu Yap') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('ogrenci.imesget') }}">
                                    {{ __('????letmede Mesleki E??itimler') }}
                                </x-jet-dropdown-link>
                            @endogrenci
                            @ogretmen
                                <x-jet-dropdown-link href="{{ route('ogretmen.stajlarget') }}">
                                    {{ __('Stajlar') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('ogretmen.imesget') }}">
                                    {{ __('????letmede Mesleki E??itimler') }}
                                </x-jet-dropdown-link>
                            @endogretmen
                            @komisyon
                                <x-jet-dropdown-link href="{{ route('komisyon.stajlarget') }}">
                                    {{ __('Stajlar') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('komisyon.imesget') }}">
                                    {{ __('????letmede Mesleki E??itimler') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('komisyon.imesecimget') }}">
                                    {{ __('??ME i??in ????renci Se??') }}
                                </x-jet-dropdown-link>
                            @endkomisyon
                            @yonetici
                                <x-jet-dropdown-link href="{{ route('yonetici.stajlarget') }}">
                                    {{ __('Stajlar') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.imesget') }}">
                                    {{ __('????letmede Mesleki E??itimler') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.imesecimget') }}">
                                    {{ __('??ME i??in ????renci Se??') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullaniciekleget') }}">
                                    {{ __('Kullan??c?? Ekle') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullanicilarekleget') }}">
                                    {{ __('Toplu Kullan??c?? Ekle') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullanicilarget') }}">
                                    {{ __('Kullan??c??lar') }}
                                </x-jet-dropdown-link>
                            @endyonetici
                            @superyonetici
                                <x-jet-dropdown-link href="{{ route('yonetici.stajlarget') }}">
                                    {{ __('Stajlar') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.imesget') }}">
                                    {{ __('????letmede Mesleki E??itimler') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.imesecimget') }}">
                                    {{ __('??ME i??in ????renci Se??') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullaniciekleget') }}">
                                    {{ __('Kullan??c?? Ekle') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullanicilarekleget') }}">
                                    {{ __('Toplu Kullan??c?? Ekle') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('yonetici.kullanicilarget') }}">
                                    {{ __('Kullan??c??lar') }}
                                </x-jet-dropdown-link>
                            @endsuperyonetici
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('????k???? Yap') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Anasayfa') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name . ' ' . Auth::user()->surname }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">
                        {{ Auth::user()->name . ' ' . Auth::user()->surname }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profil') }}
                </x-jet-responsive-nav-link>

                @ogrenci
                    <x-jet-responsive-nav-link href="{{ route('ogrenci.stajbasvurusuyapget') }}" :active="request()->routeIs('ogrenci.stajbasvurusuyapget')">
                        {{ __('Staj Ba??vurusu Yap') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('ogrenci.stajlarget') }}" :active="request()->routeIs('ogrenci.stajlarget')">
                        {{ __('Stajlar') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('ogrenci.imebasvurusuyapget') }}" :active="request()->routeIs('ogrenci.imebasvurusuyapget')">
                        {{ __('??ME Ba??vurusu Yap') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('ogrenci.imesget') }}" :active="request()->routeIs('ogrenci.imesget')">
                        {{ __('????letmede Mesleki E??itimler') }}
                    </x-jet-responsive-nav-link>
                @endogrenci
                @ogretmen
                    <x-jet-responsive-nav-link href="{{ route('ogretmen.stajlarget') }}" :active="request()->routeIs('ogretmen.stajlarget')">
                        {{ __('Stajlar') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('ogretmen.imesget') }}" :active="request()->routeIs('ogretmen.imesget')">
                        {{ __('????letmede Mesleki E??itimler') }}
                    </x-jet-responsive-nav-link>
                @endogretmen
                @komisyon
                    <x-jet-responsive-nav-link href="{{ route('komisyon.stajlarget') }}" :active="request()->routeIs('komisyon.stajlarget')">
                        {{ __('Stajlar') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('komisyon.imesget') }}" :active="request()->routeIs('komisyon.imesget')">
                        {{ __('????letmede Mesleki E??itimler') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('komisyon.imesecimget') }}" :active="request()->routeIs('komisyon.imesecimget')">
                        {{ __('??ME i??in ????renci Se??') }}
                    </x-jet-responsive-nav-link>
                @endkomisyon
                @yonetici
                    <x-jet-responsive-nav-link href="{{ route('yonetici.stajlarget') }}" :active="request()->routeIs('yonetici.stajlarget')">
                        {{ __('Stajlar') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.imesget') }}" :active="request()->routeIs('yonetici.imesget')">
                        {{ __('????letmede Mesleki E??itimler') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.imesecimget') }}" :active="request()->routeIs('yonetici.imesecimget')">
                        {{ __('??ME i??in ????renci Se??') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullaniciekleget') }}" :active="request()->routeIs('yonetici.kullaniciekleget')">
                        {{ __('Kullan??c?? Ekle') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullanicilarekleget') }}" :active="request()->routeIs('yonetici.kullanicilarekleget')">
                        {{ __('Toplu Kullan??c?? Ekle') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullanicilarget') }}" :active="request()->routeIs('yonetici.kullanicilarget')">
                        {{ __('Kullan??c??lar') }}
                    </x-jet-responsive-nav-link>
                @endyonetici
                @superyonetici
                    <x-jet-responsive-nav-link href="{{ route('yonetici.stajlarget') }}" :active="request()->routeIs('yonetici.stajlarget')">
                        {{ __('Stajlar') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.imesget') }}" :active="request()->routeIs('yonetici.imesget')">
                        {{ __('????letmede Mesleki E??itimler') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.imesecimget') }}" :active="request()->routeIs('yonetici.imesecimget')">
                        {{ __('??ME i??in ????renci Se??') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullaniciekleget') }}" :active="request()->routeIs('yonetici.kullaniciekleget')">
                        {{ __('Kullan??c?? Ekle') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullanicilarekleget') }}" :active="request()->routeIs('yonetici.kullanicilarekleget')">
                        {{ __('Toplu Kullan??c?? Ekle') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('yonetici.kullanicilarget') }}" :active="request()->routeIs('yonetici.kullanicilarget')">
                        {{ __('Kullan??c??lar') }}
                    </x-jet-responsive-nav-link>
                @endsuperyonetici

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('????k???? Yap') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
