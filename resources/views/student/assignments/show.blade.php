<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $assignment->title }}
            </h2>
            <a href="{{ route('student.assignments.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Tugas
            </a>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-4xl mx-auto">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="ti ti-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Assignment Info Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary-subtle text-primary me-2">{{ $assignment->subject->name ?? '-' }}</span>
                            <span class="text-muted small"><i class="ti ti-user me-1"></i> Guru: {{ $assignment->instructor->name ?? '-' }}</span>
                        </div>
                        <div class="small fw-semibold text-danger">
                            <i class="ti ti-clock me-1"></i> Batas Waktu: {{ $assignment->due_date ? $assignment->due_date->format('d M Y H:i') : '-' }}
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-2">Petunjuk & Deskripsi Tugas</h6>
                    <div class="p-3 bg-light rounded text-dark fs-6 mb-3">
                        {!! nl2br(e($assignment->description ?? 'Tidak ada petunjuk khusus.')) !!}
                    </div>
                </div>
            </div>

            <!-- Grade & Feedback Banner if Graded -->
            @if($submission && !is_null($submission->grade))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <h5 class="alert-heading fw-bold mb-1"><i class="ti ti-award me-2"></i> Hasil Penilaian Guru</h5>
                    <div class="fs-4 fw-bold mb-2">Nilai: {{ number_format($submission->grade, 1) }} / 100</div>
                    @if($submission->feedback)
                        <div class="small text-dark"><strong>Umpan Balik Guru:</strong> {{ $submission->feedback }}</div>
                    @endif
                </div>
            @endif

            <!-- Submission Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">
                        <i class="ti ti-send me-2 text-primary"></i> Form Pengumpulan Jawaban
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('student.assignments.submit', $assignment) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="answer_text" class="form-label fw-semibold">Jawaban / Catatan Pengumpulan <span class="text-danger">*</span></label>
                            <textarea name="answer_text" id="answer_text" rows="6" class="form-control @error('answer_text') is-invalid @enderror" required placeholder="Tuliskan jawaban tugas Anda di sini...">{{ old('answer_text', $submission?->answer_text) }}</textarea>
                            @error('answer_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($submission)
                            <div class="small text-muted mb-3">
                                <i class="ti ti-history me-1"></i> Terakhir dikumpulkan pada: {{ $submission->submitted_at ? $submission->submitted_at->format('d M Y H:i:s') : '-' }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i> {{ $submission ? 'Perbarui Pengumpulan' : 'Kirim Jawaban' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
