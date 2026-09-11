@extends('layouts.be.master')

@section('header_title', 'Master Data — Bank Soal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Bank Soal &amp; Pilihan Jawaban</h3>
    <a href="{{ route('admin.question-banks.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Buat Soal Baru
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
                        <th>Pertanyaan Soal</th>
                        <th>Jumlah Pilihan</th>
                        <th>Kunci Jawaban</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questionBanks as $qb)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold text-wrap" style="max-width: 450px;">
                                    {{ Str::limit($qb->question_text, 120) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft-primary">
                                    {{ $qb->options_count }} Opsi
                                </span>
                            </td>
                            <td>
                                @php
                                    $correct = $qb->options->firstWhere('is_correct', true);
                                @endphp
                                @if($correct)
                                    <span class="badge badge-soft-success">
                                        <i class="ti ti-check me-1"></i> {{ Str::limit($correct->option_text, 35) }}
                                    </span>
                                @else
                                    <span class="text-danger small">Belum diatur</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.question-banks.edit', $qb) }}" class="btn btn-sm btn-outline-primary" title="Edit Soal">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.question-banks.destroy', $qb) }}" onsubmit="return confirm('Hapus soal ini dari Bank Soal?')">
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
                            <td colspan="5" class="text-center py-4 text-muted">Bank soal masih kosong. Silakan buat soal baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($questionBanks->hasPages())
        <div class="card-footer d-flex justify-content-end py-3">
            {{ $questionBanks->links() }}
        </div>
    @endif
</div>
@endsection