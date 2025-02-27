@extends('layouts.student')

@section('content')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Student Dashboard
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Current GPA</div>
              </div>
              <div class="h1 mb-3">{{ number_format($student->current_gpa, 2) }}</div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Cumulative GPA</div>
              </div>
              <div class="h1 mb-3">{{ number_format($student->cummulative_gpa, 2) }}</div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Current Semester</div>
              </div>
              <div class="h1 mb-3">{{ $latests->first()->semester ?? '-' }}</div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Available Credit</div>
              </div>
              <div class="h1 mb-3">{{ $student->available_credit }}</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">GPA Trend</h3>
            </div>
            <div class="card-body">
              <div id="gpa-trend-chart"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Courses</h3>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Grade</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($latests as $semester)
                    <tr>
                      <td>{{ $semester->course->code }}</td>
                      <td>
                        <a href="{{ route('student.semesters.show', $semester->id) }}">
                          {{ $semester->course->description }}
                        </a>
                      </td>
                      <td>{{ $semester->semester }}</td>
                      <td>{{ $semester->year }}</td>
                      <td>{{ $semester->getLetterGrade() }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var groups = @json($groups);
      var series = [{
        name: 'GPA',
        data: []
      }];

      var categories = [];
      var sorted = Object.entries(groups).sort((a, b) => {
        const [semesterA] = a[0].split('-').map(Number);
        const [semesterB] = b[0].split('-').map(Number);
        return semesterA - semesterB;
      });

      sorted.forEach(function([key, value]) {
        categories.push(key);
        series[0].data.push(parseFloat(value.toFixed(2)));
      });

      var options = {
        series: series,
        chart: {
          type: 'line',
          height: 350,
          toolbar: {
            show: false,
          }
        },
        stroke: {
          width: 2,
          curve: 'smooth'
        },
        xaxis: {
          categories: categories,
          title: {
            text: 'Year - Semester'
          }
        },
        yaxis: {
          min: 0,
          max: 4
        },
        tooltip: {
          y: {
            formatter: function(val) {
              return val.toFixed(2)
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#gpa-trend-chart"), options);
      chart.render();
    });
  </script>
@endpush
