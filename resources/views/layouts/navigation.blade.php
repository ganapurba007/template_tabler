<nav x-data="{ open: false }" class="glass-nav sticky-top">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Left: Brand Logo & Links -->
            <div class="flex items-center space-x-6">
                <!-- Brand Logo (Udemy/Codepolitan Style) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user() && Auth::user()->isGuru() ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2.5 text-decoration-none">
                        <div class="rounded-2xl text-white flex items-center justify-center p-2 shadow-sm" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); width: 42px; height: 42px;">
                            <i class="ti ti-school text-2xl"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-2xl tracking-tight block" style="color: #3368A0; line-height: 1;">LMS Dani</span>
                            <span class="text-xs font-semibold text-gray-500 block">E-Learning Platform</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-2 items-center ms-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold transition text-decoration-none px-3.5 py-2.5 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}" style="{{ request()->routeIs('dashboard') ? 'background-color: #3368A0; color: #ffffff !important;' : '' }}">
                        <i class="ti ti-smart-home me-1"></i> Dashboard
                    </a>

                    @if(Auth::user() && Auth::user()->isSiswa())
                        <a href="{{ route('student.materials.index') }}" class="text-sm font-bold transition text-decoration-none px-3.5 py-2.5 rounded-xl {{ request()->routeIs('student.materials.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}" style="{{ request()->routeIs('student.materials.*') ? 'background-color: #3368A0; color: #ffffff !important;' : '' }}">
                            <i class="ti ti-book me-1"></i> Materi Pelajaran
                        </a>
                        <a href="{{ route('student.assignments.index') }}" class="text-sm font-bold transition text-decoration-none px-3.5 py-2.5 rounded-xl {{ request()->routeIs('student.assignments.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}" style="{{ request()->routeIs('student.assignments.*') ? 'background-color: #3368A0; color: #ffffff !important;' : '' }}">
                            <i class="ti ti-pencil me-1"></i> Tugas
                        </a>
                        <a href="{{ route('student.quizzes.index') }}" class="text-sm font-bold transition text-decoration-none px-3.5 py-2.5 rounded-xl {{ request()->routeIs('student.quizzes.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}" style="{{ request()->routeIs('student.quizzes.*') ? 'background-color: #3368A0; color: #ffffff !important;' : '' }}">
                            <i class="ti ti-help-hexagon me-1"></i> Kuis Evaluasi
                        </a>
                        <a href="{{ route('student.report.index') }}" class="text-sm font-bold transition text-decoration-none px-3.5 py-2.5 rounded-xl {{ request()->routeIs('student.report.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}" style="{{ request()->routeIs('student.report.*') ? 'background-color: #3368A0; color: #ffffff !important;' : '' }}">
                            <i class="ti ti-chart-line me-1"></i> Laporan Belajar
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: Search & Profile Dropdown -->
            <div class="hidden md:flex items-center gap-3">
                
                @if(Auth::user() && Auth::user()->isGuru())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-gradient-primary btn-sm text-decoration-none me-2">
                        <i class="ti ti-dashboard me-1"></i> Panel Guru / Admin
                    </a>
                @endif

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3.5 py-2 border border-gray-200 text-sm font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition shadow-sm">
                            <div class="rounded-circle text-white flex items-center justify-center me-2.5 font-extrabold avatar-ring" style="background: linear-gradient(135deg, #66A3BF 0%, #3368A0 100%); width: 32px; height: 32px; font-size: 0.8rem;">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </div>
                            <div class="text-start me-2">
                                <div class="leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-400 font-normal">{{ Auth::user()->role ? ucfirst(Auth::user()->role->name) : 'User' }}</div>
                            </div>
                            <i class="ti ti-chevron-down text-gray-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="py-2.5">
                            <i class="ti ti-user me-2 text-primary"></i> {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
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

            <!-- Hamburger Button (Mobile) -->
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

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="ti ti-smart-home me-2"></i> Dashboard
            </x-responsive-nav-link>
            
            @if(Auth::user() && Auth::user()->isSiswa())
                <x-responsive-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.*')">
                    <i class="ti ti-book me-2"></i> Materi Pelajaran
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')">
                    <i class="ti ti-pencil me-2"></i> Tugas Kelas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.quizzes.index')" :active="request()->routeIs('student.quizzes.*')">
                    <i class="ti ti-help-hexagon me-2"></i> Kuis Evaluasi
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.report.index')" :active="request()->routeIs('student.report.*')">
                    <i class="ti ti-chart-line me-2"></i> Laporan Belajar
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
