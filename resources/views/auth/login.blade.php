<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <h2 class="h4 fw-bold heading-custom text-center mb-1">{{ __('Masuk ke Akun Anda') }}</h2>
            <p class="text-muted-custom small text-center mb-4">{{ __('Masukkan email dan kata sandi Anda untuk melanjutkan') }}</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0" for="password">{{ __('Password') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none">{{ __('Lupa Kata Sandi?') }}</a>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock"></i></span>
                        <input type="password" id="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password"><i class="ti ti-eye"></i></button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label text-muted-custom small" for="remember_me">{{ __('Ingat saya di perangkat ini') }}</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-login me-1"></i> {{ __('Masuk') }}</button>
            </form>
        </div>
    </div>

    <!-- Register link -->
    @if (Route::has('register'))
        <div class="text-center mt-4">
            <p class="text-muted-custom small">{{ __('Belum memiliki akun?') }} <a href="{{ route('register') }}" class="text-primary fw-semibold">{{ __('Daftar Sekarang') }}</a></p>
        </div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.toggle-password').forEach(function(btn){
        btn.addEventListener('click', function(){
          const target = document.getElementById(this.dataset.target);
          if (target.type === 'password') {
            target.type = 'text';
            this.innerHTML = '<i class="ti ti-eye-off"></i>';
          } else {
            target.type = 'password';
            this.innerHTML = '<i class="ti ti-eye"></i>';
          }
        });
      });
    });
    </script>
</x-guest-layout>
