<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="mb-3">
                <a href="{{ route('student.quizzes.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Kuis
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <span class="d-inline-block p-3 rounded-circle bg-light mb-3">
                                    <i class="ti ti-clock text-primary" style="font-size: 2.5rem;"></i>
                                </span>
                                <h3 class="fw-bold">Petunjuk Pengerjaan Kuis</h3>
                                <p class="text-muted">{{ $quiz->subject->name ?? 'Mata Pelajaran' }} • Guru: {{ $quiz->instructor->name ?? '-' }}</p>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6 col-md-3 text-center p-3 bg-light rounded">
                                    <div class="text-muted small">Durasi</div>
                                    <div class="fs-4 fw-bold text-primary">{{ $quiz->duration_minutes }} Menit</div>
                                </div>
                                <div class="col-6 col-md-3 text-center p-3 bg-light rounded">
                                    <div class="text-muted small">Jumlah Soal</div>
                                    <div class="fs-4 fw-bold text-primary">{{ $quiz->questions->count() }}</div>
                                </div>
                                <div class="col-6 col-md-3 text-center p-3 bg-light rounded">
                                    <div class="text-muted small">Poin / Soal</div>
                                    <div class="fs-4 fw-bold text-primary">{{ $quiz->points_per_question ?? 100 }}</div>
                                </div>
                                <div class="col-6 col-md-3 text-center p-3 bg-light rounded">
                                    <div class="text-muted small">Batas Waktu</div>
                                    <div class="small fw-bold text-dark mt-1">{{ $quiz->deadline ? $quiz->deadline->format('d M Y, H:i') : 'Tanpa Batas' }}</div>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <h5 class="alert-heading fw-bold"><i class="ti ti-alert-circle me-1"></i> Perhatian:</h5>
                                <ul class="mb-0 ps-3">
                                    <li>Waktu akan mulai berjalan secara otomatis setelah Anda menekan tombol <strong>Mulai Kuis</strong>.</li>
                                    <li>Pastikan koneksi internet Anda stabil selama mengerjakan.</li>
                                    <li>Jika waktu habis, jawaban kuis akan terkirim secara otomatis.</li>
                                </ul>
                            </div>

                            <div class="mt-4 text-center">
                                @if($attempt && $attempt->submitted_at)
                                    <a href="{{ route('student.quizzes.result', $quiz) }}" class="btn btn-success btn-lg">
                                        <i class="ti ti-eye me-2"></i> Lihat Hasil Kuis (Skor: {{ $attempt->score }})
                                    </a>
                                @elseif($attempt)
                                    <a href="{{ route('student.quizzes.attempt', $quiz) }}" class="btn btn-warning btn-lg">
                                        <i class="ti ti-player-play me-2"></i> Lanjutkan Kuis
                                    </a>
                                @else
                                    <form action="{{ route('student.quizzes.start', $quiz) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="ti ti-player-play me-2"></i> Mulai Kuis Sekarang
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
