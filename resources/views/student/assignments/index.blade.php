<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tugas Siswa Kelas Saya') }}
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
                                    <th class="ps-4">Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Pengajar</th>
                                    <th>Batas Waktu (Deadline)</th>
                                    <th>Status Pengumpulan</th>
                                    <th>Nilai</th>
                                    <th class="pe-4 text-end" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assignments as $asg)
                                    @php
                                        $sub = $submissions->get($asg->id);
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $asg->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6">
                                                {{ $asg->subject->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $asg->instructor->name ?? '-' }}</td>
                                        <td>
                                            <div class="small fw-semibold text-danger">
                                                <i class="ti ti-clock me-1"></i> {{ $asg->due_date ? $asg->due_date->format('d M Y H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($sub)
                                                <span class="badge bg-success-subtle text-success px-2 py-1 fs-6">
                                                    <i class="ti ti-check me-1"></i> Sudah Dikumpulkan
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning px-2 py-1 fs-6">
                                                    Belum Dikumpulkan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($sub && !is_null($sub->grade))
                                                <span class="badge bg-primary px-2 py-1 fs-6 fw-bold">
                                                    {{ number_format($sub->grade, 1) }} / 100
                                                </span>
                                            @elseif($sub)
                                                <span class="text-muted small">Menunggu Penilaian</span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('student.assignments.show', $asg) }}" class="btn btn-sm btn-primary">
                                                <i class="ti ti-pencil me-1"></i> Kerjakan / Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Belum ada tugas untuk kelas Anda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($assignments->hasPages())
                    <div class="card-footer bg-white d-flex justify-content-end py-3">
                        {{ $assignments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
