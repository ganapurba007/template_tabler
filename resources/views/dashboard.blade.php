<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight m-0">
                <i class="ti ti-rocket text-primary me-2"></i>{{ __('Dashboard Siswa') }}
            </h2>
            <span class="edusite-course-badge">
                <i class="ti ti-school me-1"></i> Kelas: {{ $user->schoolClass->name ?? 'Siswa' }}
            </span>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Webfonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <!-- Edusite Hero Area -->
    <div class="edusite-hero mb-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm" style="color: #1e3a8a !important;">
                        <i class="ti ti-sparkles text-warning me-1"></i> Selamat Datang, {{ $user->name }}!
                    </span>
                    <h1>Portal Pembelajaran Online LMS Dani</h1>
                    <p class="lead text-white-50 fs-5 mt-3 mb-4">
                        Akses modul materi pelajaran interaktif, selesaikan tugas tepat waktu, dan ukur pemahamanmu melalui evaluasi kuis online.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a class="btn-edusite-main text-decoration-none" href="{{ route('student.materials.index') }}">
                            <i class="ti ti-player-play me-1"></i> Get Started! / Mulai Belajar
                        </a>
                        <a class="btn-edusite-outline text-decoration-none" href="{{ route('student.quizzes.index') }}">
                            <i class="ti ti-help-circle me-1"></i> Ikuti Kuis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Edusite About / Why Choose Us Section (3 Feature Cards) -->
        <div class="mb-5">
            <div class="edusite-section-header">
                <h2>Mengapa Belajar di LMS Dani?</h2>
                <p class="text-muted fs-6 mt-2">Platform E-Learning yang dirancang untuk pengalaman belajar modern dan efektif</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="edusite-feature-card">
                        <div class="edusite-feature-icon">
                            <i class="ti ti-book-2"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Modul Materi Interaktif</h4>
                        <p class="text-muted small">Materi pembelajaran lengkap berupa artikel WYSIWYG, link video YouTube embed, dan dokumen panduan yang dapat dipelajari kapan saja.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="edusite-feature-card">
                        <div class="edusite-feature-icon">
                            <i class="ti ti-pencil"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Pengumpulan Tugas Praktis</h4>
                        <p class="text-muted small">Kumpulkan jawaban tugas essay dengan mudah, dapatkan skor nilai transparan serta umpan balik (feedback) dari pengajar.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="edusite-feature-card">
                        <div class="edusite-feature-icon">
                            <i class="ti ti-help-hexagon"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Evaluasi Kuis Realtime</h4>
                        <p class="text-muted small">Uji pemahaman lewat kuis online berbatas waktu (Vanilla JS countdown timer) dengan sistem auto-submit dan review hasil per soal.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edusite Courses Catalog Section -->
        <div class="mb-5">
            <div class="edusite-section-header">
                <h2>Courses / Materi Pelajaran</h2>
                <p class="text-muted fs-6 mt-2">Pilih materi terbaru dari pengajar untuk kelasmu</p>
            </div>

            <div class="row g-4">
                @forelse($materials as $mat)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="edusite-course-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="edusite-course-img">
                                    <span class="edusite-course-badge shadow-sm">
                                        {{ $mat->subject->name ?? 'Mata Pelajaran' }}
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h5 class="fw-bold text-dark mb-2">{{ $mat->title }}</h5>
                                    <p class="text-muted small mb-3">Guru Pengampu: <strong class="text-dark">{{ $mat->instructor->name ?? 'Pengajar' }}</strong></p>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <a href="{{ route('student.materials.show', $mat) }}" class="btn btn-edusite-main btn-sm w-100 text-center text-decoration-none">
                                    Mulai Pelajari <i class="ti ti-arrow-right me-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="edusite-feature-card py-5 text-center text-muted">
                            <i class="ti ti-notes-off fs-1 text-secondary mb-2 d-block"></i>
                            <h5>Belum ada materi untuk kelas Anda saat ini.</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Edusite Counter Band Section -->
    <div class="edusite-counter-band">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <div class="edusite-counter-number">{{ $totalClassMaterials }}</div>
                    <div class="edusite-counter-label">Materi Pelajaran</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="edusite-counter-number">{{ $completedMaterialsCount }}</div>
                    <div class="edusite-counter-label">Materi Selesai</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="edusite-counter-number">{{ $upcomingAssignments->count() }}</div>
                    <div class="edusite-counter-label">Tugas Mendatang</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="edusite-counter-number">{{ $activeQuizzes->count() }}</div>
                    <div class="edusite-counter-label">Kuis Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Quizzes & Assignments Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-5">
        <div class="row g-4">
            
            <!-- Active Quizzes -->
            <div class="col-lg-6">
                <div class="edusite-feature-card p-4 text-start h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center">
                            <i class="ti ti-help-hexagon text-primary me-2"></i> Kuis Online Aktif
                        </h4>
                        <a href="{{ route('student.quizzes.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua</a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($activeQuizzes as $qz)
                            <div class="p-3 rounded-3 border bg-light d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="badge bg-primary text-white px-2 py-1 mb-1 me-2">{{ $qz->subject->name ?? 'Kuis' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $qz->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-clock me-1"></i> {{ $qz->duration_minutes }} Menit | 
                                        <i class="ti ti-calendar me-1"></i> Deadline: {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                    </div>
                                </div>
                                <a href="{{ route('student.quizzes.show', $qz) }}" class="btn btn-edusite-main btn-sm px-3 py-1 text-decoration-none">
                                    Mulai
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
            <div class="col-lg-6">
                <div class="edusite-feature-card p-4 text-start h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center">
                            <i class="ti ti-notebook text-warning me-2"></i> Tugas Perlu Dikumpulkan
                        </h4>
                        <a href="{{ route('student.assignments.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua</a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($upcomingAssignments as $asg)
                            <div class="p-3 rounded-3 border bg-light d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="badge bg-warning text-dark px-2 py-1 mb-1 me-2">{{ $asg->subject->name ?? 'Tugas' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $asg->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-calendar-event me-1"></i> Deadline: <span class="fw-bold text-danger">{{ $asg->due_date ? $asg->due_date->format('d M H:i') : '-' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('student.assignments.show', $asg) }}" class="btn btn-edusite-main btn-sm px-3 py-1 text-decoration-none">
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
