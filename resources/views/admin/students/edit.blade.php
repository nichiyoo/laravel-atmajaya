@extends('layouts.admin')

@section('content')
  <x-header>
    <x-slot name="pretitle">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Edit Student: {{ $student->name }}</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <form class="card" action="{{ route('admin.students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                    placeholder="Enter name" value="{{ old('name', $student->name) }}" required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-mail me-1"></i> Email
                  </label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Enter email" value="{{ old('email', $student->email) }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label required">
                    <i class="ti ti-id me-1"></i> Identifier
                  </label>
                  <input type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier"
                    placeholder="Enter identifier" value="{{ old('identifier', $student->identifier) }}" required>
                  @error('identifier')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label disabled">
                    <i class="ti ti-chart-bar me-1"></i> Current GPA
                  </label>
                  <input type="number" step="0.01" class="form-control" name="current_gpa"
                    value="{{ $student->current_gpa }}" min="0" max="4" disabled>
                  @error('current_gpa')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label disabled">
                    <i class="ti ti-chart-line me-1"></i> Cumulative GPA
                  </label>
                  <input type="number" step="0.01" class="form-control" name="cummulative_gpa"
                    value="{{ $student->cummulative_gpa }}" min="0" max="4" disabled>
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
                    value="{{ old('available_credit', $student->available_credit) }}" min="0" required>
                  @error('available_credit')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    <i class="ti ti-lock me-1"></i> New Password (leave blank to keep current password)
                  </label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Enter new password">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    <i class="ti ti-lock-check me-1"></i> Confirm New Password
                  </label>
                  <input type="password" class="form-control" name="password_confirmation"
                    placeholder="Confirm new password">
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Update Student
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
