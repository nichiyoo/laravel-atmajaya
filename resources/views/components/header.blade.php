@props(['pretitle' => null, 'title' => null])

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <div class="page-pretitle">
          {{ $pretitle }}
        </div>
        <h2 class="page-title">
          {{ $title }}
        </h2>
      </div>

      <div class="col-auto d-print-none ms-auto">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
