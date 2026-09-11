@extends('layouts.be.master')

@section('header_title', 'Master Data — Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Daftar Kelas Pembelajaran</h3>
    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Tambah Kelas Baru
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
                        <th>Nama Kelas</th>
                        <th>Jumlah Siswa Terdaftar</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $class)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $class->id }}</td>
                            <td>
                                <span class="fw-semibold">{{ $class->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info px-2 py-1 fs-6">
                                    <i class="ti ti-users me-1"></i> {{ $class->students_count }} Siswa
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" onsubmit="return confirm('Hapus kelas ini?')">
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
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada kelas terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($classes->hasPages())
        <div class="card-footer d-flex justify-content-end py-3">
            {{ $classes->links() }}
        </div>
    @endif
</div>
@endsection
