<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
  /** @use HasFactory<\Database\Factories\SemesterFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'user_id',
    'course_id',
    'semester',
    'year',
    'cw1',
    'cw2',
    'cw3',
    'cw4',
    'midterm',
    'final',
  ];

  public static $mapper = [
    'A' => 4.0,
    'A-' => 3.7,
    'B+' => 3.3,
    'B' => 3.0,
    'B-' => 2.7,
    'C+' => 2.3,
    'C' => 2.0,
    'D+' => 1.3,
    'D' => 1.0,
    'E' => 0.0,
  ];

  /**
   * Get the user of the semester.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the course of the semester.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Course::class);
  }

  /**
   * Boot the model.
   */
  protected static function booted()
  {
    static::saved(function ($semester) {
      $semester->user->updateUserGPA();
    });
  }

  /**
   * Get the letter grade based on the grade point.
   *
   * @return string
   */
  public function hasGrade()
  {
    return $this->final !== null;
  }

  /**
   * Get the letter grade based on the grade point.
   *
   * @return string
   */
  public function getLetterGrade()
  {
    return Semester::letterGradeValue($this);
  }

  /**
   * Get the overall grade based on the grade point.
   *
   * @return string
   */
  public function getOverallGrade()
  {
    return Semester::calculateGradePoint($this);
  }

  /**
   * Calculate the grade point of the grade.
   *
   * @param \App\Models\Semester $semester
   * @return float
   */
  public static function calculateGradePoint(Semester $semester)
  {
    $scores = array_filter([$semester->cw1, $semester->cw2, $semester->cw3, $semester->cw4]);
    $count = count($scores);

    if ($count === 0 || $semester->midterm === null || $semester->final === null) {
      return 0.0;
    }

    $average = array_sum($scores) / $count;
    $total = ($average * 0.3) + ($semester->midterm * 0.3) + ($semester->final * 0.4);
    return $total;
  }

  /**
   * Get the letter grade based on the grade point.
   *
   * @return string
   */
  public static function letterGradeValue(Semester $semester)
  {
    if (!$semester->hasGrade()) return null;
    $point = self::calculateGradePoint($semester);

    if ($point >= 80) return 'A';
    else if ($point >= 75) return 'A-';
    else if ($point >= 71) return 'B+';
    else if ($point >= 67) return 'B';
    else if ($point >= 63) return 'B-';
    else if ($point >= 59) return 'C+';
    else if ($point >= 55) return 'C';
    else if ($point >= 45) return 'D';
    else return 'E';
  }

  /**
   * Get the grade point value of the grade.
   *
   * @param string $grade
   * @return float
   */
  public static function gradePointValue(string $grade)
  {
    return self::$mapper[$grade];
  }
}
