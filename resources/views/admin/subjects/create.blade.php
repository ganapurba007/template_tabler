<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Mata Pelajaran') }}
            </h2>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.subjects.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Misal: Matematika Wajib, Fisika Dasar">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">Guru Pengampu</label>
                            <div class="card bg-light border-0 p-3" style="max-height: 240px; overflow-y: auto;">
                                @forelse($gurus as $guru)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="instructor_ids[]" value="{{ $guru->id }}" id="guru_{{ $guru->id }}" {{ is_array(old('instructor_ids')) && in_array($guru->id, old('instructor_ids')) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-medium text-dark" for="guru_{{ $guru->id }}">
                                            {{ $guru->name }} <span class="text-muted small">({{ $guru->email }})</span>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted small mb-0">Belum ada akun guru terdaftar.</p>
                                @endforelse
                            </div>
                            <div class="form-text mt-1">Pilih satu atau beberapa guru yang bertugas mengampu mata pelajaran ini.</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Simpan Mata Pelajaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
