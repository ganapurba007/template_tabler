<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Progres Belajar Diri') }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Metrics Summary Cards -->
            <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
                <div class="col">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-2 rounded bg-primary-subtle text-primary me-3">
                                    <i class="ti ti-book fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Progres Materi</div>
                                    <h4 class="fw-bold m-0">{{ $materialProgressPercent }}%</h4>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $materialProgressPercent }}%"></div>
                            </div>
                            <div class="small text-muted mt-2">{{ $completedMaterials }} dari {{ $totalMaterials }} materi selesai</div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded bg-info-subtle text-info me-3">
                                    <i class="ti ti-file-text fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Rata-Rata Tugas</div>
                                    <h4 class="fw-bold m-0">{{ $avgAssignmentScore }}</h4>
                                </div>
                            </div>
                            <div class="small text-muted mt-3">{{ $submissions->whereNotNull('grade')->count() }} tugas telah dinilai</div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded bg-warning-subtle text-warning me-3">
                                    <i class="ti ti-help-circle fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Rata-Rata Kuis</div>
                                    <h4 class="fw-bold m-0">{{ $avgQuizScore }}</h4>
                                </div>
                            </div>
                            <div class="small text-muted mt-3">{{ $quizAttempts->count() }} kuis selesai</div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="p-2 rounded bg-success-subtle text-success me-3">
                                    <i class="ti ti-award fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Nilai Keseluruhan</div>
                                    <h4 class="fw-bold m-0 text-success">{{ $overallScore }}</h4>
                                </div>
                            </div>
                            <div class="small text-muted mt-3">Evaluasi gabungan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Tables -->
            <div class="row g-4">
                <!-- Riwayat Tugas -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-light py-3">
                            <h5 class="fw-bold m-0"><i class="ti ti-file-check me-2 text-primary"></i>Riwayat &amp; Nilai Tugas</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tugas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($submissions as $sub)
                                            <tr>
                                                <td class="fw-bold">{{ $sub->assignment->title ?? '-' }}</td>
                                                <td>{{ $sub->assignment->subject->name ?? '-' }}</td>
                                                <td>
                                                    @if(!is_null($sub->grade))
                                                        <span class="badge bg-success fs-6">{{ $sub->grade }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">Menunggu Koreksi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Belum ada tugas yang dikumpulkan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Kuis -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-light py-3">
                            <h5 class="fw-bold m-0"><i class="ti ti-help-circle me-2 text-warning"></i>Riwayat &amp; Skor Kuis</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kuis</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($quizAttempts as $attempt)
                                            <tr>
                                                <td class="fw-bold">{{ $attempt->quiz->title ?? '-' }}</td>
                                                <td>{{ $attempt->quiz->subject->name ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-primary fs-6">{{ $attempt->score }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Belum ada kuis yang diselesaikan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
