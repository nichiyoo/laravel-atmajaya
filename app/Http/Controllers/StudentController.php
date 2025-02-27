<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
  public function index(Request $request)
  {
    $count = $request->get('count', 10);
    $search = $request->get('search', '');
    $count = min(50, max(5, $count));

    $students = User::where('role', 'student')
      ->when(
        $search,
        fn($query) => $query
          ->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'like', '%' . $search . '%')
          ->orWhere('identifier', 'like', '%' . $search . '%')
      )
      ->paginate($count)
      ->withQueryString();

    return view('admin.students.index', [
      'students' => $students,
      'count' => $count,
      'search' => $search,
    ]);
  }

  public function create()
  {
    return view('admin.students.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'identifier' => ['required', 'string', 'max:255', 'unique:users'],
      'current_gpa' => ['required', 'numeric', 'min:0', 'max:4'],
      'cummulative_gpa' => ['required', 'numeric', 'min:0', 'max:4'],
      'available_credit' => ['required', 'integer', 'min:0'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $user = User::create($validated);

    return redirect()->route('admin.students.show', $user->id)->with('success', 'Student created successfully.');
  }

  public function show(User $student)
  {
    return view('admin.students.show', [
      'student' => $student->load('semesters', 'semesters.course'),
    ]);
  }

  public function edit(User $student)
  {
    return view('admin.students.edit', [
      'student' => $student,
    ]);
  }

  public function update(Request $request, User $student)
  {
    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->id)],
      'identifier' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($student->id)],
      'available_credit' => ['required', 'integer', 'min:0'],
      'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);

    $student->update([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'identifier' => $validated['identifier'],
      'available_credit' => $validated['available_credit'],
    ]);

    if ($validated['password']) {
      $student->update(['password' => Hash::make($validated['password'])]);
    }

    return redirect()->route('admin.students.show', $student->id)->with('success', 'Student updated successfully.');
  }

  public function destroy(User $student)
  {
    $student->delete();
    return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
  }
}
