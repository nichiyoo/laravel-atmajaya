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
          <li class="breadcrumb-item active" aria-current="page">Add Semester Courses</li>
        </ol>
      </nav>
    </x-slot>
    <x-slot name="title">Add Semester Courses for {{ $student->name }}</x-slot>
  </x-header>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-md-6">
          <form id="semester-form" class="card" action="{{ route('admin.students.semesters.store', $student->id) }}"
            method="POST">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Semester Information</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required">
                  <i class="ti ti-calendar-event me-1"></i> Semester
                </label>
                <input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester"
                  value="{{ old('semester') }}" required>
                @error('semester')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label required">
                  <i class="ti ti-calendar me-1"></i> Year
                </label>
                <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                  value="{{ old('year') }}" required>
                @error('year')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label required">
                  <i class="ti ti-books me-1"></i> Select Courses
                </label>
                <select id="course-select" class="form-select @error('courses') is-invalid @enderror">
                  <option value="">Select a course</option>
                  @foreach ($courses as $description => $groupedCourses)
                    <optgroup label="{{ $description }}" data-description="{{ $description }}">
                      @foreach ($groupedCourses as $course)
                        <option value="{{ $course->id }}" data-code="{{ $course->code }}"
                          data-credit="{{ $course->credit }}" data-description="{{ $description }}">
                          {{ $course->code }} - {{ $course->description }} ({{ $course->credit }} credits)
                        </option>
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
                @error('courses')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer text-end">
              <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-link">Cancel</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Courses
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Selected Courses</h3>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Description</th>
                      <th>Credit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="selected-courses">
                    <!-- Selected courses will be dynamically added here -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-between align-items-center">
                <div>Available: <span id="available">{{ $student->available_credit }}</span></div>
                <div>Selected: <span id="selected">0</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const select = document.getElementById('course-select');
      const table = document.getElementById('selected-courses');
      const selected = document.getElementById('selected');
      const available = document.getElementById('available');
      const form = document.getElementById('semester-form');
      const max = parseInt(available.textContent);

      const courses = new Map();
      const selectedDescriptions = new Set();

      function updateTable() {
        table.innerHTML = '';
        let total = 0;

        courses.forEach((course, id) => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${course.code}</td>
            <td>${course.desc}</td>
            <td>${course.credit}</td>
            <td>
              <button type="button" class="btn btn-ghost-danger btn-pill btn-icon remove-course" data-id="${id}" data-description="${course.description}" aria-label="Remove">
                <i class="ti ti-trash"></i>
              </button>
            </td>
          `;
          table.appendChild(row);
          total += course.credit;
        });

        selected.textContent = total;

        const inputs = document.querySelectorAll('input[name="courses[]"]');
        inputs.forEach(input => input.remove());

        courses.forEach((course, id) => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'courses[]';
          input.value = id;
          form.appendChild(input);
        });

        updateSelectOptions();
      }

      function updateSelectOptions() {
        Array.from(select.options).forEach(option => {
          if (option.dataset.description) {
            option.disabled = selectedDescriptions.has(option.dataset.description);
          }
        });

        Array.from(select.getElementsByTagName('optgroup')).forEach(optgroup => {
          const hasEnabledOptions = Array.from(optgroup.getElementsByTagName('option')).some(option => !option
            .disabled);
          optgroup.disabled = !hasEnabledOptions;
        });
      }

      select.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (option.value) {
          const id = option.value;
          if (!courses.has(id)) {
            courses.set(id, {
              code: option.dataset.code,
              desc: option.dataset.description,
              credit: parseInt(option.dataset.credit),
              description: option.dataset.description
            });
            selectedDescriptions.add(option.dataset.description);
            updateTable();
          }
          this.selectedIndex = 0;
        }
      });

      table.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-course') || e.target.closest('.remove-course')) {
          const btn = e.target.closest('.remove-course');
          const id = btn.dataset.id;
          const description = btn.dataset.description;
          courses.delete(id);
          if (!Array.from(courses.values()).some(course => course.description === description)) {
            selectedDescriptions.delete(description);
          }
          updateTable();
        }
      });

      form.addEventListener('submit', function(e) {
        if (courses.size === 0) {
          e.preventDefault();
          alert('Please select at least one course before submitting.');
        }
      });
    });
  </script>
@endpush
