@extends('layouts.be.master')

@section('header_title', 'Master Data — Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Daftar Pengguna Sistem</h3>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="ti ti-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Search & Filter Bar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari Nama, Email, NIP..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <select name="role_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100"><i class="ti ti-filter me-1"></i> Filter</button>
                @if(request()->anyFilled(['search', 'role_id']))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary" title="Reset Filter"><i class="ti ti-refresh"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Users Table Card -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Pengguna</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Role</th>
                        <th>Kelas</th>
                        <th class="pe-4 text-end" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-icon-box avatar-icon-primary me-3">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                        <div class="small text-muted">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-muted">{{ $user->email }}</span></td>
                            <td>
                                @if($user->nip)
                                    <span class="font-monospace text-dark fw-medium">{{ $user->nip }}</span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                @if($user->isGuru())
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-6"><i class="ti ti-school me-1"></i> Guru</span>
                                @elseif($user->isSiswa())
                                    <span class="badge bg-success-subtle text-success px-2 py-1 fs-6"><i class="ti ti-user-check me-1"></i> Siswa</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-6">{{ ucfirst($user->role->name ?? 'None') }}</span>
                                @endif
                            </td>
                            <td>
                                @if($user->schoolClass)
                                    <span class="badge bg-info-subtle text-info fs-6">{{ $user->schoolClass->name }}</span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Assign Role / Edit">
                                    <i class="ti ti-edit me-1"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
        <div class="card-footer bg-white d-flex justify-content-end py-3">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
