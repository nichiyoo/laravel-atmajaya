<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $student = Auth::user();
    $semester = $request->input('semester', null);

    $semesters = $student->semesters()
      ->when($semester, function ($query) use ($semester) {
        return $query->where('semester', $semester);
      })
      ->with('course')
      ->orderBy('semester', 'asc')
      ->get();

    $options = $student->semesters()
      ->select('semester')
      ->distinct()
      ->orderBy('semester', 'asc')
      ->pluck('semester');

    return view('student.semesters.index', compact('student', 'semesters', 'options', 'semester'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function full()
  {
    $student = Auth::user();
    $semesters = $student->semesters()
      ->with('course')
      ->orderBy('semester', 'asc')
      ->get();

    $cummulative = 0;
    $credits = 0;
    $groups = [];

    foreach ($semesters as $semester) {
      $year = $semester->year;
      $key = $year . '-' . $semester->semester;

      if (!isset($groups[$key])) {
        $groups[$key] = [
          'year' => $year,
          'semester' => $semester->semester,
          'courses' => [],
          'gpa' => 0,
          'cummulative' => 0,
          'total_credits' => 0,
          'credits' => 0,
        ];
      }

      $letter = $semester->getLetterGrade();

      $groups[$key]['courses'][] = $semester;
      $groups[$key]['total_credits'] += $semester->course->credit;

      if ($letter) {
        $groups[$key]['credits'] += $semester->course->credit;
        $credits += $semester->course->credit;

        $grade = $semester->course->credit * Semester::gradePointValue($letter);
        $groups[$key]['gpa'] += $grade;
        $cummulative += $grade;
      }

      $groups[$key]['cummulative'] = $credits > 0 ? $cummulative / $credits : 0;
    }

    foreach ($groups as &$group) {
      $group['gpa'] = $group['credits'] > 0 ? $group['gpa'] / $group['credits'] : 0;
    }

    return view('student.semesters.full', [
      'student' => $student,
      'groups' => $groups,
    ]);
  }

  private function gradePointValue($grade)
  {
    $gradePoints = [
      'A' => 4.0,
      'A-' => 3.7,
      'B+' => 3.3,
      'B' => 3.0,
      'B-' => 2.7,
      'C+' => 2.3,
      'C' => 2.0,
      'C-' => 1.7,
      'D+' => 1.3,
      'D' => 1.0,
      'F' => 0.0,
    ];

    return $gradePoints[$grade] ?? 0.0;
  }

  private function hasGrade($semester)
  {
    return !is_null($semester->cw1) || !is_null($semester->cw2) ||
      !is_null($semester->cw3) || !is_null($semester->cw4) ||
      !is_null($semester->midterm) || !is_null($semester->final);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Semester $semester)
  {
    $this->authorize('view', $semester);

    return view('student.semesters.show', compact('semester'));
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Semester $semester)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Semester $semester)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Semester $semester)
  {
    //
  }
}
