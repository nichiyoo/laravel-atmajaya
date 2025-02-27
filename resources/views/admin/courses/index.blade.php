@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Courses') }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">{{ __('Course List') }}</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('admin.dashboard') }}" class="btn d-none d-sm-inline-block">
          <i class="icon ti ti-arrow-left"></i>
          {{ __('Back') }}
        </a>

        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary d-none d-sm-inline-block">
          <i class="icon ti ti-plus"></i>
          {{ __('Add Course') }}
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
              <h3 class="card-title">{{ __('Course List') }}</h3>
            </div>

            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Credit') }}</th>
                    <th>{{ __('Section') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($courses as $course)
                    <tr>
                      <td>{{ $course->code }}</td>
                      <td>{{ $course->description }}</td>
                      <td>{{ $course->credit }}</td>
                      <td><span class="badge bg-primary-lt">{{ $course->section }}</span></td>
                      <td>
                        <div class="gap-2 d-flex align-items-center">
                          <a href="{{ route('admin.courses.edit', $course->id) }}"
                            class="btn btn-ghost-dark btn-pill btn-icon" aria-label="{{ __('Edit') }}">
                            <i class="icon ti ti-pencil"></i>
                          </a>
                          <button type="button" class="btn btn-ghost-danger btn-pill btn-icon delete-btn"
                            data-delete-url="{{ route('admin.courses.destroy', $course->id) }}"
                            data-item-name="{{ $course->code }}" data-item-type="course"
                            aria-label="{{ __('Delete') }}">
                            <i class="icon ti ti-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center py-5">No courses found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <div class="mt-4">
            {{ $courses->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
