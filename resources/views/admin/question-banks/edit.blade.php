@extends('layouts.be.master')

@section('header_title', 'Edit Soal — Bank Soal #' . $questionBank->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Edit Soal Bank Soal</h3>
    <a href="{{ route('admin.question-banks.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.question-banks.update', $questionBank) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="question_text" class="form-label fw-semibold">Teks Pertanyaan Soal <span class="text-danger">*</span></label>
                        <textarea id="question_text" name="question_text" rows="4" class="form-control @error('question_text') is-invalid @enderror" required>{{ old('question_text', $questionBank->question_text) }}</textarea>
                        @error('question_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-2">Pilihan Jawaban &amp; Kunci Jawaban Benar <span class="text-danger">*</span></label>
                        <p class="text-muted small mb-3">Sesuaikan opsi jawaban dan tandai radio button pada opsi yang merupakan **jawaban benar**.</p>

                        @php
                            $options = $questionBank->options->values();
                            $defaultCorrect = $options->search(fn($o) => $o->is_correct);
                            if ($defaultCorrect === false) { $defaultCorrect = 0; }
                        @endphp

                        <div class="vstack gap-3">
                            @for($i = 0; $i < max(4, count($options)); $i++)
                                @php
                                    $optVal = isset($options[$i]) ? $options[$i]->option_text : '';
                                @endphp
                                <div class="card bg-light border-0 p-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_option" id="correct_{{ $i }}" value="{{ $i }}" {{ old('correct_option', (string)$defaultCorrect) == (string)$i ? 'checked' : '' }} required>
                                            <label class="form-check-label fw-bold text-success" for="correct_{{ $i }}">
                                                Kunci Jawaban {{ chr(65 + $i) }}
                                            </label>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="text" name="options[{{ $i }}]" class="form-control @error('options.'.$i) is-invalid @enderror" value="{{ old('options.'.$i, $optVal) }}" placeholder="Isi Pilihan {{ chr(65 + $i) }}" required>
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
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Update Soal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
