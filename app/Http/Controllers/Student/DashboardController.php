<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $student = Auth::user();
    $semesters = $student->semesters()
      ->with('course')
      ->orderBy('semester', 'desc')
      ->get();

    $groups = [];
    $cummulative_gpa = 0;
    $cummulative_credits = 0;

    foreach ($semesters as $semester) {
      $key = $semester->year . '-' . $semester->semester;

      if ($semester->hasGrade()) {
        $letter = $semester->getLetterGrade();
        $grade = Semester::gradePointValue($letter);
        $credits = $semester->course->credit;

        $cummulative_gpa += ($grade * $credits);
        $cummulative_credits += $credits;
        $groups[$key] = $cummulative_credits > 0 ? $cummulative_gpa / $cummulative_credits : 0;
      }
    }

    $latests = $semesters->take(5);
    return view('student.dashboard', [
      'student' => $student,
      'groups' => $groups,
      'latests' => $latests,
    ]);
  }
}
