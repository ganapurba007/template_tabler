<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin / Guru Dashboard') }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS for Laravel View -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="alert alert-info border-0 shadow-sm mb-4">
                <h4 class="alert-heading fw-bold mb-1"><i class="ti ti-user-check me-2"></i> Selamat Datang, {{ Auth::user()->name }}!</h4>
                <p class="mb-0">Anda terautentikasi sebagai <strong>Guru / Instruktur</strong>. Kelola Master Data, Materi, Tugas, Kuis, dan Laporan melalui panel admin ini.</p>
            </div>

            <!-- Admin Overview Cards -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-primary mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">MATA PELAJARAN</span>
                                <div class="avatar-icon-box avatar-icon-primary"><i class="ti ti-book"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->subjects->count() }}</div>
                            <div class="small text-muted-custom">Mapel diampu</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-success mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">MATERI DIPUBLIKASI</span>
                                <div class="avatar-icon-box avatar-icon-success"><i class="ti ti-file-text"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->materials->count() }}</div>
                            <div class="small text-muted-custom">Materi aktif</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-warning mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">TUGAS DIBUAT</span>
                                <div class="avatar-icon-box avatar-icon-warning"><i class="ti ti-pencil"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->assignments->count() }}</div>
                            <div class="small text-muted-custom">Tugas aktif</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-danger mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">KUIS DIBUAT</span>
                                <div class="avatar-icon-box avatar-icon-danger"><i class="ti ti-help"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->quizzes->count() }}</div>
                            <div class="small text-muted-custom">Kuis aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
