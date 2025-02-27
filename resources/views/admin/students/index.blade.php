@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Students') }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">{{ __('Student List') }}</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('admin.dashboard') }}" class="btn d-none d-sm-inline-block">
          <i class="icon ti ti-arrow-left"></i>
          {{ __('Back') }}
        </a>

        <a href="{{ route('admin.students.create') }}" class="btn btn-primary d-none d-sm-inline-block">
          <i class="icon ti ti-plus"></i>
          {{ __('Register Student') }}
        </a>

        <a href="{{ route('admin.students.create') }}" class="btn btn-primary d-sm-none btn-icon"
          aria-label="{{ __('Register Student') }}">
          <i class="icon ti ti-plus"></i>
        </a>
      </div>
    </div>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ __('Student List') }}</h3>
            </div>

            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('User ID') }}</th>
                    <th>{{ __('Current GPA') }}</th>
                    <th>{{ __('Cummulative GPA') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($students as $student)
                    <tr>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->identifier }}</td>
                      <td>{{ number_format($student->current_gpa, 2) }}</td>
                      <td>{{ number_format($student->cummulative_gpa, 2) }}</td>
                      <td><span class="badge bg-green-lt">{{ $student->role }}</span></td>
                      <td>
                        <div class="gap-2 d-flex align-items-center">
                          <a href="{{ route('admin.students.show', $student->id) }}"class="btn btn-ghost-dark btn-pill btn-icon"
                            aria-label="{{ __('Detail') }}">
                            <i class="icon ti ti-list-search"></i>
                          </a>
                          <button type="button" class="btn btn-ghost-danger btn-pill btn-icon delete-btn"
                            data-delete-url="{{ route('admin.students.destroy', $student->id) }}"
                            data-item-name="{{ $student->name }}" data-item-type="student"
                            aria-label="{{ __('Delete') }}">
                            <i class="icon ti ti-trash"></i>
                          </button>
                        </div>
                      </td>
                  </tr> @empty
                    <tr>
                      <td colspan="7" class="text-center py-5">No students found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <div class="mt-4">
            {{ $students->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
