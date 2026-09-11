@extends('layouts.be.master')

@section('header_title', 'Admin / Guru Dashboard')

@section('content')
<div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" data-alert-id="welcome-dashboard">
    <h4 class="alert-heading fw-bold mb-1"><i class="ti ti-user-check me-2"></i> Selamat Datang, {{ Auth::user()->name }}!</h4>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
</div>

<!-- Admin Overview Cards -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-hover stat-card-accent-primary mb-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted-custom small fw-bold text-uppercase">MATA PELAJARAN</span>
                    <div class="avatar-icon-box avatar-icon-primary"><i class="ti ti-book"></i></div>
                </div>
                <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->subjects->count() }}</div>
                <div class="small text-muted-custom">Mapel diampu</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-hover stat-card-accent-success mb-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted-custom small fw-bold text-uppercase">MATERI DIPUBLIKASI</span>
                    <div class="avatar-icon-box avatar-icon-success"><i class="ti ti-file-text"></i></div>
                </div>
                <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->materials->count() }}</div>
                <div class="small text-muted-custom">Materi aktif</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-hover stat-card-accent-warning mb-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted-custom small fw-bold text-uppercase">TUGAS DIBUAT</span>
                    <div class="avatar-icon-box avatar-icon-warning"><i class="ti ti-pencil"></i></div>
                </div>
                <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->assignments->count() }}</div>
                <div class="small text-muted-custom">Tugas aktif</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-hover stat-card-accent-danger mb-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted-custom small fw-bold text-uppercase">KUIS DIBUAT</span>
                    <div class="avatar-icon-box avatar-icon-danger"><i class="ti ti-help-circle"></i></div>
                </div>
                <div class="h2 fw-bold heading-custom mb-1">{{ Auth::user()->quizzes->count() }}</div>
                <div class="small text-muted-custom">Kuis aktif</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links Grid -->
<div class="card shadow-sm border-0">
    <div class="card-header py-3">
        <h5 class="fw-bold m-0"><i class="ti ti-menu me-2 text-primary"></i>Menu Akses Cepat Admin</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center">
                    <i class="ti ti-shield-check fs-2 mb-1"></i>
                    <span>Master Role</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success w-100 py-3 d-flex flex-column align-items-center">
                    <i class="ti ti-users fs-2 mb-1"></i>
                    <span>Master User</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center">
                    <i class="ti ti-school fs-2 mb-1"></i>
                    <span>Master Kelas</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-warning w-100 py-3 d-flex flex-column align-items-center">
                    <i class="ti ti-book fs-2 mb-1"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
