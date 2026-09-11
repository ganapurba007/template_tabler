@extends('layouts.be.master')

@section('header_title', 'Master Data — Tugas Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Daftar Tugas Siswa Kelas</h3>
    <a href="{{ route('admin.assignments.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Buat Tugas Baru
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
            <table id="assignmentsTable" class="table table-vcenter table-hover card-table w-100 mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">No</th>
                        <th>Judul Tugas</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas Target</th>
                        <th>Batas Waktu (Deadline)</th>
                        <th>Pengumpulan</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold">{{ $assignment->title }}</div>
                                <div class="small text-muted">{{ Str::limit($assignment->description, 60) }}</div>
                            </td>
                            <td>
                                <span class="badge badge-soft-primary">
                                    {{ $assignment->subject->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-soft-info">
                                    {{ $assignment->schoolClass->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="small fw-semibold text-danger">
                                    <i class="ti ti-clock me-1"></i> {{ $assignment->due_date ? $assignment->due_date->format('d M Y H:i') : '-' }}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft-secondary">
                                    {{ $assignment->submissions_count }} Siswa
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-primary" title="Edit Tugas">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.assignments.destroy', $assignment) }}" onsubmit="return confirm('Hapus tugas ini?')">
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
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada tugas siswa yang dibuat. Silakan buat tugas baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($assignments->hasPages())
        <div class="card-footer d-flex justify-content-end py-3">
            {{ $assignments->links() }}
        </div>
    @endif
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#assignmentsTable').DataTable({
        responsive: true,
        columnDefs: [{ orderable: false, targets: -1 }],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            paginate: { first: "Pertama", last: "Terakhir", next: "Berikutnya", previous: "Sebelumnya" }
        }
    });
});
</script>
@endpush