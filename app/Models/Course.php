<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  /** @use HasFactory<\Database\Factories\SubjectFactory> */
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'code',
    'description',
    'credit',
    'section',
  ];

  /**
   * Get the semesters of the course.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function semesters(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Semester::class);
  }
}
