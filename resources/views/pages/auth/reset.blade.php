@extends('layouts.auth')

@section('title', 'Reset Password')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Ubah Kata Sandi') }}</h4>
        </div>

        <div class="card-body">
           
            {{-- <p class="text-muted">We will send a link to reset your password</p> --}}
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="current_password">{{ __('Kata Sandi Saat Ini') }}</label>
                    <input id="current_password" type="password"
                        class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                        required autofocus>

                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">{{ __('Kata Sandi Baru') }}</label>
                    <input id="new_password" type="password"
                        class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
                    <input id="new_password_confirmation" type="password" class="form-control"
                        name="new_password_confirmation" required>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Ubah Kata Sandi') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
