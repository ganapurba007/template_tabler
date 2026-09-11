@extends('layouts.be.master')
@section('header_title', 'Laporan Analytics & Rekap Nilai Siswa')
@section('content')



    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Filter Options -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold">Pilih Kelas</label>
                            <select name="class_id" class="form-select select2" onchange="this.form.submit()">
                                <option value="">-- Semua Kelas --</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold">Pilih Mata Pelajaran (Opsional)</label>
                            <select name="subject_id" class="form-select select2" onchange="this.form.submit()">
                                <option value="">-- Semua Mata Pelajaran --</option>
                                @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                                        {{ $s->name }} ({{ $s->code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-light w-100">
                                <i class="ti ti-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Analytics Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-hover card-table w-100 mb-0 data-table">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width: 70px;">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th style="width: 220px;">Progres Penyelesaian Materi</th>
                                    <th>Rata-rata Tugas</th>
                                    <th>Rata-rata Kuis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $student->name }}</div>
                                            <div class="small text-muted">{{ $student->email }}</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-secondary">
                                                {{ $student->schoolClass->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $student->materials_percentage }}%" aria-valuenow="{{ $student->materials_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="small fw-bold">{{ $student->materials_percentage }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if(!is_null($student->avg_assignment_grade))
                                                <span class="badge badge-soft-success fw-bold">
                                                    {{ $student->avg_assignment_grade }} / 100
                                                </span>
                                            @else
                                                <span class="text-muted small">Belum ada nilai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($student->avg_quiz_score))
                                                <span class="badge badge-soft-info fw-bold">
                                                    {{ $student->avg_quiz_score }} / 100
                                                </span>
                                            @else
                                                <span class="text-muted small">Belum ada nilai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Tidak ada data siswa untuk kriteria filter ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($students->hasPages())
                    <div class="card-footer d-flex justify-content-end py-3">
                        {{ $students->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection