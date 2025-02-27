@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.show', $student->id) }}">{{ $student->name }}</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Edit Semester Course</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Edit Semester Course for {{ $student->name }}</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <form class="card" action="{{ route('admin.students.semesters.update', [$student->id, $semester->id]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h3 class="card-title">Course Information: {{ $semester->course->code }} -
                {{ $semester->course->description }}</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-calendar me-1"></i> Year
                  </label>
                  <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                    value="{{ old('year', $semester->year) }}" required>
                  @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-calendar-event me-1"></i> Semester
                  </label>
                  <input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester"
                    value="{{ old('semester', $semester->semester) }}" required>
                  @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 1
                  </label>
                  <input type="number" step="0.001" class="form-control @error('cw1') is-invalid @enderror"
                    name="cw1" value="{{ old('cw1', $semester->cw1) }}">
                  @error('cw1')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 2
                  </label>
                  <input type="number" step="0.001" class="form-control @error('cw2') is-invalid @enderror"
                    name="cw2" value="{{ old('cw2', $semester->cw2) }}">
                  @error('cw2')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 3
                  </label>
                  <input type="number" step="0.001" class="form-control @error('cw3') is-invalid @enderror"
                    name="cw3" value="{{ old('cw3', $semester->cw3) }}">
                  @error('cw3')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing me-1"></i> Coursework 4
                  </label>
                  <input type="number" step="0.001" class="form-control @error('cw4') is-invalid @enderror"
                    name="cw4" value="{{ old('cw4', $semester->cw4) }}">
                  @error('cw4')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-writing-sign me-1"></i> Midterm
                  </label>
                  <input type="number" step="0.001" class="form-control @error('midterm') is-invalid @enderror"
                    name="midterm" value="{{ old('midterm', $semester->midterm) }}">
                  @error('midterm')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">
                    <i class="ti ti-certificate me-1"></i> Final
                  </label>
                  <input type="number" step="0.001" class="form-control @error('final') is-invalid @enderror"
                    name="final" value="{{ old('final', $semester->final) }}">
                  @error('final')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-link">Cancel</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Update Course
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
