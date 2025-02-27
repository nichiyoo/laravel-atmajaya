<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::paginate(10);

    return view('admin.courses.index', [
      'courses' => $courses,
    ]);
  }

  public function create()
  {
    return view('admin.courses.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'code' => 'required|string|unique:courses,code',
      'description' => 'required|string',
      'credit' => 'required|integer|min:0',
      'section' => 'required|string',
    ]);

    Course::create($validated);

    return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
  }

  public function show(Course $course)
  {
    return view('admin.courses.show', [
      'course' => $course,
    ]);
  }

  public function edit(Course $course)
  {
    return view('admin.courses.edit', [
      'course' => $course,
    ]);
  }

  public function update(Request $request, Course $course)
  {
    $validated = $request->validate([
      'code' => 'required|string|unique:courses,code,' . $course->id,
      'description' => 'required|string',
      'credit' => 'required|integer|min:0',
      'section' => 'required|string',
    ]);

    $course->update($validated);

    return redirect()->route('admin.courses.show', $course)->with('success', 'Course updated successfully.');
  }

  public function destroy(Course $course)
  {
    $course->delete();
    return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
  }
}
