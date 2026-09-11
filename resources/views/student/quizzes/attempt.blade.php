<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $quiz->title }}
                </h2>
                <div class="text-sm text-gray-500">{{ $quiz->subject->name ?? 'Mata Pelajaran' }}</div>
            </div>
            <div class="d-flex align-items-center bg-danger text-white px-3 py-2 rounded shadow-sm">
                <i class="ti ti-clock me-2 fs-3"></i>
                <div>
                    <div class="small text-uppercase fw-bold" style="font-size: 0.65rem;">Sisa Waktu</div>
                    <div id="quizTimer" class="fs-4 fw-bold font-monospace">--:--</div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <form id="quizForm" action="{{ route('student.quizzes.submit', $quiz) }}" method="POST">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-9">
                        @forelse($quiz->questions as $index => $question)
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-light py-3">
                                    <h5 class="fw-bold m-0 text-primary">Soal No. {{ $index + 1 }}</h5>
                                </div>
                                <div class="card-body p-4">
                                    <p class="fs-5 fw-medium mb-4">{{ $question->question_text }}</p>

                                    <div class="d-flex flex-column gap-2">
                                        @foreach($question->options as $option)
                                            <label class="border rounded p-3 d-flex align-items-center cursor-pointer hover-bg-light">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="form-check-input me-3" style="width: 1.25rem; height: 1.25rem;">
                                                <span class="fs-6 text-dark">{{ $option->option_text }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-sm border-0">
                                <div class="card-body text-center py-4">
                                    <p class="text-muted">Tidak ada soal dalam kuis ini.</p>
                                </div>
                            </div>
                        @empty
                        @endforelse

                        <div class="card shadow-sm border-0 mt-4">
                            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    <i class="ti ti-info-circle me-1"></i> Periksa kembali jawaban Anda sebelum mengumpulkan.
                                </div>
                                <button type="submit" id="submitBtn" class="btn btn-success btn-lg px-4" onclick="return confirm('Apakah Anda yakin ingin mengumpulkan kuis ini?')">
                                    <i class="ti ti-check me-2"></i> Kumpulkan Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let remainingSeconds = {{ (int)$remainingSeconds }};
            const timerElement = document.getElementById('quizTimer');
            const quizForm = document.getElementById('quizForm');
            let autoSubmitted = false;

            function updateTimer() {
                if (remainingSeconds <= 0) {
                    timerElement.innerText = "00:00";
                    if (!autoSubmitted) {
                        autoSubmitted = true;
                        alert('Waktu pengerjaan kuis telah habis! Jawaban Anda akan otomatis dikumpulkan.');
                        quizForm.submit();
                    }
                    return;
                }

                const minutes = Math.floor(remainingSeconds / 60);
                const seconds = remainingSeconds % 60;
                timerElement.innerText = 
                    String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

                remainingSeconds--;
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>
</x-app-layout>
