@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Courses</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Edit Course: {{ $course->code }}</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <form class="card" action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h3 class="card-title">Course Information</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-code me-1"></i> Code
                  </label>
                  <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                    value="{{ old('code', $course->code) }}" required>
                  @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-book me-1"></i> Description
                  </label>
                  <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    value="{{ old('description', $course->description) }}" required>
                  @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-ticket me-1"></i> Credit
                  </label>
                  <input type="number" class="form-control @error('credit') is-invalid @enderror" name="credit"
                    value="{{ old('credit', $course->credit) }}" required>
                  @error('credit')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-building me-1"></i> Section
                  </label>
                  <input type="text" class="form-control @error('section') is-invalid @enderror" name="section"
                    value="{{ old('section', $course->section) }}" required>
                  @error('section')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <a href="{{ route('admin.courses.index') }}" class="btn btn-link">Cancel</a>
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
