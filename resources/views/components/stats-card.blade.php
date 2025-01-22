<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col mt-0">
        <h5 class="card-title">{{ $title }}</h5>
      </div>

      <div class="col-auto">
        <div class="stat text-primary">
          {{ $icon }}
        </div>
      </div>
    </div>
    <h1 class="mt-1 mb-3">{{ $stats }}</h1>
    <div class="mb-0">
      <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $percentage }}% </span>
      <span class="text-muted">Since last week</span>
    </div>
  </div>
</div>