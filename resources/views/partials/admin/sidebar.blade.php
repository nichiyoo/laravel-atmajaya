@php
  use App\Helpers\Utility;

  $menus = Utility::arrayToObject([
      [
          'name' => 'Dashboard',
          'route' => 'dashboard',
          'icon' => 'icon ti ti-home',
      ],
      [
          'name' => 'Students',
          'route' => null,
          'icon' => 'icon ti ti-calendar',
          'children' => [
              [
                  'name' => 'Students List',
                  'route' => 'admin.students.index',
              ],
              [
                  'name' => 'Register Student',
                  'route' => 'admin.students.create',
              ],
          ],
      ],
      [
          'name' => 'Academics',
          'route' => null,
          'icon' => 'icon ti ti-list',
          'children' => [
              [
                  'name' => 'List Courses',
                  'route' => 'admin.courses.index',
              ],
              [
                  'name' => 'Add Course',
                  'route' => 'admin.courses.create',
              ],
          ],
      ],
  ]);
@endphp

<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
      aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-brand navbar-brand-autodark d-none d-lg-flex">
      <a href="{{ route('dashboard') }}" class="text-decoration-none">
        <x-logo variant="white" />
      </a>
    </div>

    <div class="flex-row navbar-nav d-lg-none">
      <x-avatar-dropdown />
    </div>

    <div class="d-none d-lg-block">
      <div class="navbar-collapse collapse" id="sidebar-menu">
        <ul class="navbar-nav">
          @foreach ($menus as $menu)
            @if (isset($menu->children))
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                  data-bs-auto-close="false" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="{{ $menu->icon }}"></i>
                  </span>
                  <span class="nav-link-title">
                    {{ $menu->name }}
                  </span>
                </a>
                <div class="dropdown-menu show">
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

  <div class="w-full d-lg-none">
    <div class="navbar-collapse collapse" id="sidebar-menu">
      <ul class="navbar-nav">
        @foreach ($menus as $menu)
          @if (isset($menu->children))
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                data-bs-auto-close="false" role="button" aria-expanded="false">
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
</aside>
