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

<body>
  <div class="page">
    @include('partials.admin.sidebar')
    @include('partials.admin.navbar')

    <div class="page-wrapper">
      @yield('content')
      @include('partials.admin.footer')
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal modal-blur fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>Are you sure?</h3>
          <div class="text-muted" id="deleteConfirmationMessage"></div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn w-100" data-bs-dismiss="modal">
                  Cancel
                </button>
              </div>
              <div class="col">
                <form id="deleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger w-100">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabler JS -->
  <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>

  <!-- Additional JS -->
  @stack('scripts')

</body>

</html>
