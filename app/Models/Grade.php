<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  /** @use HasFactory<\Database\Factories\GradeFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'student_id',
    'course_id',
    'semester',
    'year',
    'cw1',
    'cw2',
    'cw3',
    'cw4',
    'midterm',
    'final'
  ];


  /**
   * Get the student of the grade.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function student()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the course of the grade.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function course()
  {
    return $this->belongsTo(Course::class);
  }

  /**
   * Boot the model.
   */
  protected static function booted()
  {
    static::saved(function ($grade) {
      $grade->student->updateGPA();
    });

    static::deleted(function ($grade) {
      $grade->student->updateGPA();
    });
  }
}
