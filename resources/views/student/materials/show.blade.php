<x-app-layout>
    <!-- Include Bootstrap, Tabler Icons & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <style>
        .material-detail-hero {
            background: linear-gradient(135deg, #20456E 0%, #3368A0 55%, #2b5788 100%);
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid #66A3BF;
            color: #ffffff;
        }
        .material-detail-hero::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background: radial-gradient(circle, rgba(102, 163, 191, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }
        .content-card-modern {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(51, 104, 160, 0.12);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 1.75rem;
            transition: border-color 0.2s ease;
        }
        .content-card-modern:hover {
            border-color: rgba(102, 163, 191, 0.35);
        }
        .content-card-header {
            padding: 1.25rem 1.5rem;
            background: #F2EFE7;
            border-bottom: 1px solid rgba(51, 104, 160, 0.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .article-body {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #334155;
        }
        .article-body p {
            margin-bottom: 1.25rem;
        }
        .article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin: 1rem 0;
        }
        .article-body pre, .article-body code {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 0.2rem 0.4rem;
            font-size: 0.9em;
            color: #0f172a;
        }
        .article-body blockquote {
            border-left: 4px solid #3368A0;
            padding-left: 1rem;
            color: #475569;
            font-style: italic;
            margin: 1.25rem 0;
        }
        .comment-bubble {
            background: #F8FAFC;
            border: 1px solid rgba(51, 104, 160, 0.1);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            transition: all 0.2s ease;
        }
        .comment-bubble:hover {
            background: #ffffff;
            border-color: rgba(51, 104, 160, 0.25);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .sidebar-sticky-box {
            position: sticky;
            top: 6.5rem;
        }
    </style>

    <!-- 1. Dedicated Material Detail Page Hero -->
    <section class="material-detail-hero py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 position-relative z-1">
            
            <!-- Breadcrumbs & Badges -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span class="badge px-3 py-1.5 rounded-pill shadow-sm font-bold d-inline-flex align-items-center gap-1.5" style="background-color: #F2EFE7; color: #20456E !important; font-size: 0.8rem;">
                        <i class="ti ti-tag text-primary"></i> {{ $material->subject->name ?? 'Mata Pelajaran' }}
                    </span>
                    <span class="badge px-3 py-1.5 rounded-pill shadow-sm font-semibold d-inline-flex align-items-center gap-1.5" style="background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(8px); font-size: 0.8rem;">
                        <i class="ti ti-school"></i> Kelas {{ $material->schoolClass->name ?? 'Siswa' }}
                    </span>
                    <span class="badge px-3 py-1.5 rounded-pill font-semibold d-inline-flex align-items-center gap-1" style="background: rgba(255, 255, 255, 0.15); font-size: 0.8rem;">
                        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none opacity-80 hover:opacity-100">Dashboard</a>
                        <i class="ti ti-chevron-right fs-6"></i>
                        <a href="{{ route('student.materials.index') }}" class="text-white text-decoration-none opacity-80 hover:opacity-100">Courses / Materi</a>
                        <i class="ti ti-chevron-right fs-6"></i>
                        <span class="text-white font-bold">Detail Materi</span>
                    </span>
                </div>

                <!-- Back to Index Button -->
                <div>
                    <a href="{{ route('student.materials.index') }}" 
                       class="btn btn-sm rounded-pill px-3.5 py-1.5 font-bold d-inline-flex align-items-center gap-1.5 text-white text-decoration-none shadow-sm" 
                       style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.4); backdrop-filter: blur(6px);">
                        <i class="ti ti-arrow-left"></i> Kembali ke Daftar Materi
                    </a>
                </div>
            </div>

            <!-- Material Title Header -->
            <div class="row align-items-center g-4 mt-1">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-extrabold mb-3 text-white" style="font-family: 'Jost', sans-serif; letter-spacing: -0.5px; line-height: 1.25;">
                        {{ $material->title }}
                    </h1>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3 text-white-50 small">
                        <span class="d-inline-flex align-items-center gap-1.5 text-white">
                            <i class="ti ti-user-circle fs-5 text-warning"></i>
                            <strong>{{ $material->instructor->name ?? 'Guru Pengampu' }}</strong>
                        </span>
                        <span>•</span>
                        <span>
                            <i class="ti ti-calendar me-1"></i> {{ $material->created_at ? $material->created_at->format('d F Y') : '-' }}
                        </span>
                        <span>•</span>
                        <span>
                            <i class="ti ti-messages me-1"></i> {{ $material->discussions->count() }} Diskusi
                        </span>
                    </div>
                </div>

                <!-- Hero Right: Spacious Status Indicator Badge -->
                <div class="col-lg-4 text-lg-end">
                    <div class="d-inline-flex align-items-center gap-3 shadow-sm border" 
                         style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-color: rgba(255, 255, 255, 0.6) !important; border-radius: 50rem; padding: 8px 12px 8px 22px;">
                        <span class="text-secondary fw-bold text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.8px;">Status:</span>
                        @if($isCompleted)
                            <span class="badge bg-success rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 font-bold shadow-sm" style="font-size: 0.85rem;">
                                <i class="ti ti-circle-check fs-6"></i> Selesai Dipelajari
                            </span>
                        @else
                            <span class="badge rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 font-bold" style="background: #e2e8f0; color: #475569; font-size: 0.85rem;">
                                <i class="ti ti-clock fs-6"></i> Belum Ditinjau
                            </span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        
        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-2 p-3 p-md-4" role="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0 !important;">
                <i class="ti ti-circle-check fs-4"></i>
                <div class="fw-semibold">{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            
            <!-- Left Main Column (Video, Modul Content, Documents, Discussions) -->
            <div class="col-lg-8">
                
                <!-- 2.1 Video Pembelajaran Embed (If Available) -->
                @if($material->video_url)
                    <div class="content-card-modern">
                        <div class="content-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: #DC2626; width: 32px; height: 32px;">
                                    <i class="ti ti-brand-youtube fs-5"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif; font-size: 1.1rem;">
                                    Video Pembelajaran
                                </h5>
                            </div>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 font-bold small">
                                Video Interaktif
                            </span>
                        </div>
                        <div class="p-3 p-md-4">
                            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm border">
                                @php
                                    $embedUrl = $material->video_url;
                                    if (str_contains($embedUrl, 'watch?v=')) {
                                        $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                                    } elseif (str_contains($embedUrl, 'youtu.be/')) {
                                        $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $embedUrl);
                                    }
                                @endphp
                                <iframe src="{{ $embedUrl }}" title="{{ $material->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 2.2 Isi / Artikel Modul Materi -->
                @if($material->content)
                    <div class="content-card-modern">
                        <div class="content-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #3368A0, #66A3BF); width: 32px; height: 32px;">
                                    <i class="ti ti-file-text fs-5"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif; font-size: 1.1rem;">
                                    Isi & Uraian Modul Pembelajaran
                                </h5>
                            </div>
                            <span class="badge rounded-pill px-3 py-1 font-bold small" style="background: rgba(51, 104, 160, 0.1); color: #3368A0;">
                                <i class="ti ti-book-2 me-1"></i> Modul Mandiri
                            </span>
                        </div>
                        <div class="p-4 p-md-5">
                            <div class="article-body">
                                {!! $material->content !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 2.3 Lampiran Dokumen Pembelajaran (If Available) -->
                @if($material->document_path)
                    <div class="content-card-modern">
                        <div class="content-card-header">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: #D97706; width: 32px; height: 32px;">
                                    <i class="ti ti-file-download fs-5"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif; font-size: 1.1rem;">
                                    Lampiran Berkas & Dokumen Panduan
                                </h5>
                            </div>
                            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-1 font-bold small">
                                PDF / Dokumen
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between p-4 rounded-4 border gap-3" style="background: #F8FAFC;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 text-white d-flex align-items-center justify-content-center shadow-sm shrink-0" style="background: linear-gradient(135deg, #D97706, #F59E0B); width: 48px; height: 48px;">
                                        <i class="ti ti-file-type-pdf fs-2"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark">Dokumen Pendukung Materi</h6>
                                        <div class="text-muted small">Unduh materi ini untuk membaca secara offline tanpa koneksi internet.</div>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <a href="{{ asset('storage/'.$material->document_path) }}" target="_blank" class="btn text-white rounded-pill px-4 py-2.5 font-bold shadow-sm d-inline-flex align-items-center gap-2 hover-lift" style="background: linear-gradient(135deg, #D97706, #F59E0B);">
                                        <i class="ti ti-download fs-5"></i> Unduh Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Empty State if no media content is present -->
                @if(!$material->video_url && !$material->content && !$material->document_path)
                    <div class="content-card-modern p-5 text-center text-muted">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="background: rgba(51, 104, 160, 0.08); width: 70px; height: 70px;">
                            <i class="ti ti-book-off fs-2 text-secondary"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Belum Ada Konten Pembelajaran</h5>
                        <p class="small text-muted mb-0">Guru pengampu belum melampirkan teks modul, video, atau dokumen pada topik materi ini.</p>
                    </div>
                @endif

                <!-- 2.4 Ruang Diskusi Interaktif Realtime -->
                <div class="content-card-modern">
                    <div class="content-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #059669, #10B981); width: 32px; height: 32px;">
                                <i class="ti ti-messages fs-5"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif; font-size: 1.1rem;">
                                Ruang Diskusi & Tanya Jawab
                            </h5>
                        </div>
                        <span class="badge rounded-pill px-3 py-1 font-bold small" style="background: rgba(16, 185, 129, 0.12); color: #059669;">
                            <i class="ti ti-users me-1"></i> Diskusi Kelas
                        </span>
                    </div>

                    <div class="p-4 p-md-5">
                        
                        <!-- Discussion Comments Feed Container -->
                        <div id="discussion-list" class="d-flex flex-column gap-3 mb-4" style="max-height: 480px; overflow-y: auto; padding-right: 0.5rem;">
                            @forelse($material->discussions as $disc)
                                @php
                                    $isTeacherComment = ($disc->user->role->name ?? '') === 'guru';
                                @endphp
                                <div class="comment-bubble d-flex gap-3 {{ $isTeacherComment ? 'border-primary-subtle' : '' }}" style="{{ $isTeacherComment ? 'background: #eff6ff;' : '' }}">
                                    <!-- Avatar -->
                                    <div class="comment-avatar text-white shadow-sm" style="background: {{ $isTeacherComment ? 'linear-gradient(135deg, #1e40af, #3b82f6)' : 'linear-gradient(135deg, #0f766e, #14b8a6)' }};">
                                        {{ strtoupper(substr($disc->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    
                                    <!-- Body -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1.5">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold text-dark fs-6">{{ $disc->user->name ?? 'Pengguna' }}</span>
                                                <span class="badge rounded-pill px-2 py-0.5 text-uppercase font-bold" style="font-size: 0.65rem; background: {{ $isTeacherComment ? '#3b82f6' : '#64748b' }}; color: #ffffff;">
                                                    {{ $disc->user->role->name ?? 'Siswa' }}
                                                </span>
                                            </div>
                                            <span class="text-muted small" style="font-size: 0.72rem;">
                                                <i class="ti ti-clock me-1"></i> {{ $disc->created_at ? $disc->created_at->diffForHumans() : '' }}
                                            </span>
                                        </div>
                                        <p class="text-secondary mb-0 small" style="line-height: 1.6; white-space: pre-line;">{{ $disc->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted small" id="no-comments-msg">
                                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="background: rgba(51, 104, 160, 0.06); width: 50px; height: 50px;">
                                        <i class="ti ti-message-2-plus fs-3 text-muted"></i>
                                    </div>
                                    <p class="fw-medium text-secondary mb-1">Belum ada tanggapan atau pertanyaan di materi ini.</p>
                                    <span class="text-muted small">Jadilah yang pertama memulai diskusi interaktif bersama guru dan teman sekelas!</span>
                                </div>
                            @endforelse
                        </div>

                        <!-- Comment Input Form -->
                        <form action="{{ route('student.materials.discussions', $material) }}" method="POST" class="pt-3 border-top" style="border-color: rgba(51, 104, 160, 0.12) !important;">
                            @csrf
                            <label class="form-label small fw-bold text-dark mb-2">Tulis Tanggapan atau Pertanyaan:</label>
                            <div class="input-group shadow-sm rounded-4 overflow-hidden border" style="border-color: rgba(51, 104, 160, 0.25) !important;">
                                <input type="text" 
                                       name="comment" 
                                       class="form-control border-0 px-3.5 py-3 shadow-none @error('comment') is-invalid @enderror" 
                                       placeholder="Ketik pertanyaan seputar materi ini..." 
                                       required>
                                <button type="submit" class="btn text-white px-4 font-bold d-flex align-items-center gap-1.5 shadow-none" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%);">
                                    <i class="ti ti-send"></i> Kirim
                                </button>
                            </div>
                            @error('comment')
                                <div class="text-danger small mt-1.5 fw-semibold">{{ $message }}</div>
                            @enderror
                        </form>

                    </div>
                </div>

            </div>

            <!-- Right Sidebar Column (Sticky Progress, Teacher Card, Quick Navigation) -->
            <div class="col-lg-4">
                <div class="sidebar-sticky-box">
                    
                    <!-- Sidebar Card 1: Status & Progres Pembelajaran -->
                    <div class="content-card-modern p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: rgba(51, 104, 160, 0.12) !important;">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #3368A0, #66A3BF); width: 34px; height: 34px;">
                                <i class="ti ti-list-check fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif;">Status Penyelesaian</h6>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small">Status Materi:</span>
                                @if($isCompleted)
                                    <span class="badge bg-success rounded-pill px-3 py-1 font-bold">
                                        <i class="ti ti-check me-1"></i> Tuntas Dipelajari
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-1 font-bold" style="background: #F2EFE7; color: #D97706; border: 1px solid rgba(217, 119, 6, 0.3);">
                                        <i class="ti ti-clock me-1"></i> Sedang Dipelajari
                                    </span>
                                @endif
                            </div>

                            <div class="p-3 rounded-3 mb-3" style="background: #F8FAFC; border: 1px dashed rgba(51, 104, 160, 0.2);">
                                <div class="small text-muted mb-1"><i class="ti ti-info-circle text-primary me-1"></i> Panduan Progres:</div>
                                <div class="small text-secondary" style="font-size: 0.8rem; line-height: 1.5;">
                                    Pastikan kamu telah menyimak seluruh isi artikel atau video pembelajaran di modul ini sebelum menandai tuntas.
                                </div>
                            </div>

                            <form action="{{ route('student.materials.complete', $material) }}" method="POST">
                                @csrf
                                @if($isCompleted)
                                    <button type="submit" class="btn btn-outline-success w-100 rounded-pill py-2.5 font-bold d-flex align-items-center justify-content-center gap-2">
                                        <i class="ti ti-circle-check fs-5"></i> Selesai Dipelajari (Batalkan)
                                    </button>
                                @else
                                    <button type="submit" class="btn text-white w-100 rounded-pill py-2.5 font-bold shadow-sm d-flex align-items-center justify-content-center gap-2 hover-lift" style="background: linear-gradient(135deg, #059669 0%, #10B981 100%);">
                                        <i class="ti ti-check fs-5"></i> Tandai Selesai Dipelajari
                                    </button>
                                @endif
                            </form>
                        </div>

                        <!-- Checkpoint Checklist -->
                        <div class="pt-3 border-top" style="border-color: rgba(51, 104, 160, 0.1) !important;">
                            <div class="d-flex align-items-center gap-2 small text-success mb-2">
                                <i class="ti ti-circle-check-filled"></i> Modul materi terbuka
                            </div>
                            <div class="d-flex align-items-center gap-2 small {{ ($material->video_url || $material->content) ? 'text-success' : 'text-muted' }} mb-2">
                                <i class="ti {{ ($material->video_url || $material->content) ? 'ti-circle-check-filled' : 'ti-circle' }}"></i> Pelajari konten materi
                            </div>
                            <div class="d-flex align-items-center gap-2 small {{ $isCompleted ? 'text-success' : 'text-muted' }}">
                                <i class="ti {{ $isCompleted ? 'ti-circle-check-filled' : 'ti-circle' }}"></i> Konfirmasi tuntas selesai
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Card 2: Profil Guru Pengampu -->
                    <div class="content-card-modern p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: rgba(51, 104, 160, 0.12) !important;">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #3368A0, #66A3BF); width: 34px; height: 34px;">
                                <i class="ti ti-user fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-0 text-dark" style="font-family: 'Jost', sans-serif;">Guru Pengampu</h6>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center shadow-sm shrink-0" style="background: linear-gradient(135deg, #3368A0, #66A3BF); width: 48px; height: 48px; font-size: 1.1rem;">
                                {{ strtoupper(substr($material->instructor->name ?? 'G', 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <div class="fw-bold text-dark text-truncate fs-6">{{ $material->instructor->name ?? 'Guru Pengampu' }}</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">
                                    NIP: {{ $material->instructor->nip ?? '-' }}
                                </div>
                                <span class="badge rounded-pill px-2 py-0.5 mt-1" style="background: rgba(51, 104, 160, 0.1); color: #3368A0; font-size: 0.68rem;">
                                    Guru Mata Pelajaran
                                </span>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex justify-content-between text-muted small" style="border-color: rgba(51, 104, 160, 0.1) !important;">
                            <span>Email:</span>
                            <span class="text-dark fw-semibold text-truncate ms-2">{{ $material->instructor->email ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Sidebar Card 3: Pintasan Pembelajaran -->
                    <div class="content-card-modern p-4">
                        <h6 class="fw-bold text-dark mb-3" style="font-family: 'Jost', sans-serif;">Pintasan Menu Belajar</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('student.materials.index') }}" class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between small fw-semibold text-dark hover-lift">
                                <span><i class="ti ti-books text-primary me-2"></i> Semua Modul Kelas</span>
                                <i class="ti ti-chevron-right text-muted"></i>
                            </a>
                            <a href="{{ route('student.assignments.index') }}" class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between small fw-semibold text-dark hover-lift">
                                <span><i class="ti ti-clipboard-list text-success me-2"></i> Tugas Kelas Saya</span>
                                <i class="ti ti-chevron-right text-muted"></i>
                            </a>
                            <a href="{{ route('student.quizzes.index') }}" class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between small fw-semibold text-dark hover-lift">
                                <span><i class="ti ti-help-hexagon text-warning me-2"></i> Kuis Online Aktif</span>
                                <i class="ti ti-chevron-right text-muted"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
