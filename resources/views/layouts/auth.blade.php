<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
  <link href="https://fonts.bunny.net/css?family=bricolage-grotesque:400,500,600,700&display=swap" rel="stylesheet" />

  <!-- Tabller CSS -->
  <link rel="stylesheet" href={{ asset('dist/css/tabler.min.css') }}>
  <link rel="stylesheet" href={{ asset('dist/css/tabler-icons.min.css') }}>
  <link rel="stylesheet" href={{ asset('dist/css/tabler-vendors.min.css') }}>

  <!-- Custom CSS and JS -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- Additional CSS -->
  @stack('styles')
</head>

<body class="d-flex flex-column bg-primary">
  <div class="page page-center" id="backdrop-auth">
    <div class="container py-4 container-tight">
      <div class="card card-md rounded-3">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-center">
            <a href="{{ route('dashboard') }}">
              <x-logo />
            </a>
          </div>
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <!-- Tabller JS -->
  <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>

  <!-- Additional JS -->
  @stack('scripts')
</body>

</html>
