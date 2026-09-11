<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buat Kuis Baru') }}
            </h2>
            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.quizzes.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Kuis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Kuis Harian Bab 2 Persamaan Kuadrat">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="subject_id" class="form-label fw-semibold">Mata Pelajaran <span class="text-danger">*</span></label>
                                <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
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
                                <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" name="class_id" required>
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

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="duration_minutes" class="form-label fw-semibold">Durasi Pengerjaan (Menit) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" min="1" required>
                                @error('duration_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="points_per_question" class="form-label fw-semibold">Poin per Soal <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('points_per_question') is-invalid @enderror" id="points_per_question" name="points_per_question" value="{{ old('points_per_question', 10) }}" min="1" required>
                                @error('points_per_question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="deadline" class="form-label fw-semibold">Batas Waktu (Deadline) <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-arrow-right me-1"></i> Simpan & Kelola Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
