<x-guest-layout>
    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="avatar-icon-box avatar-icon-primary mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.5rem;">
                    <i class="ti ti-mail-forward"></i>
                </div>
                <h2 class="h4 fw-bold heading-custom mb-1">{{ __('Verifikasi Email Anda') }}</h2>
                <p class="text-muted-custom small">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success d-flex align-items-center mb-4 small" role="alert">
                    <i class="ti ti-circle-check me-2 fs-5"></i>
                    <div>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</div>
                </div>
            @endif

            <div class="d-flex flex-column gap-2">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-send me-1"></i> {{ __('Kirim Ulang Email Verifikasi') }}</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100 py-2"><i class="ti ti-logout me-1"></i> {{ __('Log Out') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
