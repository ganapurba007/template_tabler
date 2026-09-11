<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil & Preview Kuis') }}: {{ $quiz->title }}
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
                    <i class="ti ti-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <a href="{{ route('student.quizzes.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Kuis
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-9">
                    <!-- Score Card Banner -->
                    <div class="card shadow-sm border-0 mb-4 bg-white text-center">
                        <div class="card-body py-4">
                            <div class="d-inline-block p-3 rounded-circle bg-success-subtle text-success mb-2">
                                <i class="ti ti-trophy fs-1"></i>
                            </div>
                            <h4 class="text-muted mb-1">Skor Kuis Anda</h4>
                            <div class="display-4 fw-bold text-success mb-2">{{ $attempt->score }}</div>
                            <div class="text-muted small">
                                Dikumpulkan pada: {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y, H:i:s') : '-' }}
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold mb-3"><i class="ti ti-file-search me-2 text-primary"></i>Review Jawaban Soal</h4>

                    @foreach($quiz->questions as $index => $question)
                        @php
                            $userAnswer = $answersMap->get($question->id);
                            $selectedOptionId = $userAnswer ? $userAnswer->selected_option_id : null;
                            $correctOption = $question->options->firstWhere('is_correct', true);
                            $isCorrect = $selectedOptionId && $correctOption && $selectedOptionId === $correctOption->id;
                        @endphp

                        <div class="card shadow-sm border-0 mb-3 border-start border-4 border-{{ $isCorrect ? 'success' : ($selectedOptionId ? 'danger' : 'warning') }}">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                                <h5 class="fw-bold m-0">Soal No. {{ $index + 1 }}</h5>
                                <div>
                                    @if($isCorrect)
                                        <span class="badge bg-success"><i class="ti ti-check me-1"></i> Benar</span>
                                    @elseif($selectedOptionId)
                                        <span class="badge bg-danger"><i class="ti ti-x me-1"></i> Salah</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="ti ti-alert-circle me-1"></i> Tidak Dijawab</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <p class="fs-5 fw-medium mb-4">{{ $question->question_text }}</p>

                                <div class="list-group">
                                    @foreach($question->options as $option)
                                        @php
                                            $isUserSelected = $selectedOptionId === $option->id;
                                            $isOptionCorrect = $option->is_correct;
                                            
                                            $itemClass = 'list-group-item';
                                            if ($isOptionCorrect && $isUserSelected) {
                                                $itemClass .= ' list-group-item-success fw-bold';
                                            } elseif ($isOptionCorrect) {
                                                $itemClass .= ' list-group-item-success';
                                            } elseif ($isUserSelected) {
                                                $itemClass .= ' list-group-item-danger';
                                            }
                                        @endphp

                                        <div class="{{ $itemClass }} d-flex justify-content-between align-items-center py-3">
                                            <div class="d-flex align-items-center">
                                                @if($isUserSelected && $isOptionCorrect)
                                                    <i class="ti ti-check text-success fs-4 me-2"></i>
                                                @elseif($isUserSelected)
                                                    <i class="ti ti-x text-danger fs-4 me-2"></i>
                                                @elseif($isOptionCorrect)
                                                    <i class="ti ti-circle-check text-success fs-4 me-2"></i>
                                                @else
                                                    <i class="ti ti-circle text-muted me-2"></i>
                                                @endif
                                                <span>{{ $option->option_text }}</span>
                                            </div>

                                            <div>
                                                @if($isUserSelected)
                                                    <span class="badge bg-primary me-1">Jawaban Anda</span>
                                                @endif

                                                @if($isOptionCorrect)
                                                    <span class="badge bg-success">Jawaban Benar</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center mt-4 mb-5">
                        <a href="{{ route('student.quizzes.index') }}" class="btn btn-primary btn-lg px-5">
                            <i class="ti ti-check me-2"></i> Selesai Review
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
