<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'identifier',
    'current_gpa',
    'cummulative_gpa',
    'available_credit',
    'role',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Get the semesters of the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function semesters(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Semester::class);
  }

  /**
   * Get the students of the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function scopeStudents($query)
  {
    return $query->where('role', 'student');
  }

  /**
   * Update the GPA of the user.
   */
  public function updateUserGPA()
  {
    $semester_all = $this->semesters()->with('course')->get()->groupBy('semester');
    $semester_last = $semester_all->get($semester_all->keys()->last());

    $total_credit = 0;
    $total_grade = 0;

    foreach ($semester_all as $group) {
      foreach ($group as $semester) {
        if (!$semester->hasGrade()) continue;

        $letter = $semester->getLetterGrade();
        $grade = Semester::gradePointValue($letter);
        $total_grade += $grade * $semester->course->credit;
        $total_credit += $semester->course->credit;
      }
    }

    $current_total_grade = 0;
    $current_total_credit = 0;

    foreach ($semester_last as $semester) {
      if (!$semester->hasGrade()) continue;

      $letter = $semester->getLetterGrade();
      $grade = Semester::gradePointValue($letter);
      $current_total_grade += $grade * $semester->course->credit;
      $current_total_credit += $semester->course->credit;
    }

    $current_gpa = $current_total_credit > 0 ? $current_total_grade / $current_total_credit : 0;
    $cummulative_grade = $total_credit > 0 ? $total_grade / $total_credit : 0;

    $this->update([
      'current_gpa' => $current_gpa,
      'cummulative_gpa' => $cummulative_grade,
    ]);
  }
}
