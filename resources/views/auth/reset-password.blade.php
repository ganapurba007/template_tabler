<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 500px;">
        <div class="card-body p-4 p-md-5 bg-white">
            
            <div class="text-center mb-4">
                <div class="rounded-circle text-white d-inline-flex align-items-center justify-content-center p-3 mb-3" style="background-color: #66A3BF; width: 64px; height: 64px;">
                    <i class="ti ti-shield-lock fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2">Reset Kata Sandi 🔑</h3>
                <p class="text-muted small">
                    Masukkan alamat email Anda dan tentukan kata sandi baru untuk akun Anda.
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark small" for="email">{{ __('Alamat Email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" class="form-control bg-light border-start-0 ps-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="nama@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark small" for="password">{{ __('Kata Sandi Baru') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="ti ti-lock"></i></span>
                        <input type="password" id="password" class="form-control bg-light border-start-0 ps-1 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark small" for="password_confirmation">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="ti ti-lock-check"></i></span>
                        <input type="password" id="password_confirmation" class="form-control bg-light border-start-0 ps-1 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger small" />
                </div>

                <button type="submit" class="btn w-100 py-3 text-white fw-bold shadow-sm rounded-3 mb-3" style="background-color: #66A3BF; border: none;">
                    <i class="ti ti-check me-1"></i> {{ __('Simpan Kata Sandi Baru') }}
                </button>
            </form>

            <div class="text-center pt-3 border-top">
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none small" style="color: #3368A0;">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Halaman Login
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
