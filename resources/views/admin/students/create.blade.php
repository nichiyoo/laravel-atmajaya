@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create New Student</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Create New Student</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <form class="card" action="{{ route('admin.students.store') }}" method="POST">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Student Information</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-user me-1"></i> Name
                  </label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Enter name" value="{{ old('name') }}" required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-mail me-1"></i> Email
                  </label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Enter email" value="{{ old('email') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-id me-1"></i> Identifier
                  </label>
                  <input type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier"
                    placeholder="Enter identifier" value="{{ old('identifier') }}" required>
                  @error('identifier')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-calendar me-1"></i> Semester
                  </label>
                  <input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester"
                    placeholder="Enter semester" value="{{ old('semester', 1) }}" min="1" required>
                  @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-chart-bar me-1"></i> Current GPA
                  </label>
                  <input type="number" step="0.01" class="form-control @error('current_gpa') is-invalid @enderror"
                    name="current_gpa" placeholder="Enter current GPA" value="{{ old('current_gpa', 0) }}" min="0"
                    max="4" required>
                  @error('current_gpa')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-chart-line me-1"></i> Cumulative GPA
                  </label>
                  <input type="number" step="0.01" class="form-control @error('cummulative_gpa') is-invalid @enderror"
                    name="cummulative_gpa" placeholder="Enter cumulative GPA" value="{{ old('cummulative_gpa', 0) }}"
                    min="0" max="4" required>
                  @error('cummulative_gpa')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-credit-card me-1"></i> Available Credit
                  </label>
                  <input type="number" class="form-control @error('available_credit') is-invalid @enderror"
                    name="available_credit" placeholder="Enter available credit"
                    value="{{ old('available_credit', 21) }}" min="0" required>
                  @error('available_credit')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-lock me-1"></i> Password
                  </label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Enter password" required>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-lock-check me-1"></i> Confirm Password
                  </label>
                  <input type="password" class="form-control" name="password_confirmation"
                    placeholder="Confirm password" required>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Create Student
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
