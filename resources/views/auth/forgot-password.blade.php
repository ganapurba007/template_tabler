<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="avatar-icon-box avatar-icon-primary mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.5rem;">
                    <i class="ti ti-key"></i>
                </div>
                <h2 class="h4 fw-bold heading-custom mb-1">{{ __('Lupa Kata Sandi?') }}</h2>
                <p class="text-muted-custom small">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" class="form-control border-start-2 ps-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-send me-1"></i> {{ __('Kirim Tautan Reset Password') }}</button>
            </form>
        </div>
    </div>

    <!-- Back to Login -->
    <div class="text-center mt-4">
        <p class="text-muted-custom small"><a href="{{ route('login') }}" class="text-primary fw-semibold"><i class="ti ti-arrow-left me-1"></i> {{ __('Kembali ke Login') }}</a></p>
    </div>
</x-guest-layout>
