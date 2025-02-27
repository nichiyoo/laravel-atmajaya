@extends('layouts.student')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('student.semesters.index') }}">{{ __('Transcripts') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Detail Transcripts') }}</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">{{ __('Detail Transcripts') }}</x-slot>

    <div class="col-auto d-print-none ms-auto">
      <div class="btn-list">
        <a href="{{ route('student.semesters.index') }}" class="btn d-none d-sm-inline-block">
          <i class="icon ti ti-arrow-left"></i>
          {{ __('Back') }}
        </a>
      </div>
    </div>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <form class="card">
            <div class="card-header">
              <h3 class="card-title">Course Information: {{ $semester->course->code }} -
                {{ $semester->course->description }}</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    <i class="ti ti-calendar me-1"></i> Year
                  </label>
                  <input type="number" class="form-control" value="{{ $semester->year }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    <i class="ti ti-calendar-event me-1"></i> Semester
                  </label>
                  <input type="number" class="form-control" value="{{ $semester->semester }}" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 1
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->cw1 }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 2
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->cw2 }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 3
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->cw3 }}" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 4
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->cw4 }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing-sign me-1"></i> Midterm
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->midterm }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-certificate me-1"></i> Final
                  </label>
                  <input type="number" step="0.001" class="form-control" value="{{ $semester->final }}" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    <i class="ti ti-award me-1"></i> Grade
                  </label>
                  <input type="text" class="form-control" value="{{ $semester->getLetterGrade() }}" disabled>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
