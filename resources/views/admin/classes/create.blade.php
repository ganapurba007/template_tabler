@extends('layouts.be.master')

@section('header_title', 'Tambah Kelas Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Tambah Kelas Pembelajaran Baru</h3>
    <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.classes.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Misal: X-IPA-1, XI-IPS-3">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Simpan Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
