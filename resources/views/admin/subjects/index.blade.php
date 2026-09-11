@extends('layouts.be.master')

@section('header_title', 'Master Data — Mata Pelajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Daftar Mata Pelajaran &amp; Guru Pengampu</h3>
    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Tambah Mata Pelajaran
    </a>
</div>

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
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 80px;">ID</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Guru Pengampu</th>
                        <th>Statistik Konten</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $subject)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $subject->id }}</td>
                            <td>
                                <span class="fw-semibold">{{ $subject->name }}</span>
                            </td>
                            <td>
                                @forelse($subject->instructors as $guru)
                                    <span class="badge bg-primary-subtle text-primary mb-1 me-1">
                                        <i class="ti ti-user me-1"></i> {{ $guru->name }}
                                    </span>
                                @empty
                                    <span class="text-muted small">Belum ada guru pengampu</span>
                                @endforelse
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $subject->materials_count }} Materi | {{ $subject->assignments_count }} Tugas | {{ $subject->quizzes_count }} Kuis
                                </small>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary" title="Edit / Alokasi Guru">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" onsubmit="return confirm('Hapus mata pelajaran ini?')">
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
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada mata pelajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($subjects->hasPages())
        <div class="card-footer d-flex justify-content-end py-3">
            {{ $subjects->links() }}
        </div>
    @endif
</div>
@endsection
