@extends('layouts.be.master')

@section('header_title', 'Master Data — Role')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Daftar Role Hak Akses</h3>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Tambah Role Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="ti ti-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="ti ti-alert-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 80px;">ID</th>
                        <th>Nama Role</th>
                        <th>Jumlah Pengguna</th>
                        <th>Status Modifikasi</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $role->id }}</td>
                            <td>
                                <span class="fw-semibold text-dark">{{ ucfirst($role->name) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info px-2 py-1 fs-6">
                                    <i class="ti ti-users me-1"></i> {{ $role->users_count }} user
                                </span>
                            </td>
                            <td>
                                @if(in_array($role->name, ['guru', 'siswa']))
                                    <span class="badge bg-secondary-subtle text-secondary">System Locked</span>
                                @else
                                    <span class="badge bg-success-subtle text-success">Custom</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if(!in_array($role->name, ['guru', 'siswa']))
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada role terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($roles->hasPages())
        <div class="card-footer bg-white d-flex justify-content-end py-3">
            {{ $roles->links() }}
        </div>
    @endif
</div>
@endsection
