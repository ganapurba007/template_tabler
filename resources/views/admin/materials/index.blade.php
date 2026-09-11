@extends('layouts.be.master')

@section('header_title', 'Master Data — Materi Pembelajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Daftar Materi Pembelajaran Kelas</h3>
    <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Tambah Materi Baru
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
            <table class="table table-vcenter table-hover card-table w-100 mb-0 data-table">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">No</th>
                        <th>Judul Materi</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas Target</th>
                        <th>Tipe Konten</th>
                        <th>Instruktur</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materials as $material)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold">{{ $material->title }}</div>
                                <div class="small text-muted">Urutan: {{ $material->order }}</div>
                            </td>
                            <td>
                                <span class="badge badge-soft-primary">
                                    {{ $material->subject->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-soft-primary">
                                    {{ $material->schoolClass->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($material->content)
                                        <span class="badge badge-soft-success" title="Ada Isi Teks"><i class="ti ti-file-text me-1"></i> Teks</span>
                                    @endif
                                    @if($material->video_url)
                                        <span class="badge badge-soft-danger" title="Ada Video YouTube"><i class="ti ti-brand-youtube me-1"></i> YouTube</span>
                                    @endif
                                    @if($material->document_path)
                                        <span class="badge badge-soft-warning" title="Ada File Lampiran"><i class="ti ti-file-download me-1"></i> Dokumen</span>
                                    @endif
                                    @if(!$material->content && !$material->video_url && !$material->document_path)
                                        <span class="badge badge-soft-secondary">-</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $material->instructor->name ?? '-' }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-sm btn-outline-primary" title="Edit Materi">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.materials.destroy', $material) }}" onsubmit="return confirm('Hapus materi ini?')">
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
                            <td colspan="7" class="text-center py-4 text-muted">Materi pembelajaran masih kosong. Silakan buat materi baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($materials->hasPages())
        <div class="card-footer d-flex justify-content-end py-3">
            {{ $materials->links() }}
        </div>
    @endif
</div>
@endsection