@extends('layouts.auth')

@section('content')
  <form method="POST" action="{{ route('register') }}" autocomplete="off">
    @csrf
    <div class="mb-3">
      <label class="form-label">{{ __('User ID') }}</label>
      <input id="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier"
        value="{{ old('identifier') }}" required autocomplete="identifier" autofocus>
      @error('identifier')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">{{ __('Name') }}</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') }}" required autocomplete="name" autofocus>
      @error('name')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">{{ __('Email Address') }}</label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
      @error('email')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-2">
      <label class="form-label">
        {{ __('Password') }}
      </label>
      <div class="input-group input-group-flat">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
          required autocomplete="new-password">
        @error('password')
          <div class="invalid-feedback" role="alert">{{ $message }}</div>
        @enderror
        <span class="input-group-text">
          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" id="show-password">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
              <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            </svg>
          </a>
        </span>
      </div>
    </div>

    <div class="mb-2">
      <label class="form-label">
        {{ __('Confirm Password') }}
      </label>
      <div class="input-group input-group-flat">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
          autocomplete="new-password">
        @error('password-confirm')
          <div class="invalid-feedback" role="alert">{{ $message }}</div>
        @enderror
        <span class="input-group-text">
          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
            id="show-password-confirm">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
              <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            </svg>
          </a>
        </span>

        @push('scripts')
          <script>
            const input = document.getElementById('password');
            const toggle = document.getElementById('show-password');

            toggle.addEventListener('click', () => {
              if (input.type === 'password') input.type = 'text';
              else input.type = 'password';
            });

            const inputConfirm = document.getElementById('password-confirm');
            const toggleConfirm = document.getElementById('show-password-confirm');

            toggleConfirm.addEventListener('click', () => {
              if (inputConfirm.type === 'password') inputConfirm.type = 'text';
              else inputConfirm.type = 'password';
            });
          </script>
        @endpush
      </div>
    </div>

    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100"> {{ __('Register') }}</button>
    </div>
  </form>

  <div class="mt-3 text-center text-secondary">
    {{ __('Already have account?') }}
    <a href="{{ route('login') }}" tabindex="-1"> {{ __('Sign in') }}</a>
  </div>
@endsection
