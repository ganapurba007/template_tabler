@extends('layouts.be.master')

@section('header_title', 'Detail & Koreksi Tugas Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Detail &amp; Koreksi Tugas Siswa</h3>
    <a href="{{ route('admin.submissions.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Submissions
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="ti ti-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header py-3">
                <h5 class="card-title fw-bold mb-0">Informasi Pengumpulan</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <span class="text-muted small text-uppercase">Nama Siswa</span>
                        <div class="fw-bold fs-6">{{ $submission->student->name ?? '-' }} ({{ $submission->student->email ?? '-' }})</div>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small text-uppercase">Kelas</span>
                        <div class="fw-bold fs-6">{{ $submission->assignment->schoolClass->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <span class="text-muted small text-uppercase">Judul Tugas</span>
                        <div class="fw-bold fs-6 text-primary">{{ $submission->assignment->title ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small text-uppercase">Dikumpulkan Pada</span>
                        <div class="fw-bold fs-6"><i class="ti ti-clock me-1"></i> {{ $submission->submitted_at ? $submission->submitted_at->format('d M Y H:i:s') : '-' }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    <span class="text-muted small text-uppercase d-block mb-1">Jawaban / Catatan Siswa</span>
                    <div class="p-3 bg-light rounded border">
                        {!! nl2br(e($submission->answer_text)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Grading Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header py-3">
                <h5 class="card-title fw-bold mb-0"><i class="ti ti-pencil-check me-1 text-success"></i> Penilaian Guru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.submissions.grade', $submission) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="grade" class="form-label fw-semibold">Nilai (0 - 100) <span class="text-danger">*</span></label>
                        <input type="number" step="0.1" min="0" max="100" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" value="{{ old('grade', $submission->grade) }}" required placeholder="Contoh: 85.5">
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="feedback" class="form-label fw-semibold">Umpan Balik / Catatan Guru</label>
                        <textarea class="form-control @error('feedback') is-invalid @enderror" id="feedback" name="feedback" rows="4" placeholder="Berikan saran atau evaluasi pengerjaan siswa...">{{ old('feedback', $submission->feedback) }}</textarea>
                        @error('feedback')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.submissions.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Nilai &amp; Umpan Balik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
