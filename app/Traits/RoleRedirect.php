<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RoleRedirect
{
  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected function redirectTo()
  {
    $user = Auth::user();

    switch ($user->role) {
      case 'admin':
        return '/dashboard/admin';
      default:
        return '/dashboard/student';
    }
  }
}
