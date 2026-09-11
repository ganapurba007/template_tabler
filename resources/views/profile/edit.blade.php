@extends('layouts.be.master')

@section('header_title', 'Pengaturan Profil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark"><i class="ti ti-user-cog me-2"></i>Pengaturan Profil</h3>
        <p class="text-muted mb-0 small">Kelola informasi akun, kata sandi, dan preferensi akun Anda.</p>
    </div>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-lg-12">
        <!-- Informasi Profil -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title fw-bold m-0 text-dark"><i class="ti ti-user me-2 text-primary"></i>Informasi Profil</h5>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Ubah Kata Sandi -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title fw-bold m-0 text-dark"><i class="ti ti-key me-2 text-warning"></i>Ubah Kata Sandi</h5>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Hapus Akun -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title fw-bold m-0 text-danger"><i class="ti ti-trash me-2"></i>Hapus Akun</h5>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection

