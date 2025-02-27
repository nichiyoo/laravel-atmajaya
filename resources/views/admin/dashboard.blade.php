@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Dashboard</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Total Students</div>
              </div>
              <div class="h1 mb-3">{{ $count_students }}</div>
              <div class="d-flex mb-2">
                <div>Enrollment rate</div>
                <i class="ms-auto icon ti ti-trending-up text-success"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Total Courses</div>
              </div>
              <div class="h1 mb-3">{{ $count_courses }}</div>
              <div class="d-flex mb-2">
                <div>Increase rate</div>
                <i class="ms-auto icon ti ti-trending-up text-success"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Average GPA</div>
              </div>
              <div class="h1 mb-3">{{ number_format($gpa_average, 2) }}</div>
              <div class="d-flex mb-2">
                <div>Improvement</div>
                <i class="ms-auto icon ti ti-trending-up text-success"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="subheader">Total Enrollments</div>
              </div>
              <div class="h1 mb-3">{{ $total_enrollment }}</div>
              <div class="d-flex mb-2">
                <div>Increase rate</div>
                <i class="ms-auto icon ti ti-trending-up text-success"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">GPA Distribution</h3>
            </div>
            <div class="card-body">
              <div id="chart-gpa-distribution"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Activity</h3>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Action</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($activities as $activity)
                    <tr>
                      <td>{{ $activity->user->name }}</td>
                      <td>{{ $activity->course->code }}</td>
                      <td>Enrolled</td>
                      <td>{{ $activity->created_at->format('M d, Y') }}</td>
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
      var gpa_distribution = @json($gpa_distribution);
      var categories = Object.keys(gpa_distribution);
      var data = Object.values(gpa_distribution);

      var options = {
        series: [{
          name: 'Students',
          data: data
        }],
        chart: {
          type: 'bar',
          height: 300,
          toolbar: {
            show: true,
          }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '50%',
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: false,
          colors: ['transparent']
        },
        xaxis: {
          categories: categories,
        },
        fill: {
          colors: ['#ff6e03'],
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function(val) {
              return val + " students"
            },
          }
        }
      };

      if (data.length > 0) {
        var chart = new ApexCharts(document.querySelector("#chart-gpa-distribution"), options);
        chart.render();
      } else {
        document.querySelector("#chart-gpa-distribution").innerHTML = "No data available for GPA distribution.";
      }
    });
  </script>
@endpush
