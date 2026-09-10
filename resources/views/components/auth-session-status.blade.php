@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success d-flex align-items-center small mb-3']) }} role="alert">
        <i class="ti ti-circle-check me-2 fs-5"></i>
        <div>{{ $status }}</div>
    </div>
@endif
