<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kuis Kelas Saya') }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($quizzes as $quiz)
                    @php
                        $userAttempt = $quiz->attempts->first();
                    @endphp
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ $quiz->subject->name ?? 'Mata Pelajaran' }}</span>
                                    <span class="badge bg-secondary"><i class="ti ti-clock me-1"></i>{{ $quiz->duration_minutes }} Menit</span>
                                </div>
                                <h5 class="card-title fw-bold mb-2">{{ $quiz->title }}</h5>
                                <div class="text-muted small mb-3">
                                    <div><i class="ti ti-user me-1"></i>Guru: {{ $quiz->instructor->name ?? '-' }}</div>
                                    <div><i class="ti ti-list-check me-1"></i>Jumlah Soal: {{ $quiz->questions->count() }} soal</div>
                                    @if($quiz->deadline)
                                        <div><i class="ti ti-calendar-event me-1"></i>Batas Waktu: {{ $quiz->deadline->format('d M Y, H:i') }}</div>
                                    @endif
                                </div>

                                <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                    @if($userAttempt && $userAttempt->submitted_at)
                                        <div>
                                            <span class="badge bg-success">Selesai</span>
                                            <div class="small fw-bold text-success mt-1">Skor: {{ $userAttempt->score }}</div>
                                        </div>
                                        <a href="{{ route('student.quizzes.result', $quiz) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="ti ti-eye me-1"></i> Lihat Hasil
                                        </a>
                                    @elseif($userAttempt)
                                        <span class="badge bg-warning text-dark">Sedang Mengerjakan</span>
                                        <a href="{{ route('student.quizzes.attempt', $quiz) }}" class="btn btn-warning btn-sm">
                                            <i class="ti ti-player-play me-1"></i> Lanjutkan
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Belum Mengerjakan</span>
                                        <a href="{{ route('student.quizzes.show', $quiz) }}" class="btn btn-primary btn-sm">
                                            <i class="ti ti-arrow-right me-1"></i> Ikuti Kuis
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center py-5">
                                <i class="ti ti-help-circle text-muted mb-2" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold">Belum ada kuis untuk kelas Anda.</h5>
                                <p class="text-muted">Kuis yang ditambahkan oleh guru akan tampil di halaman ini.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
