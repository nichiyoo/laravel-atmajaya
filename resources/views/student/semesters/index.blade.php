@extends('layouts.student')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Transcripts') }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">{{ __('Transcripts') }}</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('admin.dashboard') }}" class="btn d-none d-sm-inline-block">
          <i class="icon ti ti-arrow-left"></i>
          {{ __('Back') }}
        </a>

        <a href="{{ route('student.semesters.full') }}" class="btn btn-primary d-none d-sm-inline-block">
          {{ __('Full Transcript') }}
        </a>
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
        <div class="col-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Semester Information</h3>
              <div class="ms-auto">
                <form action="{{ route('student.semesters.index') }}" method="GET" class="d-flex">
                  <select name="semester" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">All Semesters</option>
                    @foreach ($options as $option)
                      <option value="{{ $option }}" {{ $semester == $option ? 'selected' : '' }}>
                        Semester {{ $option }}
                      </option>
                    @endforeach
                  </select>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>{{ __('Semester') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('Course') }}</th>
                    <th>{{ __('Credit') }}</th>
                    <th>{{ __('CW1') }}</th>
                    <th>{{ __('CW2') }}</th>
                    <th>{{ __('CW3') }}</th>
                    <th>{{ __('CW4') }}</th>
                    <th>{{ __('Midterm') }}</th>
                    <th>{{ __('Final') }}</th>
                    <th>{{ __('Overall') }}</th>
                    <th>{{ __('Grade') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($semesters as $item)
                    <tr>
                      <td>{{ $item->semester }}</td>
                      <td>{{ $item->year }}</td>
                      <td>
                        <a href="{{ route('student.semesters.show', $item->id) }}">
                          {{ $item->course->code }} - {{ $item->course->description }}
                        </a>
                      </td>
                      <td>{{ $item->course->credit }}</td>
                      <td>{{ $item->cw1 }}</td>
                      <td>{{ $item->cw2 }}</td>
                      <td>{{ $item->cw3 }}</td>
                      <td>{{ $item->cw4 }}</td>
                      <td>{{ $item->midterm }}</td>
                      <td>{{ $item->final }}</td>
                      <td>{{ $item->getOverallGrade() }}</td>
                      <td>{{ $item->getLetterGrade() }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="12" class="text-center py-5">No semester courses found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
