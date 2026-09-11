<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight m-0" style="font-family: 'Jost', sans-serif;">
                <i class="ti ti-rocket text-primary me-2"></i>{{ __('Dashboard Siswa') }}
            </h2>
            <span class="edusite-course-badge shadow-sm px-3 py-1 rounded-pill">
                <i class="ti ti-school me-1"></i> Kelas: {{ $user->schoolClass->name ?? 'Siswa' }}
            </span>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Webfonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <!-- Arsha Hero Section -->
    <section id="hero" class="arsha-hero mb-5" data-aos="zoom-out" data-aos-delay="100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 d-flex flex-column justify-content-center text-center text-lg-start">
                    <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm align-self-center align-self-lg-start" style="color: #3368A0 !important;">
                        <i class="ti ti-sparkles text-warning me-1"></i> Selamat Datang, {{ $user->name }}!
                    </span>
                    <h1 data-aos="fade-up" data-aos-delay="200">
                        Solusi Belajar Interaktif Terbaik Untuk Masa Depan SMA-mu!
                    </h1>
                    <p class="lead text-white-50 fs-5 mt-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                        Kami menghadirkan platform E-Learning modern untuk membantu siswa SMA mengakses modul materi lengkap, menyelesaikan tugas, dan menguji kemampuan lewat kuis online.
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start" data-aos="fade-up" data-aos-delay="400">
                        <a class="btn-edusite-main text-decoration-none shadow-lg px-4 py-3 rounded-pill text-white fw-bold" href="{{ route('student.materials.index') }}" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%);">
                            <i class="ti ti-rocket me-2"></i> Get Started / Mulai Belajar
                        </a>
                        <a class="btn-edusite-outline text-decoration-none px-4 py-3 rounded-pill fw-bold text-white d-inline-flex align-items-center" href="{{ route('student.quizzes.index') }}" style="border: 2px solid rgba(255,255,255,0.4); background: rgba(255,255,255,0.1); backdrop-filter: blur(5px);">
                            <i class="ti ti-player-play-filled me-2 text-warning fs-5"></i> Ikuti Kuis Online
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-end" data-aos="zoom-in" data-aos-delay="200">
                    <div class="position-relative d-inline-block">
                        <!-- Animated Floating SVG Graphic for Arsha SMA Hero -->
                        <svg class="img-fluid animated-float hero-svg-illustration" width="480" height="380" viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.15));">
                            <!-- Background Glow & Shapes -->
                            <circle cx="250" cy="200" r="180" fill="url(#hero-glow)" opacity="0.3"/>
                            <rect x="70" y="80" width="360" height="240" rx="24" fill="#ffffff" opacity="0.95" />
                            
                            <!-- Header Bar of Mockup Screen -->
                            <rect x="70" y="80" width="360" height="40" rx="24" fill="#3368A0" />
                            <circle cx="100" cy="100" r="6" fill="#FF5F56" />
                            <circle cx="118" cy="100" r="6" fill="#FFBD2E" />
                            <circle cx="136" cy="100" r="6" fill="#27C93F" />
                            <rect x="160" y="94" width="180" height="12" rx="6" fill="rgba(255,255,255,0.3)" />

                            <!-- Screen Contents: Charts & Cards -->
                            <rect x="95" y="140" width="140" height="70" rx="12" fill="#F2EFE7" />
                            <circle cx="120" cy="165" r="14" fill="#66A3BF" />
                            <rect x="142" y="155" width="75" height="8" rx="4" fill="#3368A0" />
                            <rect x="142" y="170" width="50" height="6" rx="3" fill="#A0C4D8" />

                            <rect x="250" y="140" width="165" height="70" rx="12" fill="#C8DFDB" />
                            <rect x="265" y="155" width="120" height="10" rx="5" fill="#3368A0" />
                            <rect x="265" y="172" width="80" height="8" rx="4" fill="#ffffff" />

                            <!-- Bottom Progress Bar -->
                            <rect x="95" y="230" width="320" height="60" rx="12" fill="#F8FAFC" stroke="#E2E8F0" stroke-width="2"/>
                            <rect x="115" y="245" width="180" height="10" rx="5" fill="#E2E8F0" />
                            <rect x="115" y="245" width="140" height="10" rx="5" fill="#66A3BF" />
                            <rect x="115" y="265" width="120" height="8" rx="4" fill="#CBD5E1" />

                            <!-- Floating Badges -->
                            <g class="animated-float" style="animation-duration: 4s;">
                                <rect x="30" y="190" width="110" height="48" rx="12" fill="#ffffff" shadow="0 8px 16px rgba(0,0,0,0.1)"/>
                                <circle cx="54" cy="214" r="12" fill="#10B981" />
                                <path d="M50 214L53 217L59 211" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <text x="74" y="218" fill="#1E293B" font-family="sans-serif" font-size="11" font-weight="bold">Nilai: 100</text>
                            </g>

                            <g class="animated-float" style="animation-duration: 5s; animation-delay: 1s;">
                                <rect x="340" y="40" width="120" height="52" rx="14" fill="#ffffff"/>
                                <circle cx="366" cy="66" r="14" fill="#3368A0" />
                                <text x="361" y="71" fill="white" font-family="sans-serif" font-size="14" font-weight="bold">SMA</text>
                                <text x="388" y="62" fill="#3368A0" font-family="sans-serif" font-size="11" font-weight="bold">LMS Dani</text>
                                <text x="388" y="74" fill="#64748B" font-family="sans-serif" font-size="9">Aktif 2026</text>
                            </g>

                            <defs>
                                <radialGradient id="hero-glow" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(250 200) rotate(90) scale(180)">
                                    <stop stop-color="#C8DFDB"/>
                                    <stop offset="1" stop-color="#66A3BF" stop-opacity="0"/>
                                </radialGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Arsha Features & Services Section -->
        <div class="mb-5">
            <div class="arsha-section-title text-center mb-5" data-aos="fade-up">
                <h2>SERVICES & FITUR UTAMA</h2>
                <p>Nikmati pengalaman belajar digital SMA terbaik dengan berbagai fitur modern dan interaktif</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="arsha-icon-box h-100">
                        <div class="icon-wrapper">
                            <i class="ti ti-book-2"></i>
                        </div>
                        <h4>Modul Interaktif</h4>
                        <p>Materi pembelajaran lengkap berupa WYSIWYG editor, link video YouTube embed, dan dokumen panduan yang fleksibel dipelajari.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="arsha-icon-box h-100">
                        <div class="icon-wrapper">
                            <i class="ti ti-pencil"></i>
                        </div>
                        <h4>Tugas Essay Online</h4>
                        <p>Kumpulkan jawaban tugas essay dengan praktis, dapatkan skor transparan, serta catatan feedback koreksi dari guru pengampu.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="arsha-icon-box h-100">
                        <div class="icon-wrapper">
                            <i class="ti ti-clock-play"></i>
                        </div>
                        <h4>Kuis Realtime</h4>
                        <p>Uji pemahaman lewat kuis pilihan ganda berbatas waktu (Vanilla JS countdown) dengan auto-submit dan review kunci jawaban.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="arsha-icon-box h-100">
                        <div class="icon-wrapper">
                            <i class="ti ti-chart-dots"></i>
                        </div>
                        <h4>Laporan Diri</h4>
                        <p>Pantau perkembangan akademik, statistik pengerjaan kuis, dan perolehan nilai kelasmu secara real-time dan terukur.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arsha Courses Catalog Section -->
        <div class="mb-5">
            <div class="arsha-section-title text-center mb-5" data-aos="fade-up">
                <h2>COURSES / MATERI PELAJARAN</h2>
                <p>Pilih materi pelajaran terbaru untuk kelasmu dan mulai belajar sekarang!</p>
            </div>

            <div class="row g-4">
                @forelse($materials as $mat)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="arsha-course-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="arsha-course-img">
                                    <span class="arsha-course-badge shadow-sm">
                                        <i class="ti ti-bookmark me-1"></i> {{ $mat->subject->name ?? 'Mata Pelajaran' }}
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h5 class="fw-bold text-dark mb-2" style="font-family: 'Jost', sans-serif; font-size: 1.25rem;">{{ $mat->title }}</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="ti ti-user me-1 text-primary"></i> Guru Pengampu: <strong class="text-dark">{{ $mat->instructor->name ?? 'Pengajar' }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <a href="{{ route('student.materials.show', $mat) }}" class="btn-edusite-main btn-sm w-100 text-center text-decoration-none rounded-pill py-2 shadow-sm d-inline-block">
                                    Mulai Pelajari <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="arsha-icon-box py-5 text-center text-muted">
                            <i class="ti ti-notes-off fs-1 text-secondary mb-2 d-block"></i>
                            <h5>Belum ada materi untuk kelas Anda saat ini.</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Arsha Counter Section Band -->
    <div class="arsha-counter-section my-5" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <div class="arsha-counter-number"><i class="ti ti-books me-2"></i>{{ $totalClassMaterials }}</div>
                    <div class="arsha-counter-label">Materi Pelajaran</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="arsha-counter-number"><i class="ti ti-circle-check me-2 text-success"></i>{{ $completedMaterialsCount }}</div>
                    <div class="arsha-counter-label">Materi Selesai</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="arsha-counter-number"><i class="ti ti-notebook me-2 text-warning"></i>{{ $upcomingAssignments->count() }}</div>
                    <div class="arsha-counter-label">Tugas Mendatang</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="arsha-counter-number"><i class="ti ti-help-hexagon me-2 text-info"></i>{{ $activeQuizzes->count() }}</div>
                    <div class="arsha-counter-label">Kuis Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Quizzes & Assignments Timeline Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-5">
        <div class="row g-4">
            
            <!-- Active Quizzes -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="arsha-icon-box p-4 text-start h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-family: 'Jost', sans-serif;">
                            <i class="ti ti-help-hexagon text-primary me-2 fs-3"></i> Kuis Online Aktif
                        </h4>
                        <a href="{{ route('student.quizzes.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua <i class="ti ti-chevron-right"></i></a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($activeQuizzes as $qz)
                            <div class="p-3 rounded-3 border bg-white shadow-sm d-flex align-items-center justify-content-between transition-all hover-shadow">
                                <div>
                                    <span class="badge text-white px-2 py-1 mb-1 me-2" style="background-color: #3368A0;">{{ $qz->subject->name ?? 'Kuis' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $qz->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-clock me-1 text-primary"></i> {{ $qz->duration_minutes }} Menit | 
                                        <i class="ti ti-calendar me-1 text-danger"></i> Deadline: {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                    </div>
                                </div>
                                <a href="{{ route('student.quizzes.show', $qz) }}" class="btn-edusite-main btn-sm px-4 py-2 text-decoration-none rounded-pill shadow-sm">
                                    Mulai Kuis
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="ti ti-circle-check fs-1 text-success mb-2 d-block"></i>
                                Tidak ada kuis aktif saat ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Upcoming Assignments -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="arsha-icon-box p-4 text-start h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-family: 'Jost', sans-serif;">
                            <i class="ti ti-notebook text-warning me-2 fs-3"></i> Tugas Perlu Dikumpulkan
                        </h4>
                        <a href="{{ route('student.assignments.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua <i class="ti ti-chevron-right"></i></a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($upcomingAssignments as $asg)
                            <div class="p-3 rounded-3 border bg-white shadow-sm d-flex align-items-center justify-content-between transition-all hover-shadow">
                                <div>
                                    <span class="badge bg-warning text-dark px-2 py-1 mb-1 me-2">{{ $asg->subject->name ?? 'Tugas' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $asg->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-calendar-event me-1 text-danger"></i> Deadline: <span class="fw-bold text-danger">{{ $asg->due_date ? $asg->due_date->format('d M H:i') : '-' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('student.assignments.show', $asg) }}" class="btn-edusite-main btn-sm px-4 py-2 text-decoration-none rounded-pill shadow-sm">
                                    Kerjakan
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="ti ti-mood-smile fs-1 text-primary mb-2 d-block"></i>
                                Semua tugas kelas sudah selesai dikumpulkan!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
