@extends('layouts.student')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('student.semesters.index') }}">{{ __('Transcripts') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Full Transcripts') }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">{{ __('Full Transcripts') }}</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('student.semesters.index') }}" class="btn d-none d-sm-inline-block">
          <i class="icon ti ti-arrow-left"></i>
          {{ __('Back') }}
        </a>
        <button type="button" class="btn btn-primary" onclick="window.print()">
          <i class="icon ti ti-printer"></i>
          {{ __('Print') }}
        </button>
      </div>
    </div>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student Information</h3>
            </div>
            <div class="card-body">
              <div class="datagrid">
                <div class="datagrid-item">
                  <div class="datagrid-title">Name</div>
                  <div class="datagrid-content">{{ $student->name }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Email</div>
                  <div class="datagrid-content">{{ $student->email }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Identifier</div>
                  <div class="datagrid-content">{{ $student->identifier }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Current GPA</div>
                  <div class="datagrid-content">{{ number_format($student->current_gpa, 2) }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Cumulative GPA</div>
                  <div class="datagrid-content">{{ number_format($student->cummulative_gpa, 2) }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @foreach ($groups as $group)
          <div class="col-12 mt-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Semester {{ $group['semester'] }} - Year {{ $group['year'] }}
                </h3>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                      <th>{{ __('Course') }}</th>
                      <th>{{ __('CW1') }}</th>
                      <th>{{ __('CW2') }}</th>
                      <th>{{ __('CW3') }}</th>
                      <th>{{ __('CW4') }}</th>
                      <th>{{ __('Midterm') }}</th>
                      <th>{{ __('Final') }}</th>
                      <th>{{ __('Grade') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($group['courses'] as $item)
                      <tr>
                        <td>{{ $item->course->code }} - {{ $item->course->description }}</td>
                        <td>{{ $item->cw1 ?? '-' }}</td>
                        <td>{{ $item->cw2 ?? '-' }}</td>
                        <td>{{ $item->cw3 ?? '-' }}</td>
                        <td>{{ $item->cw4 ?? '-' }}</td>
                        <td>{{ $item->midterm ?? '-' }}</td>
                        <td>{{ $item->final ?? '-' }}</td>
                        <td>{{ $item->getLetterGrade() }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class="d-flex justify-content-between">
                  <div>Semester GPA: {{ number_format($group['gpa'], 2) }}</div>
                  <div>Total Credits: {{ $group['total_credits'] }}</div>
                  <div>Cumulative GPA: {{ number_format($group['cummulative'], 2) }}</div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
