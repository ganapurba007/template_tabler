<x-app-layout>
    <!-- Include Bootstrap, Tabler Icons & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <style>
        /* Modern Sticky Header Bar (Lega, Mewah & Tidak Mepet) */
        .quiz-attempt-hero {
            background: linear-gradient(135deg, #20456E 0%, #3368A0 60%, #2b5788 100%);
            border-bottom: 3px solid #66A3BF;
            color: #ffffff;
            position: sticky;
            top: 4.1rem;
            z-index: 1020;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            padding-top: 2.25rem !important;
            padding-bottom: 2.25rem !important;
        }
        
        /* Single Question Card Stepper */
        .question-step-card {
            display: none;
            animation: fadeInQuestion 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .question-step-card.active {
            display: block;
        }
        @keyframes fadeInQuestion {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Compact & Balanced Question Card (Tidak Perlu Scroll) */
        .question-card-modern {
            background: #ffffff;
            border-radius: 16px;
            border: 1.5px solid rgba(51, 104, 160, 0.16);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 1.25rem;
            transition: border-color 0.2s ease;
        }
        .question-card-header {
            padding: 0.8rem 1.4rem;
            background: #F2EFE7;
            border-bottom: 1px solid rgba(51, 104, 160, 0.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Compact & Comfortable Option Tiles (Sedikit Diperkecil Agar Pas Viewport) */
        .quiz-option-tile {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.15rem;
            border-radius: 10px;
            border: 1.5px solid rgba(51, 104, 160, 0.15);
            background: #ffffff;
            margin-bottom: 0.6rem;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            user-select: none;
        }
        .quiz-option-tile:hover {
            background: #f8fafc;
            border-color: #3368A0;
            transform: translateX(3px);
        }
        .quiz-option-tile.selected {
            background: rgba(37, 99, 235, 0.08);
            border-color: #2563EB;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.12);
        }
        .option-badge-letter {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.88rem;
            background: #e2e8f0;
            color: #334155;
            margin-right: 0.95rem;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }
        .quiz-option-tile.selected .option-badge-letter {
            background: #2563EB;
            color: #ffffff;
        }

        /* Timer Badge */
        .timer-badge-box {
            background: rgba(220, 53, 69, 0.92);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 50rem;
            padding: 8px 22px;
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.35);
        }
        .timer-warning {
            animation: pulse-timer 1.2s infinite;
        }
        @keyframes pulse-timer {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.04); }
        }

        /* Navigasi Nomor Soal (Palette) Lega, Luas & Rapi */
        .palette-sticky-card {
            position: sticky;
            top: 10.25rem;
            background: #ffffff;
            border-radius: 18px;
            border: 1.5px solid rgba(51, 104, 160, 0.16);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
            padding: 1.5rem 1.65rem !important;
            overflow: hidden;
        }
        .palette-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(36px, 1fr));
            gap: 8px;
        }
        .nav-question-btn {
            height: 36px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease;
            position: relative;
            border: none;
        }
        
        /* 1. Belum dijawab: Abu-abu netral */
        .nav-btn-unanswered {
            background-color: #F1F5F9;
            color: #475569;
            border: 1.5px solid #CBD5E1;
        }
        .nav-btn-unanswered:hover {
            background-color: #E2E8F0;
            border-color: #94A3B8;
            color: #1E293B;
            transform: translateY(-2px);
        }

        /* 2. Sudah dijawab: Hijau tegas */
        .nav-btn-answered {
            background-color: #10B981 !important;
            color: #ffffff !important;
            border: 1.5px solid #059669 !important;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.25);
        }
        .nav-btn-answered:hover {
            background-color: #059669 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* 3. Sedang Dikerjakan / Aktif: BIRU MENYALA */
        .nav-btn-current {
            background-color: #2563EB !important;
            color: #ffffff !important;
            border: 2px solid #1D4ED8 !important;
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.35), 0 4px 10px rgba(37, 99, 235, 0.25) !important;
            transform: scale(1.06);
            z-index: 2;
        }
        .nav-btn-current:hover {
            background-color: #1D4ED8 !important;
            color: #ffffff !important;
        }

        /* Keterangan Warna (Legend) Lega & Rapi */
        .legend-box-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 13px;
            border-radius: 11px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            transition: background-color 0.15s ease;
        }
        .legend-indicator-dot {
            width: 15px;
            height: 15px;
            border-radius: 4px;
            flex-shrink: 0;
        }
        .legend-indicator-dot.dot-current {
            background-color: #2563EB;
            border: 1.5px solid #1D4ED8;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.25);
        }
        .legend-indicator-dot.dot-answered {
            background-color: #10B981;
            border: 1.5px solid #059669;
        }
        .legend-indicator-dot.dot-unanswered {
            background-color: #F1F5F9;
            border: 1.5px solid #CBD5E1;
        }

        /* Live Sync Badge */
        .sync-badge {
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(8px);
            color: #ffffff;
            font-size: 0.8rem;
            padding: 7px 16px;
            border-radius: 50rem;
        }
    </style>

    <!-- Sticky Top Bar: Info Kuis, Auto-Save Status, & Countdown Timer -->
    <header class="quiz-attempt-hero">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                
                <!-- Left: Quiz Info -->
                <div class="d-flex align-items-center gap-3.5">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center shrink-0 shadow-sm" style="background: rgba(255, 255, 255, 0.2); width: 48px; height: 48px;">
                        <i class="ti ti-checklist fs-3"></i>
                    </div>
                    <div>
                        <h1 class="fs-5 fw-bold mb-1 text-white" style="font-family: 'Jost', sans-serif;">
                            {{ $quiz->title }}
                        </h1>
                        <div class="text-white-50 small d-flex align-items-center gap-2" style="font-size: 0.82rem;">
                            <span>{{ $quiz->subject->name ?? 'Mata Pelajaran' }}</span>
                            <span>•</span>
                            <span>Total {{ $quiz->questions->count() }} Butir Soal</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Auto-Save Status & Countdown Timer -->
                <div class="d-flex flex-wrap align-items-center gap-3.5">
                    
                    <!-- Auto-Save Status Indicator -->
                    <div id="saveStatusBadge" class="sync-badge d-none d-md-inline-flex align-items-center gap-2">
                        <i class="ti ti-cloud-check text-warning fs-5" id="saveStatusIcon"></i>
                        <span id="saveStatusText" class="fw-medium">Jawaban Tersimpan Otomatis</span>
                    </div>

                    <!-- Countdown Timer -->
                    <div class="timer-badge-box d-flex align-items-center gap-2.5 text-white" id="timerContainer">
                        <i class="ti ti-clock-hour-4 fs-4 text-warning"></i>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-uppercase fw-semibold d-none d-sm-inline" style="font-size: 0.72rem; letter-spacing: 0.5px; opacity: 0.9;">Sisa Waktu:</span>
                            <span id="quizTimer" class="fs-4 fw-extrabold font-monospace text-white" style="line-height: 1;">--:--</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>

    @php
        $totalQuestions = $quiz->questions->count();
        $initialAnsweredCount = count($savedAnswers ?? []);
        $initialUnansweredCount = max(0, $totalQuestions - $initialAnsweredCount);
        $initialProgress = $totalQuestions > 0 ? round(($initialAnsweredCount / $totalQuestions) * 100) : 0;
    @endphp

    <!-- Main Content Area: 2 Kolom Rapi, Lega & Nyaman -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 2.75rem !important; padding-bottom: 3.5rem !important;">
        
        <form id="quizForm" action="{{ route('student.quizzes.submit', $quiz) }}" method="POST">
            @csrf

            <div class="row g-4 align-items-start">
                
                <!-- 1. Left Column: Lembar Soal (Satu Halaman Satu Soal, Ukuran Proporsional) -->
                <div class="col-lg-7 col-xl-8">
                    
                    @forelse($quiz->questions as $index => $question)
                        @php
                            $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
                            $currentSavedOptionId = $savedAnswers[$question->id] ?? null;
                            $stepNumber = $index + 1;
                        @endphp

                        <!-- Single Question Card Container -->
                        <div class="question-step-card {{ $index === 0 ? 'active' : '' }}" 
                             id="question-step-{{ $stepNumber }}" 
                             data-step="{{ $stepNumber }}">
                            
                            <div class="question-card-modern">
                                
                                <!-- Question Header (Kompak & Elegan) -->
                                <div class="question-card-header">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge px-2.5 py-1 rounded-pill font-bold d-inline-flex align-items-center gap-1" style="background: #2563EB; color: #ffffff; font-size: 0.8rem;">
                                            <i class="ti ti-edit fs-6"></i> Soal No. {{ $stepNumber }}
                                        </span>
                                        <span class="text-muted small fw-semibold">dari {{ $totalQuestions }} Soal</span>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-white text-primary border rounded-pill px-2.5 py-1 font-bold shadow-2xs" style="font-size: 0.76rem;">
                                            <i class="ti ti-award me-1"></i> {{ $quiz->points_per_question ?? 100 }} Poin
                                        </span>
                                    </div>
                                </div>

                                <!-- Question Body (Proporsional, Nyaman Dibaca, Tidak Perlu Scroll) -->
                                <div class="p-3.5 p-md-4 bg-white">
                                    
                                    <!-- Teks Pertanyaan Soal -->
                                    <div class="fw-bold text-dark mb-3" style="font-size: 1.05rem; line-height: 1.6; font-family: 'Jost', sans-serif;">
                                        {!! nl2br(e($question->question_text)) !!}
                                    </div>

                                    <!-- Options List (Sedikit Diperkecil Agar Pas Layar) -->
                                    <div class="d-flex flex-column mb-3">
                                        @foreach($question->options as $optIndex => $option)
                                            @php
                                                $letter = $letters[$optIndex % count($letters)];
                                                $isSelected = ($currentSavedOptionId == $option->id);
                                            @endphp

                                            <label class="quiz-option-tile {{ $isSelected ? 'selected' : '' }}" for="opt-{{ $option->id }}">
                                                <input type="radio" 
                                                       name="answers[{{ $question->id }}]" 
                                                       id="opt-{{ $option->id }}" 
                                                       value="{{ $option->id }}" 
                                                       data-question-id="{{ $question->id }}"
                                                       data-question-index="{{ $stepNumber }}"
                                                       data-option-id="{{ $option->id }}"
                                                       {{ $isSelected ? 'checked' : '' }}
                                                       class="form-check-input option-radio" 
                                                       style="width: 1.18rem; height: 1.18rem; margin-right: 1.15rem !important; cursor: pointer;">
                                                <span class="option-badge-letter">{{ $letter }}</span>
                                                <span class="text-dark fw-medium" style="font-size: 0.92rem; line-height: 1.45;">{{ $option->option_text }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                    <!-- Bottom Action & Navigation Bar (Langsung Terlihat Tanpa Scroll) -->
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                                        
                                        <!-- Tombol Sebelumnya -->
                                        @if($index > 0)
                                            <button type="button" 
                                                    onclick="goToQuestion({{ $index }})" 
                                                    class="btn btn-outline-secondary rounded-pill px-3.5 py-2 font-bold d-inline-flex align-items-center gap-1.5 hover-lift"
                                                    style="font-size: 0.88rem;">
                                                <i class="ti ti-arrow-left"></i> Soal Sebelumnya
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-light rounded-pill px-3.5 py-2 text-muted fw-semibold" disabled style="opacity: 0.5; cursor: not-allowed; font-size: 0.88rem;">
                                                <i class="ti ti-arrow-left"></i> Soal Sebelumnya
                                            </button>
                                        @endif

                                        <div class="text-muted small fw-medium" style="font-size: 0.82rem;">
                                            Nomor <strong>{{ $stepNumber }}</strong> dari <strong>{{ $totalQuestions }}</strong>
                                        </div>

                                        <!-- Tombol Selanjutnya & Tombol Selesai -->
                                        <div class="d-flex align-items-center gap-2">
                                            @if($index < $totalQuestions - 1)
                                                <button type="button" 
                                                        onclick="goToQuestion({{ $stepNumber + 1 }})" 
                                                        class="btn text-white rounded-pill px-4 py-2 font-bold d-inline-flex align-items-center gap-1.5 hover-lift"
                                                        style="background: linear-gradient(135deg, #20456E 0%, #3368A0 100%); font-size: 0.88rem;">
                                                    Soal Selanjutnya <i class="ti ti-arrow-right"></i>
                                                </button>
                                            @endif

                                            <!-- Tombol Selesai & Kumpulkan pada Soal Terakhir -->
                                            @if($index === $totalQuestions - 1)
                                                <button type="button" 
                                                        onclick="document.getElementById('submitQuizBtn').click();" 
                                                        class="btn text-white rounded-pill px-4 py-2 font-bold d-inline-flex align-items-center gap-1.5 hover-lift shadow-sm"
                                                        style="background: linear-gradient(135deg, #059669 0%, #10B981 100%); font-size: 0.88rem;">
                                                    <i class="ti ti-circle-check"></i> Selesai & Kumpulkan
                                                </button>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="card border-0 rounded-4 shadow-sm text-center py-5">
                            <div class="card-body p-5">
                                <i class="ti ti-alert-triangle text-warning mb-2" style="font-size: 3rem;"></i>
                                <h4 class="fw-bold">Tidak ada butir soal dalam kuis ini.</h4>
                            </div>
                        </div>
                    @endforelse

                    <!-- Hidden actual submit button for modal confirmation -->
                    <button type="submit" 
                            id="submitQuizBtn" 
                            class="d-none"
                            onclick="return confirm('Apakah Anda yakin ingin mengumpulkan seluruh jawaban kuis ini? Setelah dikumpulkan, Anda tidak dapat mengubah jawaban.')">
                    </button>

                </div>

                <!-- 2. Right Column: Navigasi Soal (Question Palette) & Keterangan Warna (Legend) Lega & Luas -->
                <div class="col-lg-5 col-xl-4">
                    <aside class="palette-sticky-card">
                        
                        <!-- Palette Header -->
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2.5 border-bottom" style="border-color: rgba(51, 104, 160, 0.12) !important;">
                            <div class="d-flex align-items-center gap-2.5">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #20456E, #3368A0); width: 34px; height: 34px;">
                                    <i class="ti ti-layout-grid fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif; font-size: 1.05rem;">
                                        Navigasi Soal
                                    </h6>
                                    <div class="text-muted small" style="font-size: 0.76rem;">Klik nomor untuk menuju soal</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill px-3 py-1 font-bold small" style="background: rgba(51, 104, 160, 0.1); color: #20456E;">
                                {{ $totalQuestions }} Butir
                            </span>
                        </div>

                        <!-- Progress Bar Pengerjaan (Berjarak Lega ke Kotak Nomor Soal) -->
                        <div class="mb-4 pb-1">
                            <div class="d-flex align-items-center justify-content-between small text-muted mb-2">
                                <span class="fw-semibold">Progres Pengerjaan</span>
                                <span class="fw-bold text-primary" id="progressPercentageText">{{ $initialProgress }}%</span>
                            </div>
                            <div class="progress" style="height: 7px; border-radius: 50rem; background-color: #E2E8F0;">
                                <div id="progressBarFill" 
                                     class="progress-bar rounded-pill" 
                                     role="progressbar" 
                                     style="width: {{ $initialProgress }}%; background: linear-gradient(90deg, #3368A0, #10B981);" 
                                     aria-valuenow="{{ $initialProgress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <!-- Grid Nomor Soal (Lega & Simetris) -->
                        <div class="palette-grid mb-3.5" id="questionPaletteGrid">
                            @foreach($quiz->questions as $index => $q)
                                @php
                                    $num = $index + 1;
                                    $isAnswered = isset($savedAnswers[$q->id]) && !empty($savedAnswers[$q->id]);
                                    $isFirst = ($index === 0);
                                @endphp
                                <button type="button" 
                                        id="nav-num-{{ $num }}" 
                                        onclick="goToQuestion({{ $num }})" 
                                        class="nav-question-btn {{ $isFirst ? 'nav-btn-current' : ($isAnswered ? 'nav-btn-answered' : 'nav-btn-unanswered') }}"
                                        title="Buka Soal {{ $num }} ({{ $isAnswered ? 'Sudah Dijawab' : 'Belum Dijawab' }})">
                                    {{ $num }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Divider -->
                        <hr class="my-3" style="border-color: rgba(51, 104, 160, 0.12);">

                        <!-- Keterangan Warna (Legend) Lega di Bawah Navigasi Soal -->
                        <div class="mb-3.5">
                            <div class="text-uppercase fw-bold text-secondary mb-2" style="font-size: 0.72rem; letter-spacing: 0.6px;">
                                <i class="ti ti-info-circle me-1"></i> Keterangan Warna
                            </div>

                            <div class="d-flex flex-column gap-2">
                                
                                <!-- Legend 1: Sedang Dikerjakan (BIRU) -->
                                <div class="legend-box-item" style="background: rgba(37, 99, 235, 0.06); border-color: rgba(37, 99, 235, 0.25);">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="legend-indicator-dot dot-current"></div>
                                        <div class="small fw-bold text-primary">Sedang Dikerjakan</div>
                                    </div>
                                    <span id="legendCurrentNum" class="badge rounded-pill px-2.5 py-1 text-white font-bold" style="background-color: #2563EB; font-size: 0.75rem;">
                                        No. 1
                                    </span>
                                </div>

                                <!-- Legend 2: Sudah Dijawab (HIJAU) -->
                                <div class="legend-box-item">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="legend-indicator-dot dot-answered"></div>
                                        <div class="small fw-semibold text-dark">Sudah Dijawab</div>
                                    </div>
                                    <span id="legendAnsweredCount" class="badge rounded-pill px-2.5 py-1 text-white font-bold" style="background-color: #10B981; font-size: 0.75rem;">
                                        {{ $initialAnsweredCount }} Soal
                                    </span>
                                </div>

                                <!-- Legend 3: Belum Dijawab (ABU-ABU) -->
                                <div class="legend-box-item">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="legend-indicator-dot dot-unanswered"></div>
                                        <div class="small fw-semibold text-dark">Belum Dijawab</div>
                                    </div>
                                    <span id="legendUnansweredCount" class="badge rounded-pill px-2.5 py-1 text-secondary font-bold" style="background-color: #E2E8F0; color: #475569 !important; font-size: 0.75rem;">
                                        {{ $initialUnansweredCount }} Soal
                                    </span>
                                </div>

                        <!-- Divider Antara Legenda & Tombol Kumpulkan -->
                        <hr class="my-4" style="border-color: rgba(51, 104, 160, 0.12);">

                        <!-- Sidebar Quick Submit Button (Berjarak Lega & Nyaman) -->
                        <div class="pt-1">
                            <button type="button" 
                                    onclick="document.getElementById('submitQuizBtn').click();" 
                                    class="btn btn-outline-success w-100 rounded-pill py-2.5 font-bold shadow-2xs d-flex align-items-center justify-content-center gap-2 hover-lift"
                                    style="font-size: 0.9rem;">
                                <i class="ti ti-check"></i> Kumpulkan Kuis
                            </button>
                        </div>

                    </aside>
                </div>

            </div>

        </form>

    </div>

    <!-- Countdown Timer, Single-Question Stepper, Auto-Save & Navigation Sync JavaScript -->
    <script>
        const totalQuestions = {{ (int)$totalQuestions }};
        const saveAnswerUrl = "{{ route('student.quizzes.save-answer', $quiz) }}";
        const csrfToken = "{{ csrf_token() }}";

        let currentQuestion = 1;
        const answeredSet = new Set();

        // Populate initially answered question numbers
        @foreach($quiz->questions as $index => $q)
            @if(isset($savedAnswers[$q->id]) && !empty($savedAnswers[$q->id]))
                answeredSet.add({{ $index + 1 }});
            @endif
        @endforeach

        // 1. Single Question Navigation (Satu Halaman Satu Soal)
        function goToQuestion(targetNum) {
            if (targetNum < 1 || targetNum > totalQuestions) return;

            // Sembunyikan semua kartu soal, tampilkan target
            document.querySelectorAll('.question-step-card').forEach(card => {
                card.classList.remove('active');
            });
            const targetCard = document.getElementById('question-step-' + targetNum);
            if (targetCard) {
                targetCard.classList.add('active');
            }

            // Perbarui styling tombol nomor di Navigasi Soal
            const prevNavBtn = document.getElementById('nav-num-' + currentQuestion);
            if (prevNavBtn) {
                prevNavBtn.classList.remove('nav-btn-current');
                if (answeredSet.has(currentQuestion)) {
                    prevNavBtn.classList.add('nav-btn-answered');
                    prevNavBtn.classList.remove('nav-btn-unanswered');
                } else {
                    prevNavBtn.classList.add('nav-btn-unanswered');
                    prevNavBtn.classList.remove('nav-btn-answered');
                }
            }

            // Tandai tombol yang dituju dengan WARNA BIRU (nav-btn-current)
            currentQuestion = targetNum;
            const currentNavBtn = document.getElementById('nav-num-' + currentQuestion);
            if (currentNavBtn) {
                currentNavBtn.classList.remove('nav-btn-answered', 'nav-btn-unanswered');
                currentNavBtn.classList.add('nav-btn-current');
            }

            // Perbarui badge nomor aktif di Legenda
            const legendCurrentBadge = document.getElementById('legendCurrentNum');
            if (legendCurrentBadge) {
                legendCurrentBadge.innerText = 'No. ' + currentQuestion;
            }
        }

        function updateLegendAndProgress() {
            const answeredCount = answeredSet.size;
            const unansweredCount = Math.max(0, totalQuestions - answeredCount);
            const percent = totalQuestions > 0 ? Math.round((answeredCount / totalQuestions) * 100) : 0;

            // Update Legend Badges
            const legendAnsweredEl = document.getElementById('legendAnsweredCount');
            const legendUnansweredEl = document.getElementById('legendUnansweredCount');
            if (legendAnsweredEl) legendAnsweredEl.innerText = answeredCount + ' Soal';
            if (legendUnansweredEl) legendUnansweredEl.innerText = unansweredCount + ' Soal';

            // Update Progress Bar
            const progressFill = document.getElementById('progressBarFill');
            const progressText = document.getElementById('progressPercentageText');
            if (progressFill) progressFill.style.width = percent + '%';
            if (progressText) progressText.innerText = percent + '%';
        }

        function setSyncStatus(status) {
            const badge = document.getElementById('saveStatusBadge');
            const icon = document.getElementById('saveStatusIcon');
            const text = document.getElementById('saveStatusText');
            if (!badge) return;

            if (status === 'saving') {
                badge.classList.remove('d-none');
                icon.className = 'ti ti-loader ti-spin text-warning fs-6';
                text.innerText = 'Menyimpan jawaban...';
            } else if (status === 'saved') {
                badge.classList.remove('d-none');
                icon.className = 'ti ti-cloud-check text-success fs-6';
                text.innerText = 'Jawaban tersimpan otomatis';
            } else if (status === 'error') {
                badge.classList.remove('d-none');
                icon.className = 'ti ti-alert-circle text-danger fs-6';
                text.innerText = 'Koneksi terganggu';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // 2. Interactive Radio Selection & AJAX Auto-Save
            const radioInputs = document.querySelectorAll('.option-radio');

            radioInputs.forEach(radio => {
                radio.addEventListener('change', function () {
                    const questionCard = this.closest('.question-step-card');
                    if (questionCard) {
                        const tiles = questionCard.querySelectorAll('.quiz-option-tile');
                        tiles.forEach(t => t.classList.remove('selected'));
                    }
                    const parentTile = this.closest('.quiz-option-tile');
                    if (parentTile) {
                        parentTile.classList.add('selected');
                    }

                    const qIndex = parseInt(this.getAttribute('data-question-index'));
                    const qId = this.getAttribute('data-question-id');
                    const optId = this.getAttribute('data-option-id');

                    answeredSet.add(qIndex);
                    updateLegendAndProgress();

                    // Send AJAX Auto-Save to Server
                    setSyncStatus('saving');
                    fetch(saveAnswerUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            question_id: qId,
                            option_id: optId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'expired') {
                            alert('Batas waktu kuis telah berakhir. Lembar kuis akan otomatis dikumpulkan.');
                            document.getElementById('quizForm').submit();
                        } else {
                            setSyncStatus('saved');
                        }
                    })
                    .catch(err => {
                        console.warn('Auto-save error:', err);
                        setSyncStatus('error');
                    });
                });
            });

            // 3. Real-Time Countdown Timer (Persistent server countdown & browser state)
            const serverRemainingSeconds = {{ (int)$remainingSeconds }};
            const storageKey = 'quiz_end_{{ $quiz->id }}_{{ $attempt->id }}';

            // Hitung target waktu selesai berbasis timestamp server dan clock client
            let targetEndTime = Date.now() + (serverRemainingSeconds * 1000);

            // Sinkronisasi dengan localStorage jika kuis sedang berjalan (agar transisi refresh mulus tanpa lag)
            const storedEndTime = parseInt(localStorage.getItem(storageKey), 10);
            if (storedEndTime && Math.abs(storedEndTime - targetEndTime) < 5000) {
                targetEndTime = storedEndTime;
            } else {
                localStorage.setItem(storageKey, targetEndTime);
            }

            const timerElement = document.getElementById('quizTimer');
            const timerContainer = document.getElementById('timerContainer');
            const quizForm = document.getElementById('quizForm');
            let autoSubmitted = false;

            function updateTimer() {
                const now = Date.now();
                const remaining = Math.max(0, Math.floor((targetEndTime - now) / 1000));

                if (remaining <= 0) {
                    timerElement.innerText = "00:00";
                    localStorage.removeItem(storageKey);
                    if (!autoSubmitted) {
                        autoSubmitted = true;
                        alert('Waktu pengerjaan kuis telah habis! Jawaban Anda akan otomatis dikumpulkan ke sistem.');
                        quizForm.submit();
                    }
                    return;
                }

                if (remaining <= 300 && timerContainer) {
                    timerContainer.classList.add('timer-warning');
                }

                const hours = Math.floor(remaining / 3600);
                const minutes = Math.floor((remaining % 3600) / 60);
                const seconds = remaining % 60;

                if (hours > 0) {
                    timerElement.innerText = 
                        String(hours).padStart(2, '0') + ':' +
                        String(minutes).padStart(2, '0') + ':' + 
                        String(seconds).padStart(2, '0');
                } else {
                    timerElement.innerText = 
                        String(minutes).padStart(2, '0') + ':' + 
                        String(seconds).padStart(2, '0');
                }
            }

            // Bersihkan storage ketika form dikumpulkan
            if (quizForm) {
                quizForm.addEventListener('submit', function () {
                    localStorage.removeItem(storageKey);
                });
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>
</x-app-layout>
