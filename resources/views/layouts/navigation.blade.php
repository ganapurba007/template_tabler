<nav x-data="{ open: false }" class="edusite-header arsha-header sticky-top">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Left: Brand Logo (Arsha Style) -->
            <div class="flex items-center space-x-6">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user() && Auth::user()->isGuru() ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3 text-decoration-none">
                        <div class="rounded-circle text-white flex items-center justify-center p-2.5 shadow-sm" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); width: 44px; height: 44px;">
                            <i class="ti ti-school text-2xl"></i>
                        </div>
                        <span class="arsha-sitename" style="font-family: 'Jost', sans-serif; font-size: 1.6rem; font-weight: 800; color: #3368A0; letter-spacing: 0.5px;">ARSHA <span style="color: #66A3BF;">LMS</span></span>
                    </a>
                </div>

                <!-- Edusite Main Menu Navigation Links -->
                <div class="hidden md:flex space-x-1 items-center ms-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-decoration-none px-3.5 py-2 rounded-full transition {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-700 hover:text-primary' }}" style="{{ request()->routeIs('dashboard') ? 'background-color: #66A3BF; color: #ffffff !important;' : '' }}">
                        Home / Dashboard
                    </a>

                    @if(Auth::user() && Auth::user()->isSiswa())
                        <a href="{{ route('student.materials.index') }}" class="text-sm font-bold text-decoration-none px-3.5 py-2 rounded-full transition {{ request()->routeIs('student.materials.*') ? 'text-white' : 'text-gray-700 hover:text-primary' }}" style="{{ request()->routeIs('student.materials.*') ? 'background-color: #66A3BF; color: #ffffff !important;' : '' }}">
                            Courses / Materi
                        </a>
                        <a href="{{ route('student.assignments.index') }}" class="text-sm font-bold text-decoration-none px-3.5 py-2 rounded-full transition {{ request()->routeIs('student.assignments.*') ? 'text-white' : 'text-gray-700 hover:text-primary' }}" style="{{ request()->routeIs('student.assignments.*') ? 'background-color: #66A3BF; color: #ffffff !important;' : '' }}">
                            Tugas Kelas
                        </a>
                        <a href="{{ route('student.quizzes.index') }}" class="text-sm font-bold text-decoration-none px-3.5 py-2 rounded-full transition {{ request()->routeIs('student.quizzes.*') ? 'text-white' : 'text-gray-700 hover:text-primary' }}" style="{{ request()->routeIs('student.quizzes.*') ? 'background-color: #66A3BF; color: #ffffff !important;' : '' }}">
                            Kuis Online
                        </a>
                        <a href="{{ route('student.report.index') }}" class="text-sm font-bold text-decoration-none px-3.5 py-2 rounded-full transition {{ request()->routeIs('student.report.*') ? 'text-white' : 'text-gray-700 hover:text-primary' }}" style="{{ request()->routeIs('student.report.*') ? 'background-color: #66A3BF; color: #ffffff !important;' : '' }}">
                            Laporan Diri
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: User Account Dropdown -->
            <div class="hidden md:flex items-center gap-3">
                @if(Auth::user() && Auth::user()->isGuru())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm text-white font-bold rounded-full px-4 py-2 text-decoration-none" style="background-color: #3368A0;">
                        <i class="ti ti-dashboard me-1"></i> Admin Guru
                    </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-bold rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition shadow-sm">
                            <div class="rounded-circle text-white flex items-center justify-center me-2 font-bold" style="background-color: #3368A0; width: 30px; height: 30px; font-size: 0.8rem;">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </div>
                            <div class="me-1">{{ Auth::user()->name }}</div>
                            <i class="ti ti-chevron-down text-gray-400 ms-1"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="py-2.5">
                            <i class="ti ti-user me-2 text-primary"></i> {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger py-2.5">
                                <i class="ti ti-logout me-2"></i> {{ __('Keluar (Logout)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="ti ti-smart-home me-2"></i> Home / Dashboard
            </x-responsive-nav-link>
            
            @if(Auth::user() && Auth::user()->isSiswa())
                <x-responsive-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.*')">
                    <i class="ti ti-book me-2"></i> Courses / Materi
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')">
                    <i class="ti ti-pencil me-2"></i> Tugas Kelas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.quizzes.index')" :active="request()->routeIs('student.quizzes.*')">
                    <i class="ti ti-help-hexagon me-2"></i> Kuis Online
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.report.index')" :active="request()->routeIs('student.report.*')">
                    <i class="ti ti-chart-line me-2"></i> Laporan Diri
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-4 mb-2">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="ti ti-user me-2"></i> {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger">
                        <i class="ti ti-logout me-2"></i> {{ __('Keluar (Logout)') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
