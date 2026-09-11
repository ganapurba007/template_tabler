<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-0">
                <i class="ti ti-rocket text-primary me-2"></i>{{ __('Dashboard Siswa') }}
            </h2>
            <span class="badge rounded-pill text-white px-3 py-2" style="background-color: #3368A0;">
                <i class="ti ti-school me-1"></i> Kelas: {{ $user->schoolClass->name ?? 'Siswa' }}
            </span>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Webfonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <div class="py-6 px-3 px-md-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Hero Banner (Quizizz / Modern E-Learning Style) -->
            <div class="hero-banner-quizizz mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <span class="badge rounded-pill bg-white text-dark fw-bold px-3 py-2 mb-2 shadow-sm">
                            <i class="ti ti-sparkles text-warning me-1"></i> Halo, {{ $user->name }}!
                        </span>
                        <h1 class="display-6 fw-bold text-white mb-2">Siap Melanjutkan Pembelajaran Hari Ini?</h1>
                        <p class="text-white-50 fs-6 mb-3">Tingkatkan pemahaman materi, kerjakan tugas kelas, dan uji kemampuanmu lewat kuis interaktif!</p>
                        
                        <!-- Progress Indicator -->
                        <div class="bg-white bg-opacity-15 p-3 rounded-3 mb-3 border border-white border-opacity-25" style="backdrop-filter: blur(5px);">
                            <div class="d-flex justify-content-between align-items-center mb-1 text-white small fw-bold">
                                <span><i class="ti ti-chart-bar me-1"></i> Progress Materi Kelas</span>
                                <span>{{ $completedMaterialsCount }} / {{ $totalClassMaterials }} Selesai ({{ $overallProgress }}%)</span>
                            </div>
                            <div class="progress" style="height: 10px; background-color: rgba(255, 255, 255, 0.25);">
                                <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: {{ $overallProgress }}%;" aria-valuenow="{{ $overallProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('student.materials.index') }}" class="btn btn-quizizz-primary shadow-sm">
                                <i class="ti ti-book me-1"></i> Jelajahi Materi
                            </a>
                            <a href="{{ route('student.quizzes.index') }}" class="btn btn-light fw-bold text-dark shadow-sm">
                                <i class="ti ti-help-circle text-primary me-1"></i> Ikuti Kuis
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="p-4 rounded-4 text-white text-center" style="background: rgba(255, 255, 255, 0.1); border: 2px stroke rgba(255, 255, 255, 0.2);">
                            <i class="ti ti-trophy text-warning" style="font-size: 5rem;"></i>
                            <div class="fw-bold fs-5 mt-2">Level Pembelajar</div>
                            <div class="small text-white-50">Siswa Aktif LMS Dani</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quizizz-Style Metric Cards -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <div class="quizizz-card p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-1">Materi Tersedia</div>
                            <div class="h2 fw-bold text-dark mb-0">{{ $totalClassMaterials }}</div>
                            <div class="small text-muted">{{ $completedMaterialsCount }} Telah Dipelajari</div>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: #C8DFDB; width: 56px; height: 56px;">
                            <i class="ti ti-books text-dark fs-2"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="quizizz-card p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-1">Tugas Mendatang</div>
                            <div class="h2 fw-bold text-dark mb-0">{{ $upcomingAssignments->count() }}</div>
                            <div class="small text-muted">Perlu dikumpulkan</div>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(245, 159, 0, 0.2); width: 56px; height: 56px;">
                            <i class="ti ti-pencil text-warning fs-2"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="quizizz-card p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-1">Kuis Aktif</div>
                            <div class="h2 fw-bold text-dark mb-0">{{ $activeQuizzes->count() }}</div>
                            <div class="small text-muted">Siap Dikerjakan</div>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(102, 163, 191, 0.2); width: 56px; height: 56px;">
                            <i class="ti ti-help-hexagon text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quizizz Hub: Materials & Quizzes Grid -->
            <div class="row g-4">
                
                <!-- Latest Materials Card Grid -->
                <div class="col-lg-6">
                    <div class="quizizz-card p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <h5 class="fw-bold text-dark m-0 d-flex align-items-center">
                                <i class="ti ti-book-2 text-primary me-2 fs-3"></i> Materi Pembelajaran Terbaru
                            </h5>
                            <a href="{{ route('student.materials.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua <i class="ti ti-arrow-right"></i></a>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            @forelse($materials as $mat)
                                <div class="p-3 rounded-3 border bg-light d-flex align-items-center justify-content-between transition-hover" style="border-color: rgba(102, 163, 191, 0.2) !important;">
                                    <div>
                                        <span class="pill-primary-soft me-2">{{ $mat->subject->name ?? 'Umum' }}</span>
                                        <h6 class="fw-bold text-dark d-inline mb-0">{{ $mat->title }}</h6>
                                        <div class="small text-muted mt-1">Guru: {{ $mat->instructor->name ?? 'Pengajar' }}</div>
                                    </div>
                                    <a href="{{ route('student.materials.show', $mat) }}" class="btn btn-quizizz-primary btn-sm ms-2">
                                        Baca
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="ti ti-notes-off fs-1 text-secondary mb-2 d-block"></i>
                                    Belum ada materi untuk kelas Anda saat ini.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Active Quizzes & Assignments Grid -->
                <div class="col-lg-6">
                    <div class="quizizz-card p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <h5 class="fw-bold text-dark m-0 d-flex align-items-center">
                                <i class="ti ti-playstation-x text-warning me-2 fs-3"></i> Kuis & Ujian Aktif
                            </h5>
                            <a href="{{ route('student.quizzes.index') }}" class="text-decoration-none small fw-bold text-primary">Lihat Semua <i class="ti ti-arrow-right"></i></a>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            @forelse($activeQuizzes as $qz)
                                <div class="p-3 rounded-3 border bg-light d-flex align-items-center justify-content-between" style="border-color: rgba(245, 159, 0, 0.3) !important;">
                                    <div>
                                        <span class="pill-warning-soft me-2">{{ $qz->subject->name ?? 'Kuis' }}</span>
                                        <h6 class="fw-bold text-dark d-inline mb-0">{{ $qz->title }}</h6>
                                        <div class="small text-muted mt-1">
                                            <i class="ti ti-clock me-1"></i> {{ $qz->duration_minutes }} Menit | 
                                            <i class="ti ti-calendar me-1"></i> Deadline: {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                        </div>
                                    </div>
                                    <a href="{{ route('student.quizzes.show', $qz) }}" class="btn btn-warning text-dark fw-bold btn-sm ms-2 rounded-3">
                                        Mulai
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="ti ti-circle-check fs-1 text-success mb-2 d-block"></i>
                                    Tidak ada kuis aktif saat ini. Kerja bagus!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
