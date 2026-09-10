<x-guest-layout>
    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="avatar-icon-box avatar-icon-warning mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.5rem;">
                    <i class="ti ti-shield-check"></i>
                </div>
                <h2 class="h4 fw-bold heading-custom mb-1">{{ __('Konfirmasi Kata Sandi') }}</h2>
                <p class="text-muted-custom small">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock"></i></span>
                        <input type="password" id="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-check me-1"></i> {{ __('Konfirmasi') }}</button>
            </form>
        </div>
    </div>
</x-guest-layout>
