<x-app-layout>
    <!-- Include Bootstrap & Webfonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <!-- Arsha Hero Section with Real High-Res Learning Photo (Attaches directly under top navbar) -->
    <section id="hero" class="arsha-hero py-5" data-aos="zoom-out" data-aos-delay="100" style="background: linear-gradient(135deg, #3368A0 0%, #20456E 100%); margin-top: 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 d-flex flex-column justify-content-center text-center text-lg-start">
                    <div class="mb-3" data-aos="fade-up" data-aos-delay="150">
                        <span class="badge text-primary font-bold px-3.5 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #F2EFE7; color: #3368A0 !important; font-size: 0.85rem;">
                            <i class="ti ti-rocket text-warning"></i> Dashboard Siswa — Kelas {{ $user->schoolClass->name ?? 'Siswa SMA' }}
                        </span>
                    </div>
                    
                    <h1 class="text-white fw-extrabold display-5 mb-3" style="font-family: 'Jost', sans-serif; line-height: 1.2;" data-aos="fade-up" data-aos-delay="200">
                        Solusi Belajar Interaktif Terbaik Untuk Masa Depan SMA-mu!
                    </h1>
                    
                    <p class="lead text-white-50 fs-5 mb-4" data-aos="fade-up" data-aos-delay="300">
                        Selamat datang kembali, <strong>{{ $user->name }}</strong>! Akses modul materi pelajaran terlengkap, kerjakan tugas online, dan uji pemahamanmu melalui kuis real-time.
                    </p>

                    <!-- Quick Search Bar inside Hero -->
                    <div class="p-2 rounded-pill shadow-lg mb-4 d-flex align-items-center max-w-lg mx-auto mx-lg-0 border" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.3) !important;" data-aos="fade-up" data-aos-delay="350">
                        <i class="ti ti-search text-muted fs-4 ms-3 me-2"></i>
                        <input type="text" class="form-borderless form-control shadow-none bg-transparent text-dark" placeholder="Cari modul materi, tugas, atau kuis..." style="border: none;">
                        <a href="{{ route('student.materials.index') }}" class="btn text-white rounded-pill px-4 py-2 font-bold shrink-0 text-decoration-none" style="background-color: #3368A0;">
                            Cari <i class="ti ti-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start" data-aos="fade-up" data-aos-delay="400">
                        <a class="btn text-white font-bold px-4 py-3 rounded-pill text-decoration-none shadow-lg d-inline-flex align-items-center gap-2 hover-lift" href="{{ route('student.materials.index') }}" style="background: linear-gradient(135deg, #66A3BF 0%, #3368A0 100%);">
                            <i class="ti ti-player-play-filled fs-5 text-warning"></i> Mulai Belajar Sekarang
                        </a>
                        <a class="btn text-white font-bold px-4 py-3 rounded-pill text-decoration-none d-inline-flex align-items-center gap-2 hover-lift" href="{{ route('student.quizzes.index') }}" style="border: 2px solid rgba(255,255,255,0.4); background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);">
                            <i class="ti ti-help-hexagon fs-5"></i> Ikuti Kuis Online
                        </a>
                    </div>
                </div>

                <!-- Right Column: Real Learning Image with Floating Badges -->
                <div class="col-lg-6 text-center text-lg-end" data-aos="zoom-in" data-aos-delay="200">
                    <div class="position-relative d-inline-block">
                        <!-- High Quality SMA Learning Image -->
                        <img src="{{ asset('images/hero-sma.jpg') }}" alt="Siswa SMA Belajar Interaktif" class="img-fluid rounded-4 shadow-2xl border-4" style="border-color: #F2EFE7; max-height: 380px; object-fit: cover; width: 100%;">
                        
                        <!-- Floating Glassmorphism Badge 1: Top Right -->
                        <div class="position-absolute top-0 end-0 translate-middle-y me-n3 p-3 rounded-3 shadow-lg d-flex align-items-center gap-3 border" style="background-color: #F2EFE7; max-width: 220px; text-align: left; border-color: rgba(102, 163, 191, 0.3) !important;" data-aos="fade-left" data-aos-delay="500">
                            <div class="rounded-circle text-white flex items-center justify-center p-2 shrink-0" style="background-color: #10B981; width: 40px; height: 40px;">
                                <i class="ti ti-circle-check fs-4"></i>
                            </div>
                            <div>
                                <div class="font-bold text-dark text-xs">Materi Interaktif</div>
                                <div class="text-muted small" style="font-size: 0.72rem;">WYSIWYG & YouTube</div>
                            </div>
                        </div>

                        <!-- Floating Glassmorphism Badge 2: Bottom Left -->
                        <div class="position-absolute bottom-0 start-0 translate-middle-y ms-n3 p-3 rounded-3 shadow-lg d-flex align-items-center gap-3 border" style="background-color: #F2EFE7; max-width: 230px; text-align: left; border-color: rgba(102, 163, 191, 0.3) !important;" data-aos="fade-right" data-aos-delay="600">
                            <div class="rounded-circle text-white flex items-center justify-center p-2 shrink-0" style="background-color: #3368A0; width: 40px; height: 40px;">
                                <i class="ti ti-award fs-4 text-warning"></i>
                            </div>
                            <div>
                                <div class="font-bold text-dark text-xs">Kuis Real-Time</div>
                                <div class="text-muted small" style="font-size: 0.72rem;">Timer & Review Skor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern & Dynamic Interactive Statistics Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5" data-aos="fade-up">
        <!-- Section Header Bar -->
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 pb-2 border-bottom" style="border-color: rgba(102, 163, 191, 0.25) !important;">
            <div>
                <span class="badge rounded-pill text-primary px-3 py-1.5 font-bold uppercase tracking-wider text-xs mb-1 d-inline-flex align-items-center gap-1.5" style="background: rgba(102, 163, 191, 0.15); color: #3368A0 !important;">
                    <i class="ti ti-chart-dots text-primary"></i> Live Analytics
                </span>
                <h3 class="fw-extrabold text-dark m-0 d-flex align-items-center gap-2" style="font-family: 'Jost', sans-serif;">
                    Ringkasan Progres Belajar Saya
                </h3>
            </div>
            <div class="text-muted small mt-2 mt-md-0 d-flex align-items-center gap-2">
                <i class="ti ti-reload text-primary"></i> Data Diperbarui Otomatis
            </div>
        </div>

        <div class="row g-4">
            <!-- Stat Card 1: Total Materi Pelajaran -->
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-lift position-relative overflow-hidden" style="background-color: #F2EFE7; border: 1px solid rgba(102, 163, 191, 0.3) !important;">
                    <!-- Top Accent Color Bar -->
                    <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #3368A0, #66A3BF);"></div>
                    <!-- Giant Watermark Background Icon -->
                    <i class="ti ti-books position-absolute bottom-0 end-0 me-n2 mb-n3 text-primary opacity-10 pointer-events-none" style="font-size: 6.5rem; color: #3368A0 !important;"></i>
                    
                    <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="rounded-4 d-flex align-items-center justify-content-center text-white shadow-sm" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); width: 52px; height: 52px; box-shadow: 0 8px 18px rgba(51, 104, 160, 0.3) !important;">
                                <i class="ti ti-books fs-2"></i>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 text-primary fw-bold small" style="background: rgba(51, 104, 160, 0.12);">
                                <i class="ti ti-category me-1"></i> All Subject
                            </span>
                        </div>

                        <div>
                            <div class="d-flex align-items-baseline gap-2 mb-1">
                                <span class="display-5 fw-extrabold text-dark" style="font-family: 'Jost', sans-serif;">{{ $totalClassMaterials }}</span>
                                <span class="text-muted small fw-semibold">Modul</span>
                            </div>
                            <div class="fw-bold text-secondary text-uppercase tracking-wider mb-3" style="font-size: 0.78rem;">Total Materi Pelajaran</div>
                            
                            <div class="progress rounded-pill" style="height: 6px; background: rgba(51, 104, 160, 0.15);">
                                <div class="progress-bar rounded-pill" style="width: 100%; background: linear-gradient(90deg, #3368A0, #66A3BF);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card 2: Materi Selesai -->
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-lift position-relative overflow-hidden" style="background-color: #F2EFE7; border: 1px solid rgba(16, 185, 129, 0.3) !important;">
                    <!-- Top Accent Color Bar -->
                    <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #10B981, #34D399);"></div>
                    <!-- Giant Watermark Background Icon -->
                    <i class="ti ti-circle-check position-absolute bottom-0 end-0 me-n2 mb-n3 text-success opacity-10 pointer-events-none" style="font-size: 6.5rem;"></i>

                    <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="rounded-4 d-flex align-items-center justify-content-center text-white shadow-sm pulse-glow" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); width: 52px; height: 52px; box-shadow: 0 8px 18px rgba(16, 185, 129, 0.3) !important;">
                                <i class="ti ti-circle-check fs-2"></i>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 text-success fw-bold small" style="background: rgba(16, 185, 129, 0.15);">
                                <i class="ti ti-trending-up me-1"></i> {{ $totalClassMaterials > 0 ? min(100, round(($completedMaterialsCount / $totalClassMaterials) * 100)) : 0 }}% Selesai
                            </span>
                        </div>

                        <div>
                            <div class="d-flex align-items-baseline gap-2 mb-1">
                                <span class="display-5 fw-extrabold text-dark" style="font-family: 'Jost', sans-serif;">{{ $completedMaterialsCount }}</span>
                                <span class="text-muted small fw-semibold">/ {{ $totalClassMaterials }} Modul</span>
                            </div>
                            <div class="fw-bold text-secondary text-uppercase tracking-wider mb-3" style="font-size: 0.78rem;">Materi Telah Dipelajari</div>
                            
                            <div class="progress rounded-pill" style="height: 6px; background: rgba(16, 185, 129, 0.15);">
                                <div class="progress-bar rounded-pill" style="width: {{ $totalClassMaterials > 0 ? min(100, round(($completedMaterialsCount / $totalClassMaterials) * 100)) : 0 }}%; background: linear-gradient(90deg, #10B981, #34D399);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card 3: Tugas Perlu Dikumpulkan -->
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-lift position-relative overflow-hidden" style="background-color: #F2EFE7; border: 1px solid rgba(245, 158, 11, 0.3) !important;">
                    <!-- Top Accent Color Bar -->
                    <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #F59E0B, #FBBF24);"></div>
                    <!-- Giant Watermark Background Icon -->
                    <i class="ti ti-notebook position-absolute bottom-0 end-0 me-n2 mb-n3 text-warning opacity-10 pointer-events-none" style="font-size: 6.5rem;"></i>

                    <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="rounded-4 d-flex align-items-center justify-content-center text-white shadow-sm" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); width: 52px; height: 52px; box-shadow: 0 8px 18px rgba(245, 158, 11, 0.3) !important;">
                                <i class="ti ti-notebook fs-2"></i>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 text-warning-emphasis fw-bold small" style="background: rgba(245, 158, 11, 0.15);">
                                <i class="ti ti-clock me-1"></i> {{ $upcomingAssignments->count() > 0 ? 'Perlu Dikirim' : 'Tuntas' }}
                            </span>
                        </div>

                        <div>
                            <div class="d-flex align-items-baseline gap-2 mb-1">
                                <span class="display-5 fw-extrabold text-dark" style="font-family: 'Jost', sans-serif;">{{ $upcomingAssignments->count() }}</span>
                                <span class="text-muted small fw-semibold">Tugas</span>
                            </div>
                            <div class="fw-bold text-secondary text-uppercase tracking-wider mb-3" style="font-size: 0.78rem;">Tugas Perlu Dikumpulkan</div>
                            
                            <div class="progress rounded-pill" style="height: 6px; background: rgba(245, 158, 11, 0.15);">
                                <div class="progress-bar rounded-pill" style="width: {{ $upcomingAssignments->count() > 0 ? '75%' : '100%' }}; background: linear-gradient(90deg, #F59E0B, #FBBF24);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card 4: Kuis Online Aktif -->
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-lift position-relative overflow-hidden" style="background-color: #F2EFE7; border: 1px solid rgba(139, 92, 246, 0.3) !important;">
                    <!-- Top Accent Color Bar -->
                    <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #8B5CF6, #A78BFA);"></div>
                    <!-- Giant Watermark Background Icon -->
                    <i class="ti ti-help-hexagon position-absolute bottom-0 end-0 me-n2 mb-n3 text-purple opacity-10 pointer-events-none" style="font-size: 6.5rem; color: #8B5CF6 !important;"></i>

                    <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="rounded-4 d-flex align-items-center justify-content-center text-white shadow-sm" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%); width: 52px; height: 52px; box-shadow: 0 8px 18px rgba(139, 92, 246, 0.3) !important;">
                                <i class="ti ti-help-hexagon fs-2"></i>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 fw-bold small" style="background: rgba(139, 92, 246, 0.15); color: #7c3aed;">
                                <i class="ti ti-point-filled text-danger me-1"></i> Live Test
                            </span>
                        </div>

                        <div>
                            <div class="d-flex align-items-baseline gap-2 mb-1">
                                <span class="display-5 fw-extrabold text-dark" style="font-family: 'Jost', sans-serif;">{{ $activeQuizzes->count() }}</span>
                                <span class="text-muted small fw-semibold">Evaluasi</span>
                            </div>
                            <div class="fw-bold text-secondary text-uppercase tracking-wider mb-3" style="font-size: 0.78rem;">Kuis Online Aktif</div>
                            
                            <div class="progress rounded-pill" style="height: 6px; background: rgba(139, 92, 246, 0.15);">
                                <div class="progress-bar rounded-pill" style="width: {{ $activeQuizzes->count() > 0 ? '90%' : '100%' }}; background: linear-gradient(90deg, #8B5CF6, #A78BFA);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Interactive Subject Filter Bar (Ramai tapi Clean) -->
        <div class="mb-5" data-aos="fade-up">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold text-dark m-0 d-flex align-items-center gap-2" style="font-family: 'Jost', sans-serif;">
                    <i class="ti ti-category text-primary fs-4"></i> Pilih Mata Pelajaran Populer
                </h5>
                <span class="text-muted small">Akses cepat materi per bidang ilmu</span>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('student.materials.index') }}" class="btn btn-primary rounded-pill px-4 py-2 font-bold shadow-sm d-inline-flex align-items-center gap-2 text-decoration-none">
                    <i class="ti ti-layout-grid fs-5"></i> Semua Mapel
                </a>
                <a href="{{ route('student.materials.index') }}" class="btn text-dark border hover-shadow rounded-pill px-4 py-2 font-semibold d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #F2EFE7;">
                    <i class="ti ti-calculator text-danger fs-5"></i> Matematika
                </a>
                <a href="{{ route('student.materials.index') }}" class="btn text-dark border hover-shadow rounded-pill px-4 py-2 font-semibold d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #F2EFE7;">
                    <i class="ti ti-atom text-info fs-5"></i> Fisika & IPA
                </a>
                <a href="{{ route('student.materials.index') }}" class="btn text-dark border hover-shadow rounded-pill px-4 py-2 font-semibold d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #F2EFE7;">
                    <i class="ti ti-dna text-success fs-5"></i> Biologi
                </a>
                <a href="{{ route('student.materials.index') }}" class="btn text-dark border hover-shadow rounded-pill px-4 py-2 font-semibold d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #F2EFE7;">
                    <i class="ti ti-language text-purple fs-5" style="color: #8b5cf6;"></i> Bahasa Inggris
                </a>
                <a href="{{ route('student.materials.index') }}" class="btn text-dark border hover-shadow rounded-pill px-4 py-2 font-semibold d-inline-flex align-items-center gap-2 text-decoration-none" style="background-color: #F2EFE7;">
                    <i class="ti ti-device-laptop text-warning fs-5"></i> Informatika & TIK
                </a>
            </div>
        </div>

        <!-- Arsha Features & Services Section (4 Cards) -->
        <div class="mb-5">
            <div class="arsha-section-title text-center mb-5" data-aos="fade-up">
                <h2>FITUR & FASILITAS PEMBELAJARAN</h2>
                <p>Nikmati pengalaman belajar digital SMA terbaik dengan berbagai fasilitas interaktif pilihan kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="arsha-icon-box h-100 p-4 border rounded-4 shadow-sm hover-shadow transition-all text-center" style="background-color: #F2EFE7;">
                        <div class="icon-wrapper mx-auto mb-3 text-white rounded-circle flex items-center justify-center p-3 shadow" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); width: 60px; height: 60px;">
                            <i class="ti ti-book-2 fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2" style="font-family: 'Jost', sans-serif;">Modul Interaktif</h5>
                        <p class="text-muted small">Materi pembelajaran lengkap berupa artikel WYSIWYG, link video YouTube embed, dan dokumen PDF panduan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="arsha-icon-box h-100 p-4 border rounded-4 shadow-sm hover-shadow transition-all text-center" style="background-color: #F2EFE7;">
                        <div class="icon-wrapper mx-auto mb-3 text-white rounded-circle flex items-center justify-center p-3 shadow" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); width: 60px; height: 60px;">
                            <i class="ti ti-pencil fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2" style="font-family: 'Jost', sans-serif;">Tugas Essay Online</h5>
                        <p class="text-muted small">Kumpulkan jawaban tugas essay dengan praktis, dapatkan skor transparan, serta catatan feedback dari guru.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="arsha-icon-box h-100 p-4 border rounded-4 shadow-sm hover-shadow transition-all text-center" style="background-color: #F2EFE7;">
                        <div class="icon-wrapper mx-auto mb-3 text-white rounded-circle flex items-center justify-center p-3 shadow" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); width: 60px; height: 60px;">
                            <i class="ti ti-clock-play fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2" style="font-family: 'Jost', sans-serif;">Kuis Realtime</h5>
                        <p class="text-muted small">Uji pemahaman lewat kuis pilihan ganda berbatas waktu (countdown JS) dengan auto-submit dan review kunci jawaban.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="arsha-icon-box h-100 p-4 border rounded-4 shadow-sm hover-shadow transition-all text-center" style="background-color: #F2EFE7;">
                        <div class="icon-wrapper mx-auto mb-3 text-white rounded-circle flex items-center justify-center p-3 shadow" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%); width: 60px; height: 60px;">
                            <i class="ti ti-chart-dots fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2" style="font-family: 'Jost', sans-serif;">Laporan Diri</h5>
                        <p class="text-muted small">Pantau perkembangan akademik, statistik pengerjaan kuis, dan perolehan nilai kelasmu secara real-time.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Showcase Banner with Learning Image -->
        <div class="mb-5" data-aos="zoom-in">
            <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #F2EFE7 0%, #C8DFDB 100%);">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-5 text-center text-lg-start">
                            <span class="badge bg-warning text-dark font-bold px-3 py-2 rounded-pill mb-2">
                                <i class="ti ti-trophy text-dark me-1"></i> QUIZ CHAMPIONSHIP
                            </span>
                            <h3 class="fw-bold text-dark display-6 mb-3" style="font-family: 'Jost', sans-serif;">Uji Pemahamanmu & Raih Skor Tertinggi!</h3>
                            <p class="text-secondary fs-6 mb-4">
                                Tantang dirimu mengerjakan kuis online pilihan ganda dengan timer hitung mundur. Dapatkan evaluasi instan dan pembahasan jawaban secara langsung.
                            </p>
                            <a href="{{ route('student.quizzes.index') }}" class="btn text-white font-bold px-4 py-3 rounded-pill text-decoration-none shadow" style="background-color: #3368A0;">
                                <i class="ti ti-help-hexagon me-1"></i> Lihat Daftar Kuis Aktif
                            </a>
                        </div>
                        <div class="col-lg-7 text-center">
                            <img src="{{ asset('images/quiz-achievement.jpg') }}" alt="Prestasi Kuis Siswa SMA" class="img-fluid rounded-4 shadow-md border-3" style="border-color: #F2EFE7; max-height: 320px; width: 100%; object-fit: cover;">
                        </div>
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
                        <div class="card h-100 border rounded-4 shadow-sm hover-shadow transition-all overflow-hidden d-flex flex-column justify-content-between" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.25) !important;">
                            <div>
                                <div class="p-4 text-white position-relative" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); min-height: 120px;">
                                    <span class="badge text-primary font-bold px-3 py-1.5 rounded-pill shadow-sm mb-2 d-inline-block" style="background-color: #F2EFE7; color: #3368A0 !important;">
                                        <i class="ti ti-bookmark me-1"></i> {{ $mat->subject->name ?? 'Mata Pelajaran' }}
                                    </span>
                                    <h5 class="fw-bold text-white mb-0" style="font-family: 'Jost', sans-serif; font-size: 1.25rem;">{{ $mat->title }}</h5>
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">
                                        <i class="ti ti-user me-1 text-primary"></i> Guru Pengampu: <strong class="text-dark">{{ $mat->instructor->name ?? 'Pengajar' }}</strong>
                                    </p>
                                    <p class="text-muted small mb-0">
                                        <i class="ti ti-clock me-1 text-warning"></i> Estimasi Waktu: <span class="text-dark font-semibold">15-30 Menit</span>
                                    </p>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <a href="{{ route('student.materials.show', $mat) }}" class="btn text-white btn-sm w-100 text-center text-decoration-none rounded-pill py-2.5 font-bold shadow-sm d-inline-block" style="background-color: #3368A0;">
                                    Mulai Pelajari Materi <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="arsha-icon-box py-5 text-center text-muted rounded-4 border" style="background-color: #F2EFE7;">
                            <i class="ti ti-notes-off fs-1 text-secondary mb-2 d-block"></i>
                            <h5>Belum ada materi untuk kelas Anda saat ini.</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Active Quizzes & Assignments Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-5">
        <div class="row g-4">
            
            <!-- Active Quizzes -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 rounded-4 border shadow-sm text-start h-100" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.25) !important;">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-family: 'Jost', sans-serif;">
                            <i class="ti ti-help-hexagon text-primary me-2 fs-3"></i> Kuis Online Aktif
                        </h4>
                        <a href="{{ route('student.quizzes.index') }}" class="text-decoration-none small font-bold text-primary">Lihat Semua <i class="ti ti-chevron-right"></i></a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($activeQuizzes as $qz)
                            <div class="p-3 rounded-3 border shadow-sm d-flex align-items-center justify-content-between transition-all hover-shadow" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.2) !important;">
                                <div>
                                    <span class="badge text-white px-2.5 py-1 mb-1 me-2" style="background-color: #3368A0;">{{ $qz->subject->name ?? 'Kuis' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $qz->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-clock me-1 text-primary"></i> {{ $qz->duration_minutes }} Menit | 
                                        <i class="ti ti-calendar me-1 text-danger"></i> Deadline: {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                    </div>
                                </div>
                                <a href="{{ route('student.quizzes.show', $qz) }}" class="btn text-white btn-sm px-4 py-2 text-decoration-none rounded-pill shadow-sm font-bold" style="background-color: #3368A0;">
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
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 rounded-4 border shadow-sm text-start h-100" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.25) !important;">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-family: 'Jost', sans-serif;">
                            <i class="ti ti-notebook text-warning me-2 fs-3"></i> Tugas Perlu Dikumpulkan
                        </h4>
                        <a href="{{ route('student.assignments.index') }}" class="text-decoration-none small font-bold text-primary">Lihat Semua <i class="ti ti-chevron-right"></i></a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        @forelse($upcomingAssignments as $asg)
                            <div class="p-3 rounded-3 border shadow-sm d-flex align-items-center justify-content-between transition-all hover-shadow" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.2) !important;">
                                <div>
                                    <span class="badge bg-warning text-dark px-2.5 py-1 mb-1 me-2">{{ $asg->subject->name ?? 'Tugas' }}</span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $asg->title }}</h6>
                                    <div class="small text-muted">
                                        <i class="ti ti-calendar-event me-1 text-danger"></i> Deadline: <span class="fw-bold text-danger">{{ $asg->due_date ? $asg->due_date->format('d M H:i') : '-' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('student.assignments.show', $asg) }}" class="btn text-white btn-sm px-4 py-2 text-decoration-none rounded-pill shadow-sm font-bold" style="background-color: #3368A0;">
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
