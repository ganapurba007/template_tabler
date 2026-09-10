@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-danger small list-unstyled mb-0 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li><i class="ti ti-alert-circle me-1"></i>{{ $message }}</li>
        @endforeach
    </ul>
@endif
