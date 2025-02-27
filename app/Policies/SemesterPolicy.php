<?php

namespace App\Policies;

use App\Models\Semester;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemesterPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the semester.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Semester  $semester
   * @return bool
   */
  public function view(User $user, Semester $semester)
  {
    return $user->role === 'admin' || $user->id === $semester->user_id;
  }

  /**
   * Determine whether the user can view any semesters.
   *
   * @param  \App\Models\User  $user
   * @return bool
   */
  public function viewAny(User $user)
  {
    return $user->role === 'admin' || $user->role === 'student';
  }

  /**
   * Determine whether the user can create a semester.
   *
   * @param  \App\Models\User  $user
   * @return bool
   */
  public function create(User $user)
  {
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can update the semester.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Semester  $semester
   * @return bool
   */
  public function update(User $user, Semester $semester)
  {
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can delete the semester.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Semester  $semester
   * @return bool
   */
  public function delete(User $user, Semester $semester)
  {
    return $user->role === 'admin';
  }
}
