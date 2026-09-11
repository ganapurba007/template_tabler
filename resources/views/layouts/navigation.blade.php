<nav x-data="{ open: false }" class="bg-white border-b sticky-top shadow-sm" style="border-color: rgba(102, 163, 191, 0.2) !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left: Brand Logo & Links -->
            <div class="flex items-center space-x-6">
                <!-- Brand Logo (Udemy/Codepolitan style) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user() && Auth::user()->isGuru() ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2 text-decoration-none">
                        <div class="rounded-circle text-white flex items-center justify-center p-2" style="background-color: #3368A0; width: 38px; height: 38px;">
                            <i class="ti ti-school text-xl"></i>
                        </div>
                        <span class="font-extrabold text-xl tracking-tight" style="color: #3368A0;">LMS Dani</span>
                    </a>
                </div>

                <!-- Udemy Style Navigation Links -->
                <div class="hidden sm:flex space-x-6 items-center ms-4">
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold transition text-decoration-none px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-opacity-15 text-primary' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('dashboard') ? 'background-color: rgba(102, 163, 191, 0.15); color: #3368A0;' : '' }}">
                        <i class="ti ti-smart-home me-1"></i> Dashboard
                    </a>

                    @if(Auth::user() && Auth::user()->isSiswa())
                        <a href="{{ route('student.materials.index') }}" class="text-sm font-semibold transition text-decoration-none px-3 py-2 rounded-lg {{ request()->routeIs('student.materials.*') ? 'bg-opacity-15 text-primary' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('student.materials.*') ? 'background-color: rgba(102, 163, 191, 0.15); color: #3368A0;' : '' }}">
                            <i class="ti ti-book me-1"></i> Materi
                        </a>
                        <a href="{{ route('student.assignments.index') }}" class="text-sm font-semibold transition text-decoration-none px-3 py-2 rounded-lg {{ request()->routeIs('student.assignments.*') ? 'bg-opacity-15 text-primary' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('student.assignments.*') ? 'background-color: rgba(102, 163, 191, 0.15); color: #3368A0;' : '' }}">
                            <i class="ti ti-pencil me-1"></i> Tugas
                        </a>
                        <a href="{{ route('student.quizzes.index') }}" class="text-sm font-semibold transition text-decoration-none px-3 py-2 rounded-lg {{ request()->routeIs('student.quizzes.*') ? 'bg-opacity-15 text-primary' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('student.quizzes.*') ? 'background-color: rgba(102, 163, 191, 0.15); color: #3368A0;' : '' }}">
                            <i class="ti ti-help-circle me-1"></i> Kuis
                        </a>
                        <a href="{{ route('student.report.index') }}" class="text-sm font-semibold transition text-decoration-none px-3 py-2 rounded-lg {{ request()->routeIs('student.report.*') ? 'bg-opacity-15 text-primary' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('student.report.*') ? 'background-color: rgba(102, 163, 191, 0.15); color: #3368A0;' : '' }}">
                            <i class="ti ti-chart-line me-1"></i> Laporan
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: User Dropdown & Actions -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                
                @if(Auth::user() && Auth::user()->isGuru())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm text-white fw-bold px-3 py-2 rounded-3 text-decoration-none" style="background-color: #3368A0;">
                        <i class="ti ti-dashboard me-1"></i> Panel Admin Guru
                    </a>
                @endif

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-200 text-sm font-bold rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition">
                            <div class="rounded-circle text-white flex items-center justify-center me-2 font-bold" style="background-color: #66A3BF; width: 28px; height: 28px; font-size: 0.75rem;">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="ti ti-user me-2"></i> {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger">
                                <i class="ti ti-logout me-2"></i> {{ __('Keluar (Logout)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="ti ti-smart-home me-2"></i> Dashboard
            </x-responsive-nav-link>
            
            @if(Auth::user() && Auth::user()->isSiswa())
                <x-responsive-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.*')">
                    <i class="ti ti-book me-2"></i> Materi Pembelajaran
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')">
                    <i class="ti ti-pencil me-2"></i> Tugas Kelas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.quizzes.index')" :active="request()->routeIs('student.quizzes.*')">
                    <i class="ti ti-help-circle me-2"></i> Kuis & Ujian
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.report.index')" :active="request()->routeIs('student.report.*')">
                    <i class="ti ti-chart-line me-2"></i> Laporan Diri
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
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
