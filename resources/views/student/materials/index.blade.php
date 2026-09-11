<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Materi Pembelajaran Kelas Saya') }}
            </h2>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Judul Materi</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tipe Konten</th>
                                    <th>Pengajar</th>
                                    <th>Status Penyelesaian</th>
                                    <th class="pe-4 text-end" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materials as $mat)
                                    @php
                                        $isDone = in_array($mat->id, $completedIds);
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $mat->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6">
                                                {{ $mat->subject->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($mat->content_type === 'text')
                                                <span class="badge bg-success px-2 py-1"><i class="ti ti-file-text me-1"></i> Teks</span>
                                            @elseif($mat->content_type === 'document')
                                                <span class="badge bg-warning text-dark px-2 py-1"><i class="ti ti-file-download me-1"></i> Dokumen</span>
                                            @elseif($mat->content_type === 'youtube')
                                                <span class="badge bg-danger px-2 py-1"><i class="ti ti-brand-youtube me-1"></i> YouTube</span>
                                            @endif
                                        </td>
                                        <td>{{ $mat->instructor->name ?? '-' }}</td>
                                        <td>
                                            @if($isDone)
                                                <span class="badge bg-success-subtle text-success px-2 py-1 fs-6">
                                                    <i class="ti ti-check me-1"></i> Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-6">
                                                    Belum Ditinjau
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('student.materials.show', $mat) }}" class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye me-1"></i> Pelajari
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada materi untuk kelas Anda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($materials->hasPages())
                    <div class="card-footer bg-white d-flex justify-content-end py-3">
                        {{ $materials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
