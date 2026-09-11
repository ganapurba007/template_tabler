@extends('layouts.be.master')

@section('header_title', 'Tambah Materi Pembelajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Tambah Materi Pembelajaran Baru</h3>
    <a href="{{ route('admin.materials.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Judul Materi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Pengenalan Algoritma Pemrograman">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="subject_id" class="form-label fw-semibold">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select class="form-select select2 @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }} ({{ $subject->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="class_id" class="form-label fw-semibold">Kelas Target <span class="text-danger">*</span></label>
                            <select class="form-select select2 @error('class_id') is-invalid @enderror" id="class_id" name="class_id" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label fw-semibold">Urutan Tampil</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3"><i class="ti ti-layers-intersect me-2 text-primary"></i>Konten &amp; Media Pembelajaran</h5>

                    <!-- Field: Text Content -->
                    <div class="mb-4">
                        <label for="content" class="form-label fw-semibold"><i class="ti ti-file-text me-1 text-success"></i> Isi Teks / Artikel Materi</label>
                        <textarea class="form-control tinymce @error('content') is-invalid @enderror" id="content" name="content" rows="6" placeholder="Tuliskan teks atau artikel materi pelajaran di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Field: YouTube URL -->
                        <div class="col-md-6">
                            <label for="video_url" class="form-label fw-semibold"><i class="ti ti-brand-youtube me-1 text-danger"></i> URL Video YouTube (Opsional)</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field: Document File -->
                        <div class="col-md-6">
                            <label for="document_file" class="form-label fw-semibold"><i class="ti ti-file-download me-1 text-warning"></i> File Dokumen Lampiran (Opsional, Maks 20MB)</label>
                            <input type="file" class="form-control @error('document_file') is-invalid @enderror" id="document_file" name="document_file">
                            <div class="form-text">Format: PDF, DOCX, PPTX, XLSX, PNG, JPG.</div>
                            @error('document_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.materials.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Materi &amp; Broadcaster
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
