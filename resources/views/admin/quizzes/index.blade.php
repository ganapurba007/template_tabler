<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Master Data — Kuis Evaluation') }}
            </h2>
            <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus me-1"></i> Buat Kuis Baru
            </a>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="ti ti-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 70px;">ID</th>
                                    <th>Judul Kuis</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas Target</th>
                                    <th>Durasi & Poin</th>
                                    <th>Jumlah Soal</th>
                                    <th>Batas Waktu</th>
                                    <th class="pe-4 text-end" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quizzes as $quiz)
                                    <tr>
                                        <td class="ps-4 fw-bold">#{{ $quiz->id }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $quiz->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6">
                                                {{ $quiz->subject->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info px-2 py-1 fs-6">
                                                {{ $quiz->schoolClass->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small fw-semibold text-dark"><i class="ti ti-clock me-1"></i> {{ $quiz->duration_minutes }} Menit</div>
                                            <div class="small text-muted">{{ $quiz->points_per_question }} Poin/Soal</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-6">
                                                {{ $quiz->questions_count }} Soal
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small text-danger fw-semibold">
                                                {{ $quiz->deadline ? $quiz->deadline->format('d M Y H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('admin.quizzes.show', $quiz) }}" class="btn btn-sm btn-outline-info" title="Kelola Soal Kuis">
                                                    <i class="ti ti-list-check"></i>
                                                </a>
                                                <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-sm btn-outline-primary" title="Edit Kuis">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}" onsubmit="return confirm('Hapus kuis ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">Belum ada kuis yang dibuat. Silakan buat kuis baru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($quizzes->hasPages())
                    <div class="card-footer bg-white d-flex justify-content-end py-3">
                        {{ $quizzes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
