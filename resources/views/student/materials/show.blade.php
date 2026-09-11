<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $material->title }}
            </h2>
            <a href="{{ route('student.materials.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Materi
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

            <!-- Material Detail Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary-subtle text-primary me-2">{{ $material->subject->name ?? '-' }}</span>
                        <span class="text-muted small"><i class="ti ti-user me-1"></i> Pengajar: {{ $material->instructor->name ?? '-' }}</span>
                    </div>

                    <form action="{{ route('student.materials.complete', $material) }}" method="POST">
                        @csrf
                        @if($isCompleted)
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="ti ti-check me-1"></i> Selesai Dipelajari
                            </button>
                        @else
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="ti ti-circle me-1"></i> Tandai Selesai
                            </button>
                        @endif
                    </form>
                </div>

                <div class="card-body p-4">
                    <!-- Content Viewer: Show all available components -->
                    @if($material->video_url)
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2"><i class="ti ti-brand-youtube me-1 text-danger"></i> Video Pembelajaran</h6>
                            <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                                @php
                                    $embedUrl = $material->video_url;
                                    if (str_contains($embedUrl, 'watch?v=')) {
                                        $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                                    }
                                @endphp
                                <iframe src="{{ $embedUrl }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                    @if($material->content)
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2"><i class="ti ti-file-text me-1 text-success"></i> Isi / Artikel Materi</h6>
                            <div class="p-3 bg-light rounded text-dark fs-6" style="line-height: 1.7;">
                                {!! nl2br(e($material->content)) !!}
                            </div>
                        </div>
                    @endif

                    @if($material->document_path)
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2"><i class="ti ti-file-download me-1 text-warning"></i> Lampiran Dokumen</h6>
                            <div class="p-4 text-center bg-light rounded border">
                                <i class="ti ti-file-text fs-1 text-warning d-block mb-2"></i>
                                <h6 class="fw-bold mb-2">Dokumen Pembelajaran</h6>
                                <a href="{{ asset('storage/'.$material->document_path) }}" target="_blank" class="btn btn-warning px-4">
                                    <i class="ti ti-download me-1"></i> Unduh / Buka Dokumen
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(!$material->video_url && !$material->content && !$material->document_path)
                        <div class="text-center py-4 text-muted">Belum ada konten pada materi ini.</div>
                    @endif
                </div>
            </div>

            <!-- Realtime Discussion Room Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">
                        <i class="ti ti-messages me-2 text-primary"></i> Ruang Diskusi Realtime
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Discussion Comments List -->
                    <div id="discussion-list" class="mb-4" style="max-height: 400px; overflow-y: auto;">
                        @forelse($material->discussions as $disc)
                            <div class="d-flex gap-3 mb-3 p-3 bg-light rounded">
                                <div class="avatar-icon-box avatar-icon-primary rounded-circle align-self-start">
                                    <i class="ti ti-user"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="fw-bold text-dark me-2">
                                            {{ $disc->user->name ?? '-' }}
                                            <span class="badge bg-secondary-subtle text-secondary small ms-1">{{ ucfirst($disc->user->role->name ?? '') }}</span>
                                        </div>
                                        <span class="text-muted small">{{ $disc->created_at ? $disc->created_at->diffForHumans() : '' }}</span>
                                    </div>
                                    <p class="text-secondary mb-0 small">{{ $disc->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small" id="no-comments-msg">
                                Belum ada komentar di ruang diskusi ini. Jadilah yang pertama memberikan tanggapan!
                            </div>
                        @endforelse
                    </div>

                    <!-- Comment Input Form -->
                    <form action="{{ route('student.materials.discussions', $material) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="comment" class="form-control @error('comment') is-invalid @enderror" placeholder="Tuliskan pertanyaan atau tanggapan Anda..." required>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-send me-1"></i> Kirim
                            </button>
                        </div>
                        @error('comment')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
