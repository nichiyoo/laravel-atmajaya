@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $student->name }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Student Details</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('admin.students.index') }}" class="btn d-none d-sm-inline-block">
          <i class="ti ti-arrow-left"></i> Back
        </a>
        <div class="dropdown">
          <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="icon dropdown-item-icon ti ti-layout-list"></i>
            {{ __('Actions') }}
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item " href="{{ route('admin.students.edit', $student->id) }}">
              <i class="icon dropdown-item-icon ti ti-edit"></i>
              {{ __('Edit Details') }}
            </a>
            <button type="button" class="dropdown-item text-danger delete-btn"
              data-delete-url="{{ route('admin.students.destroy', $student->id) }}" data-item-name="{{ $student->name }}"
              data-item-type="student" aria-label="{{ __('Delete') }}">
              <i class="icon dropdown-item-icon ti ti-trash"></i>
              {{ __('Delete Student') }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
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
                  <div class="datagrid-title">Role</div>
                  <div class="datagrid-content">
                    <span class="badge bg-blue-lt">{{ ucfirst($student->role) }}</span>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Current GPA</div>
                  <div class="datagrid-content">{{ number_format($student->current_gpa, 2) }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Cumulative GPA</div>
                  <div class="datagrid-content">{{ number_format($student->cummulative_gpa, 2) }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Created At</div>
                  <div class="datagrid-content">{{ $student->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Updated At</div>
                  <div class="datagrid-content">{{ $student->updated_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Email Verified At</div>
                  <div class="datagrid-content">
                    @if ($student->email_verified_at)
                      {{ $student->email_verified_at->format('d M Y, H:i') }}
                    @else
                      <span class="badge bg-yellow-lt">Not Verified</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Semester Information</h3>
              <div class="card-actions">
                <a href="{{ route('admin.students.semesters.create', $student->id) }}" class="btn btn-primary">
                  <i class="ti ti-plus"></i> Add Semester Courses
                </a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Course') }}</th>
                    <th>{{ __('Semester') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('CW1') }}</th>
                    <th>{{ __('CW2') }}</th>
                    <th>{{ __('CW3') }}</th>
                    <th>{{ __('CW4') }}</th>
                    <th>{{ __('Midterm') }}</th>
                    <th>{{ __('Final') }}</th>
                    <th>{{ __('Overall') }}</th>
                    <th>{{ __('Grade') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($student->semesters as $semester)
                    <tr>
                      <td>{{ $semester->course->code }}</td>
                      <td>{{ $semester->course->description }}</td>
                      <td>{{ $semester->semester }}</td>
                      <td>{{ $semester->year }}</td>
                      <td>{{ $semester->cw1 }}</td>
                      <td>{{ $semester->cw2 }}</td>
                      <td>{{ $semester->cw3 }}</td>
                      <td>{{ $semester->cw4 }}</td>
                      <td>{{ $semester->midterm }}</td>
                      <td>{{ $semester->final }}</td>
                      <td>{{ $semester->getOverallGrade() }}</td>
                      <td>{{ $semester->getLetterGrade() }} </td>
                      <td>
                        <div class="gap-2 d-flex align-items-center">
                          <a href="{{ route('admin.students.semesters.edit', [$student->id, $semester->id]) }}"
                            class="btn btn-ghost-dark btn-pill btn-icon" aria-label="{{ __('Edit') }}">
                            <i class="icon ti ti-edit"></i>
                          </a>
                          <button type="button" class="btn btn-ghost-danger btn-pill btn-icon delete-btn"
                            data-delete-url="{{ route('admin.students.semesters.destroy', [$student->id, $semester->id]) }}"
                            data-item-name="{{ $semester->course->code }}" data-item-type="semester course"
                            aria-label="{{ __('Delete') }}">
                            <i class="icon ti ti-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="11" class="text-center py-5">No semester courses found</td>
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
