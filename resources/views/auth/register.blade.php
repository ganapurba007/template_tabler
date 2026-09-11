<x-guest-layout>
    <div class="card shadow-sm border mb-0">
        <div class="card-body p-4">
            <h2 class="h4 fw-bold heading-custom text-center mb-1">{{ __('Buat Akun Baru') }}</h2>
            <p class="text-muted-custom small text-center mb-4">{{ __('Lengkapi formulir di bawah ini untuk mendaftar sebagai Siswa') }}</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label" for="name">{{ __('Nama Lengkap') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Class Selection -->
                <div class="mb-3">
                    <label class="form-label" for="class_id">{{ __('Kelas') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-school"></i></span>
                        <select id="class_id" class="form-select border-start-0 ps-0 @error('class_id') is-invalid @enderror" name="class_id" required>
                            <option value="" disabled {{ old('class_id') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('class_id')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock"></i></span>
                        <input type="password" id="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted-custom"><i class="ti ti-lock-check"></i></span>
                        <input type="password" id="password_confirmation" class="form-control border-start-0 ps-0 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2"><i class="ti ti-user-plus me-1"></i> {{ __('Daftar Akun Siswa') }}</button>
            </form>
        </div>
    </div>

    <!-- Login Link -->
    <div class="text-center mt-4">
        <p class="text-muted-custom small">{{ __('Sudah memiliki akun?') }} <a href="{{ route('login') }}" class="text-primary fw-semibold">{{ __('Masuk di Sini') }}</a></p>
    </div>
</x-guest-layout>
