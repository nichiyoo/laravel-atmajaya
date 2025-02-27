<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $count_students = User::where('role', 'student')->count();
    $count_courses = Course::count();
    $gpa_average = User::where('role', 'student')->avg('cummulative_gpa');
    $total_enrollment = Semester::count();

    $activities = Semester::with(['user', 'course'])
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    $ranges = [
      '0.00 - 0.99',
      '1.00 - 1.99',
      '2.00 - 2.99',
      '3.00 - 3.99',
      '4.00'
    ];

    $gpa_distribution = User::where('role', 'student')
      ->select(DB::raw('
              CASE
                  WHEN cummulative_gpa < 1 THEN \'0.00 - 0.99\'
                  WHEN cummulative_gpa < 2 THEN \'1.00 - 1.99\'
                  WHEN cummulative_gpa < 3 THEN \'2.00 - 2.99\'
                  WHEN cummulative_gpa < 4 THEN \'3.00 - 3.99\'
                  ELSE \'4.00\'
              END as gpa_range
          '), DB::raw('COUNT(*) as count'))
      ->groupBy('gpa_range')
      ->get()
      ->pluck('count', 'gpa_range')
      ->toArray();

    foreach ($ranges as $range) {
      if (!isset($gpa_distribution[$range])) {
        $gpa_distribution[$range] = 0;
      }
    }

    ksort($gpa_distribution);

    return view('admin.dashboard', compact(
      'count_students',
      'count_courses',
      'gpa_average',
      'total_enrollment',
      'activities',
      'gpa_distribution'
    ));
  }

  /**
   * Handle the search request.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function search()
  {
    $query = request()->get('query');
    return redirect()->route('admin.dashboard', ['query' => $query]);
  }
}