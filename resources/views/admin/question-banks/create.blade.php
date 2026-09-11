<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Soal Ke Bank Soal') }}
            </h2>
            <a href="{{ route('admin.question-banks.index') }}" class="btn btn-outline-secondary btn-sm">
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
                    <form method="POST" action="{{ route('admin.question-banks.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="question_text" class="form-label fw-semibold">Teks Pertanyaan Soal <span class="text-danger">*</span></label>
                            <textarea id="question_text" name="question_text" rows="4" class="form-control @error('question_text') is-invalid @enderror" required placeholder="Tuliskan soal pertanyaan di sini...">{{ old('question_text') }}</textarea>
                            @error('question_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">Pilihan Jawaban & Kunci Jawaban Benar <span class="text-danger">*</span></label>
                            <p class="text-muted small mb-3">Isi teks opsi jawaban di bawah ini dan pilih radio button pada opsi yang merupakan **jawaban benar**.</p>

                            <div class="vstack gap-3">
                                @for($i = 0; $i < 4; $i++)
                                    <div class="card bg-light border-0 p-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct_option" id="correct_{{ $i }}" value="{{ $i }}" {{ old('correct_option', '0') == $i ? 'checked' : '' }} required>
                                                <label class="form-check-label fw-bold text-success" for="correct_{{ $i }}">
                                                    Kunci Jawaban {{ chr(65 + $i) }}
                                                </label>
                                            </div>
                                            <div class="flex-grow-1">
                                                <input type="text" name="options[{{ $i }}]" class="form-control @error('options.'.$i) is-invalid @enderror" value="{{ old('options.'.$i) }}" placeholder="Isi Pilihan {{ chr(65 + $i) }}" required>
                                                @error('options.'.$i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.question-banks.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Simpan Soal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
