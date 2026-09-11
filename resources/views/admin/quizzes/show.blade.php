@extends('layouts.be.master')

@section('header_title', 'Kelola Soal Kuis: ' . $quiz->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Kelola Soal Kuis: {{ $quiz->title }}</h3>
    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Kuis
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="ti ti-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Quiz Info Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <span class="text-muted small text-uppercase fw-bold">Mata Pelajaran</span>
                <div class="fw-bold fs-5 text-primary">{{ $quiz->subject->name ?? '-' }}</div>
            </div>
            <div class="col-md-3">
                <span class="text-muted small text-uppercase fw-bold">Kelas Target</span>
                <div class="fw-bold fs-5 text-info">{{ $quiz->schoolClass->name ?? '-' }}</div>
            </div>
            <div class="col-md-3">
                <span class="text-muted small text-uppercase fw-bold">Durasi Pengerjaan</span>
                <div class="fw-bold fs-5 text-dark"><i class="ti ti-clock me-1"></i> {{ $quiz->duration_minutes }} Menit</div>
            </div>
            <div class="col-md-3">
                <span class="text-muted small text-uppercase fw-bold">Poin per Soal</span>
                <div class="fw-bold fs-5 text-success">{{ $quiz->points_per_question }} Poin</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Current Quiz Questions List -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold mb-0">Daftar Soal Kuis ({{ $quiz->questions->count() }} Soal)</h5>
            </div>
            <div class="card-body p-0">
                @forelse($quiz->questions as $index => $q)
                    <div class="p-3 border-bottom {{ $loop->last ? 'border-0' : '' }}">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold text-dark mb-0">Soal {{ $index + 1 }}</h6>
                            <form method="POST" action="{{ route('admin.quizzes.destroy-question', [$quiz, $q]) }}" onsubmit="return confirm('Hapus soal ini dari kuis?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Hapus Soal">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                        <p class="text-dark mb-2 fw-medium">{{ $q->question_text }}</p>
                        <div class="ps-3 border-start border-3 border-primary">
                            @foreach($q->options as $opt)
                                <div class="small mb-1 {{ $opt->is_correct ? 'text-success fw-bold' : 'text-muted' }}">
                                    @if($opt->is_correct)
                                        <i class="ti ti-check me-1"></i>
                                    @else
                                        <i class="ti ti-circle me-1"></i>
                                    @endif
                                    {{ $opt->option_text }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="ti ti-help-off fs-1 d-block mb-2 text-secondary"></i>
                        Belum ada soal dalam kuis ini. Silakan impor dari Bank Soal atau tambah soal manual.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Column: Import from Bank Soal or Manual Creation -->
    <div class="col-lg-5">
        <!-- Import Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0"><i class="ti ti-file-import me-1 text-primary"></i> Impor Soal dari Bank Soal</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.quizzes.import-questions', $quiz) }}" method="POST">
                    @csrf
                    <div class="mb-3" style="max-height: 250px; overflow-y: auto;">
                        @forelse($questionBanks as $qb)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="question_bank_ids[]" value="{{ $qb->id }}" id="qb_{{ $qb->id }}">
                                <label class="form-check-label small text-dark" for="qb_{{ $qb->id }}">
                                    {{ Str::limit($qb->question_text, 70) }}
                                </label>
                            </div>
                        @empty
                            <div class="small text-muted">Bank Soal masih kosong.</div>
                        @endforelse
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100" {{ $questionBanks->isEmpty() ? 'disabled' : '' }}>
                        <i class="ti ti-file-import me-1"></i> Impor Soal Terpilih
                    </button>
                </form>
            </div>
        </div>

        <!-- Manual Question Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0"><i class="ti ti-plus me-1 text-success"></i> Tambah Soal Manual</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.quizzes.store-question', $quiz) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Pertanyaan Soal</label>
                        <textarea name="question_text" class="form-control form-control-sm" rows="3" required placeholder="Tuliskan pertanyaan kuis..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Opsi Jawaban (Pilih Kunci Jawaban)</label>
                        @for($i = 0; $i < 4; $i++)
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" name="correct_option" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }} title="Pilih sebagai kunci jawaban benar">
                                </div>
                                <input type="text" name="options[]" class="form-control" placeholder="Opsi {{ chr(65 + $i) }}" required>
                            </div>
                        @endfor
                    </div>

                    <button type="submit" class="btn btn-success btn-sm w-100">
                        <i class="ti ti-plus me-1"></i> Tambah Soal Manual
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
