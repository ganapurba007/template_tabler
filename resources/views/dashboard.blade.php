<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Alert Card -->
            <div class="alert alert-primary border-0 shadow-sm mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="alert-heading fw-bold mb-1"><i class="ti ti-school me-2"></i> Selamat Datang, {{ $user->name }}!</h4>
                        <p class="mb-0">Anda terdaftar di <strong>{{ $user->schoolClass->name ?? 'Kelas Belum Ditentukan' }}</strong>. Akses materi, kumpulkan tugas, dan selesaikan kuis evaluasi tepat waktu.</p>
                    </div>
                    <div class="text-end d-none d-md-block">
                        <span class="badge bg-white text-primary fs-6 px-3 py-2 fw-bold">Kelas: {{ $user->schoolClass->name ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Student Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-hover stat-card-accent-primary mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted-custom small fw-bold text-uppercase">PROGRES MATERI</span>
                                <div class="avatar-icon-box avatar-icon-primary"><i class="ti ti-chart-line"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ $overallProgress }}%</div>
                            <div class="small text-muted-custom">{{ $completedMaterialsCount }} dari {{ $totalClassMaterials }} materi selesai</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-hover stat-card-accent-warning mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted-custom small fw-bold text-uppercase">TUGAS MENDATANG</span>
                                <div class="avatar-icon-box avatar-icon-warning"><i class="ti ti-pencil"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ $upcomingAssignments->count() }}</div>
                            <div class="small text-muted-custom">Tugas perlu dikumpulkan</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-hover stat-card-accent-danger mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted-custom small fw-bold text-uppercase">KUIS AKTIF</span>
                                <div class="avatar-icon-box avatar-icon-danger"><i class="ti ti-help"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ $activeQuizzes->count() }}</div>
                            <div class="small text-muted-custom">Kuis siap dikerjakan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Upcoming Assignments & Active Quizzes -->
            <div class="row g-4 mb-4">
                <!-- Upcoming Assignments Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title fw-bold mb-0 text-dark">
                                <i class="ti ti-notebook me-2 text-warning"></i> Tugas Perlu Dikumpulkan
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($upcomingAssignments as $asg)
                                    <li class="list-group-item p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">{{ $asg->title }}</h6>
                                                <div class="small text-muted mb-1">Mapel: <span class="fw-semibold text-primary">{{ $asg->subject->name ?? '-' }}</span></div>
                                            </div>
                                            <span class="badge bg-danger-subtle text-danger px-2 py-1 fs-6">
                                                Deadline: {{ $asg->due_date ? $asg->due_date->format('d M H:i') : '-' }}
                                            </span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item p-4 text-center text-muted">
                                        Tidak ada tugas mendatang.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Active Quizzes Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title fw-bold mb-0 text-dark">
                                <i class="ti ti-alarm me-2 text-danger"></i> Kuis Evaluasi Aktif
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($activeQuizzes as $qz)
                                    <li class="list-group-item p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">{{ $qz->title }}</h6>
                                                <div class="small text-muted mb-1">
                                                    Mapel: <span class="fw-semibold text-primary">{{ $qz->subject->name ?? '-' }}</span> |
                                                    Durasi: <span class="fw-semibold text-dark">{{ $qz->duration_minutes }} Menit</span>
                                                </div>
                                            </div>
                                            <span class="badge bg-warning-subtle text-dark px-2 py-1 fs-6">
                                                Batas: {{ $qz->deadline ? $qz->deadline->format('d M H:i') : '-' }}
                                            </span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item p-4 text-center text-muted">
                                        Tidak ada kuis aktif saat ini.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Materials Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">
                        <i class="ti ti-book me-2 text-primary"></i> Materi Pembelajaran Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Judul Materi</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tipe Konten</th>
                                    <th>Pengajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materials as $mat)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">{{ $mat->title }}</td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6">
                                                {{ $mat->subject->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($mat->content_type === 'text')
                                                <span class="badge bg-success px-2 py-1">Teks / Artikel</span>
                                            @elseif($mat->content_type === 'document')
                                                <span class="badge bg-warning text-dark px-2 py-1">Dokumen</span>
                                            @elseif($mat->content_type === 'youtube')
                                                <span class="badge bg-danger px-2 py-1">YouTube</span>
                                            @endif
                                        </td>
                                        <td>{{ $mat->instructor->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada materi untuk kelas Anda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
