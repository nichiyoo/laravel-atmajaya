@extends('layouts.auth')

@section('content')
  <form method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf

    <div class="mb-3">
      <label class="form-label">{{ __('User ID') }}</label>
      <input id="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier"
        value="{{ old('identifier') }}" required autocomplete="identifier" autofocus placeholder="Enter your identifier">
      @error('identifier')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-2">
      <label class="form-label">
        {{ __('Password') }}
        @if (false && Route::has('password.request'))
          <span class="form-label-description">
            <a href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
          </span>
        @endif
      </label>

      <div class="input-group input-group-flat">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
          required autocomplete="current-password" placeholder="Enter your password">
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

        @push('scripts')
          <script>
            const input = document.getElementById('password');
            const toggle = document.getElementById('show-password');
            toggle.addEventListener('click', () => {
              if (input.type === 'password') input.type = 'text';
              else input.type = 'password';
            });
          </script>
        @endpush
      </div>
    </div>

    <div class="mb-2">
      <label class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember"
          {{ old('remember') ? 'checked' : '' }} />

        <span class="form-check-label"> {{ __('Remember Me') }}</span>
      </label>
    </div>

    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100"> {{ __('Login') }}</button>
    </div>
  </form>

  <div class="mt-3 text-center text-secondary">
    {{ __('Don\'t have account yet?') }}
    <a href="{{ route('register') }}" tabindex="-1"> {{ __('Sign up') }}</a>
  </div>
@endsection
