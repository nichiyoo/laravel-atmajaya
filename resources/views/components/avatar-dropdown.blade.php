<div class="nav-item dropdown">
  <a href="#" class="p-0 nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown" aria-label="Open user menu">
    <img src="{{ 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=ff6e03&color=fff&size=128' }}"
      alt="avatar" class="avatar avatar-sm">
    <div class="d-none d-xl-block ps-2">
      <div>{{ Auth::user()->name }}</div>
      <div class="mt-1 small text-secondary">{{ Auth::user()->email }}</div>
    </div>
  </a>

  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
    <a href="#" class="dropdown-item">Status</a>
    <a href="#" class="dropdown-item">Profile</a>
    <a href="#" class="dropdown-item">Feedback</a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">Settings</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="dropdown-item">Logout</button>
    </form>
  </div>
</div>
