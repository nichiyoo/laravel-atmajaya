<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
  public function create(User $student)
  {
    $courses = Course::all()->groupBy('description');
    return view('admin.students.semesters.create', [
      'student' => $student,
      'courses' => $courses,
    ]);
  }

  public function store(Request $request, User $student)
  {
    $max = date('Y') + 1;

    $validated = $request->validate([
      'semester' => 'required|integer|min:1',
      'year' => 'required|integer|min:1900|max:' . $max,
      'courses' => 'required|array',
      'courses.*' => 'exists:courses,id',
    ]);

    $selected = Course::whereIn('id', $validated['courses'])->get();
    $total = $selected->sum('credit');

    if ($total > $student->available_credit) {
      return back()->withErrors(['courses' => 'The total credits exceed the available credits (' . $student->available_credit . ').']);
    }

    foreach ($selected as $course) {
      Semester::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'semester' => $validated['semester'],
        'year' => $validated['year'],
      ]);
    }

    $student->available_credit -= $total;
    $student->save();

    return redirect()->route('admin.students.show', $student->id)
      ->with('success', 'Courses added successfully for the semester.');
  }

  public function edit(User $student, Semester $semester)
  {
    return view('admin.students.semesters.edit', [
      'student' => $student,
      'semester' => $semester,
    ]);
  }

  public function update(Request $request, User $student, Semester $semester)
  {
    $validated = $request->validate([
      'cw1' => 'nullable|numeric|min:0|max:100',
      'cw2' => 'nullable|numeric|min:0|max:100',
      'cw3' => 'nullable|numeric|min:0|max:100',
      'cw4' => 'nullable|numeric|min:0|max:100',
      'midterm' => 'nullable|numeric|min:0|max:100',
      'final' => 'nullable|numeric|min:0|max:100',
    ]);

    $semester->update($validated);

    return redirect()->route('admin.students.show', $student->id)
      ->with('success', 'Semester updated successfully.');
  }

  public function destroy(User $student, Semester $semester)
  {
    $semester->delete();

    return redirect()->route('admin.students.show', $student->id)
      ->with('success', 'Semester deleted successfully.');
  }
}
