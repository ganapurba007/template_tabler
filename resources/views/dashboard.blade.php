<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight m-0">
                <i class="ti ti-rocket text-primary me-2"></i>{{ __('Dashboard Siswa') }}
            </h2>
            <span class="badge-glow-mint px-3 py-2">
                <i class="ti ti-school me-1"></i> Kelas: {{ $user->schoolClass->name ?? 'Siswa' }}
            </span>
        </div>
    </x-slot>

    <!-- Include Webfonts & Theme Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <div class="py-6 px-3 px-md-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Hero Banner 3D Gradient (Udemy / Codepolitan Premium Style) -->
            <div class="hero-gradient-modern mb-5">
                <div class="row align-items-center position-relative z-1">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-white text-dark fw-extrabold px-3 py-2 rounded-pill shadow-sm" style="color: #1e3a8a !important;">
                                <i class="ti ti-sparkles text-warning me-1"></i> Selamat Datang, {{ $user->name }}!
                            </span>
                            <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill shadow-sm">
                                🔥 5 Hari Learning Streak
                            </span>
                        </div>
                        
                        <h1 class="display-5 fw-extrabold text-white mb-3">Kuasai Pengetahuan Baru Hari Ini</h1>
                        <p class="text-white-50 fs-5 mb-4">Akses materi pelajaran interaktif, selesaikan tugas tepat waktu, dan ukur pemahamanmu melalui evaluasi kuis online.</p>

                        <!-- Glassmorphism Learning Progress Ring Widget -->
                        <div class="p-3 rounded-4 mb-4" style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.25);">
                            <div class="d-flex justify-content-between align-items-center mb-2 text-white small font-bold">
                                <span><i class="ti ti-chart-pie me-1"></i> Progress Pembelajaran Kelas</span>
                                <span class="badge bg-white text-dark rounded-pill px-2.5 py-1">{{ $completedMaterialsCount }} / {{ $totalClassMaterials }} Selesai ({{ $overallProgress }}%)</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 12px; background-color: rgba(255, 255, 255, 0.25);">
                                <div class="progress-bar bg-warning rounded-pill progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $overallProgress }}%;" aria-valuenow="{{ $overallProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('student.materials.index') }}" class="btn btn-gradient-warning btn-lg">
                                <i class="ti ti-player-play me-1"></i> Lanjutkan Belajar
                            </a>
                            <a href="{{ route('student.quizzes.index') }}" class="btn btn-light btn-lg fw-bold text-dark shadow-sm rounded-4">
                                <i class="ti ti-help-circle text-primary me-1"></i> Mulai Kuis Evaluasi
                            </a>
                        </div>
                    </div>

                    <!-- Right Illustration / Trophy Widget -->
                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <div class="p-4 rounded-4 text-white text-center glass-card border-0" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(16px);">
                            <div class="rounded-circle bg-white bg-opacity-20 d-inline-flex p-4 mb-3">
                                <i class="ti ti-trophy text-warning" style="font-size: 5.5rem;"></i>
                            </div>
                            <h4 class="fw-extrabold text-white mb-1">Level Pembelajar</h4>
                            <p class="text-white-50 small mb-0">Siswa Aktif {{ $user->schoolClass->name ?? 'LMS Dani' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Metric Cards Grid (Non-Flat Glassmorphic Cards) -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-md-4">
                    <div class="course-card-modern p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge-glow-mint mb-2 d-inline-block">MODUL PELAJARAN</span>
                            <div class="display-6 fw-extrabold text-dark mb-1">{{ $totalClassMaterials }}</div>
                            <div class="text-muted small font-semibold">{{ $completedMaterialsCount }} Telah Selesai Dipelajari</div>
                        </div>
                        <div class="rounded-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="background: linear-gradient(135deg, #C8DFDB 0%, #94b9b0 100%); width: 64px; height: 64px;">
                            <i class="ti ti-books text-dark fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="course-card-modern p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge-glow-warning mb-2 d-inline-block">TUGAS TERSEDIA</span>
                            <div class="display-6 fw-extrabold text-dark mb-1">{{ $upcomingAssignments->count() }}</div>
                            <div class="text-muted small font-semibold">Tugas perlu dikumpulkan</div>
                        </div>
                        <div class="rounded-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="background: linear-gradient(135deg, #fef3c7 0%, #f59e0b 100%); width: 64px; height: 64px;">
                            <i class="ti ti-pencil text-dark fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="course-card-modern p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge-glow-primary mb-2 d-inline-block">KUIS EVALUASI</span>
                            <div class="display-6 fw-extrabold text-dark mb-1">{{ $activeQuizzes->count() }}</div>
                            <div class="text-muted small font-semibold">Kuis Aktif Siap Dikerjakan</div>
                        </div>
                        <div class="rounded-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="background: linear-gradient(135deg, #66A3BF 0%, #3368A0 100%); width: 64px; height: 64px;">
                            <i class="ti ti-help-hexagon text-white fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Udemy/Codepolitan Course Catalog Grid -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fw-extrabold text-dark mb-1">📚 Materi Pelajaran Terbaru</h3>
                        <p class="text-muted small mb-0">Pilih modul pembelajaran terbaru untuk memperdalam wawasanmu.</p>
                    </div>
                    <a href="{{ route('student.materials.index') }}" class="btn btn-outline-primary fw-bold rounded-pill px-4">
                        Lihat Semua Katalog <i class="ti ti-arrow-right me-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @forelse($materials as $mat)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="course-card-modern h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <!-- Course Card Header Cover -->
                                    <div class="course-cover-gradient">
                                        <span class="badge bg-white text-dark fw-bold rounded-pill px-3 py-1 shadow-sm">
                                            {{ $mat->subject->name ?? 'Mata Pelajaran' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Course Body -->
                                    <div class="p-4">
                                        <h5 class="fw-extrabold text-dark mb-2 line-clamp-2" style="min-height: 48px;">{{ $mat->title }}</h5>
                                        
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center font-bold" style="width: 28px; height: 28px; font-size: 0.75rem; background-color: #3368A0 !important;">
                                                {{ strtoupper(substr($mat->instructor->name ?? 'G', 0, 2)) }}
                                            </div>
                                            <span class="small text-muted font-semibold">{{ $mat->instructor->name ?? 'Pengajar' }}</span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between text-muted small pt-2 border-top">
                                            <span><i class="ti ti-file-text me-1"></i> Modul Terintegrasi</span>
                                            <span class="text-success font-bold"><i class="ti ti-circle-check me-1"></i> Siap Dibaca</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Course Action Footer -->
                                <div class="p-4 pt-0">
                                    <a href="{{ route('student.materials.show', $mat) }}" class="btn btn-gradient-primary w-100 text-center">
                                        Mulai Pelajari <i class="ti ti-player-play me-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="course-card-modern p-5 text-center text-muted">
                                <i class="ti ti-notes-off display-4 text-secondary mb-3 d-block"></i>
                                <h5>Belum ada materi untuk kelas Anda saat ini.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Active Quizzes & Timeline Grid -->
            <div class="row g-4">
                
                <!-- Quizzes Section -->
                <div class="col-lg-6">
                    <div class="course-card-modern p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                            <h4 class="fw-extrabold text-dark m-0 d-flex align-items-center">
                                <i class="ti ti-help-hexagon text-warning me-2 fs-2"></i> Kuis Evaluasi Aktif
                            </h4>
                            <a href="{{ route('student.quizzes.index') }}" class="text-decoration-none small font-bold text-primary">Lihat Semua</a>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            @forelse($activeQuizzes as $qz)
                                <div class="p-3 rounded-4 border bg-white shadow-sm d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="badge-glow-warning mb-1 d-inline-block">{{ $qz->subject->name ?? 'Kuis' }}</span>
                                        <h6 class="fw-extrabold text-dark mb-1">{{ $qz->title }}</h6>
                                        <div class="small text-muted">
                                            <i class="ti ti-clock me-1"></i> {{ $qz->duration_minutes }} Menit | 
                                            <i class="ti ti-calendar me-1"></i> {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                        </div>
                                    </div>
                                    <a href="{{ route('student.quizzes.show', $qz) }}" class="btn btn-gradient-warning btn-sm ms-2 px-3 py-2">
                                        Mulai
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="ti ti-circle-check display-5 text-success mb-2 d-block"></i>
                                    Tidak ada kuis aktif saat ini.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Upcoming Assignments Section -->
                <div class="col-lg-6">
                    <div class="course-card-modern p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                            <h4 class="fw-extrabold text-dark m-0 d-flex align-items-center">
                                <i class="ti ti-notebook text-primary me-2 fs-2"></i> Tugas Perlu Dikumpulkan
                            </h4>
                            <a href="{{ route('student.assignments.index') }}" class="text-decoration-none small font-bold text-primary">Lihat Semua</a>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            @forelse($upcomingAssignments as $asg)
                                <div class="p-3 rounded-4 border bg-white shadow-sm d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="badge-glow-primary mb-1 d-inline-block">{{ $asg->subject->name ?? 'Tugas' }}</span>
                                        <h6 class="fw-extrabold text-dark mb-1">{{ $asg->title }}</h6>
                                        <div class="small text-muted">
                                            <i class="ti ti-calendar-event me-1"></i> Deadline: <span class="fw-bold text-danger">{{ $asg->due_date ? $asg->due_date->format('d M H:i') : '-' }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('student.assignments.show', $asg) }}" class="btn btn-gradient-primary btn-sm ms-2 px-3 py-2">
                                        Kerjakan
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="ti ti-mood-smile display-5 text-primary mb-2 d-block"></i>
                                    Semua tugas kelas sudah selesai dikumpulkan!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
