<x-guest-layout>
    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="avatar-icon-box avatar-icon-primary mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.5rem;">
                    <i class="ti ti-shield-lock"></i>
                </div>
                <h2 class="h4 fw-bold heading-custom mb-1">{{ __('Reset Kata Sandi') }}</h2>
                <p class="text-muted-custom small">{{ __('Buat kata sandi baru untuk akun Anda.') }}</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="nama@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label" for="password">{{ __('Kata Sandi Baru') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock"></i></span>
                        <input type="password" id="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock-check"></i></span>
                        <input type="password" id="password_confirmation" class="form-control border-start-0 ps-0 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-check me-1"></i> {{ __('Reset Password') }}</button>
            </form>
        </div>
    </div>

    <!-- Back to Login -->
    <div class="text-center mt-4">
        <p class="text-muted-custom small"><a href="{{ route('login') }}" class="text-primary fw-semibold"><i class="ti ti-arrow-left me-1"></i> {{ __('Kembali ke Login') }}</a></p>
    </div>
</x-guest-layout>
