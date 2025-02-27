@php
  use App\Helpers\Utility;

  $menus = Utility::arrayToObject([
      [
          'name' => 'Dashboard',
          'route' => 'dashboard',
          'icon' => 'icon ti ti-home',
      ],
      [
          'name' => 'Academics',
          'route' => '#academics',
          'icon' => 'icon ti ti-school',
          'children' => [
              [
                  'name' => 'Transcripts',
                  'route' => 'student.semesters.index',
              ],
              [
                  'name' => 'Full Transcripts',
                  'route' => 'student.semesters.full',
              ],
          ],
      ],
  ]);
@endphp

<header class="navbar navbar-expand-md d-print-none" data-bs-theme="dark">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
      aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="flex-row navbar-nav order-md-last">
      <x-avatar-dropdown />
    </div>

    <div class="navbar-collapse collapse d-none" id="navbar-menu">
      <x-logo variant="light" size="small" />
    </div>
  </div>
</header>

<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <ul class="navbar-nav">
          @foreach ($menus as $menu)
            @if (isset($menu->children))
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ $menu->route }}" data-bs-toggle="dropdown"
                  data-bs-auto-close="true" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="{{ $menu->icon }}"></i>
                  </span>
                  <span class="nav-link-title">
                    {{ $menu->name }}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      @foreach ($menu->children as $child)
                        <a class="dropdown-item" href="{{ $child->route ? route($child->route) : '#' }}">
                          {{ $child->name }}
                        </a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ $menu->route ? route($menu->route) : '#' }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="{{ $menu->icon }}"></i>
                  </span>
                  <span class="nav-link-title">
                    {{ $menu->name }}
                  </span>
                </a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</header>
