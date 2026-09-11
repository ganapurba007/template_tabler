<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Koreksi & Penilaian Tugas Siswa') }}
            </h2>
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

            <!-- Filter Box -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.submissions.index') }}" class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Filter Berdasarkan Tugas</label>
                            <select name="assignment_id" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Semua Tugas Siswa --</option>
                                @foreach($assignments as $asg)
                                    <option value="{{ $asg->id }}" {{ request('assignment_id') == $asg->id ? 'selected' : '' }}>
                                        {{ $asg->title }} ({{ $asg->subject->name ?? '-' }} - {{ $asg->schoolClass->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <a href="{{ route('admin.submissions.index') }}" class="btn btn-light w-100">
                                <i class="ti ti-refresh me-1"></i> Reset Filter
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Submissions Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 70px;">ID</th>
                                    <th>Nama Siswa</th>
                                    <th>Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Waktu Pengumpulan</th>
                                    <th>Nilai</th>
                                    <th class="pe-4 text-end" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submissions as $sub)
                                    <tr>
                                        <td class="ps-4 fw-bold">#{{ $sub->id }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $sub->student->name ?? '-' }}</div>
                                            <div class="small text-muted">{{ $sub->student->email ?? '-' }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $sub->assignment->title ?? '-' }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6">
                                                {{ $sub->assignment->subject->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $sub->submitted_at ? $sub->submitted_at->format('d M Y H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if(!is_null($sub->grade))
                                                <span class="badge bg-success-subtle text-success px-2 py-1 fs-6 fw-bold">
                                                    {{ number_format($sub->grade, 1) }} / 100
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning px-2 py-1 fs-6">
                                                    Belum Dinilai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('admin.submissions.show', $sub) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-pencil-check me-1"></i> Koreksi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Belum ada pengumpulan tugas siswa.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($submissions->hasPages())
                    <div class="card-footer bg-white d-flex justify-content-end py-3">
                        {{ $submissions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
